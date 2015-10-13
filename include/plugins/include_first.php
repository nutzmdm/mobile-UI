
<?php
	ini_set("display_errors", "Off");
	/*
	 * Define Local Functions
	 *   - remove SQL Injection : Thanks to Julien CAYSSOL
	 */

	function getParameters($str){
		$var = NULL;
		if (isset($_GET[$str]))
			$var = $_GET[$str];
		if (isset($_POST[$str]))
			$var = $_POST[$str];
		if ($var == "")
			$var = NULL;
		return htmlentities($var, ENT_QUOTES, "UTF-8");
	}

 	/*
 	 * Purge Values
 	 */
	if (function_exists('filter_var')){
		foreach ($_GET as $key => $value){
			if (!is_array($value)){
				$value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
				$_GET[$key] = $value;
			}
		}
	}

	$p = getParameters("p");
	$o = getParameters("o");
	$min = getParameters("min");
	$type = getParameters("type");
	$search = getParameters("search");
	$limit = getParameters("limit");
	$num = getParameters("num");

	/*
	 * Include all func
	 */

	include_once ("../../../../basic-functions.php");
	include_once ("../../../../include/common/common-Func.php");
	
	function microtime_float() 	{
	   list($usec, $sec) = explode(" ", microtime());
	   return ((float)$usec + (float)$sec);
	}

	set_time_limit(60);
	$time_start = microtime_float();

	$advanced_search = 0;

	/*
	 * Define
	 */
	define('SMARTY_DIR', realpath('../../../../../GPL_LIB/Smarty/libs/') . '/');

	/*
	 * Include
	 */
	require_once "/etc/centreon/centreon.conf.php";

	require_once "../../../../class/centreonDB.class.php";
	require_once "../../../../class/centreonLang.class.php";
	require_once "../../../../class/centreonSession.class.php";
	require_once "../../../../class/centreon.class.php";
	

	/*
	 * Create DB Connection
	 *  - centreon
	 *  - centstorage
	 */
	$pearDB 	= new CentreonDB();
	$pearDBO 	= new CentreonDB("centstorage");

	ini_set("session.gc_maxlifetime", "31536000");

	CentreonSession::start();

	/*
	 * Delete Session Expired
	 */
	$DBRESULT =& $pearDB->query("SELECT * FROM `options` WHERE `key` = 'session_expire' LIMIT 1");
	$session_expire =& $DBRESULT->fetchRow();
	if (!isset($session_expire["value"]) || !$session_expire["value"]) {
		$session_expire["value"] = 2;
	}
	$time_limit = time() - ($session_expire["value"] * 60);

	$DBRESULT =& $pearDB->query("DELETE FROM `session` WHERE `last_reload` < '".$time_limit."'");

	/*
	 * Get session and Check if session is not expired
	 */
	$DBRESULT =& $pearDB->query("SELECT `user_id` FROM `session` WHERE `session_id` = '".session_id()."'");

	if (!$DBRESULT->numRows()) {
		header("Location: ../../../../index.php?disconnect=2");
	}

	if (!isset($_SESSION["centreon"])) {
		header("Location: ../../../../index.php?disconnect=1");
	}

	/*
	 * Define Oreon var alias
	 */
	$centreon =& $_SESSION["centreon"];
	$oreon =& $centreon;
	if (!is_object($centreon)) {
		exit('error1');
	}

	/*
	 * Init differents elements we need in a lot of pages
	 */
	unset($centreon->Nagioscfg);
	$centreon->initNagiosCFG($pearDB);
	unset($centreon->optGen);
	$centreon->initOptGen($pearDB);

    /*
     * Cut Page ID
     */
	$level1 = NULL;
	$level2 = NULL;
	$level3 = NULL;
	$level4 = NULL;
	switch (strlen($p))	{
		case 1 :  $level1= $p; break;
		case 3 :  $level1 = substr($p, 0, 1); $level2 = substr($p, 1, 2); $level3 = substr($p, 3, 2); break;
		case 5 :  $level1 = substr($p, 0, 1); $level2 = substr($p, 1, 2); $level3 = substr($p, 3, 2); break;
		case 6 :  $level1 = substr($p, 0, 2); $level2 = substr($p, 2, 2); $level3 = substr($p, 3, 2); break;
		case 7 :  $level1 = substr($p, 0, 1); $level2 = substr($p, 1, 2); $level3 = substr($p, 3, 2); $level4 = substr($p, 5, 2); break;
		default : $level1= $p; break;
	}

	/*
	 * Update Session Table For last_reload and current_page row
	 */
	$DBRESULT =& $pearDB->query("UPDATE `session` SET `current_page` = '".$level1.$level2.$level3.$level4."', `last_reload` = '".time()."', `ip_address` = '".$_SERVER["REMOTE_ADDR"]."' WHERE CONVERT(`session_id` USING utf8) = '".session_id()."' AND `user_id` = '".$centreon->user->user_id."' LIMIT 1");

/*
     * Set language
     *
    $locale = $oreon->user->get_lang();
    putenv("LANG=$locale");
    setlocale(LC_ALL, $locale);
    bindtextdomain("messages", "./modules/Syslog/locale/");
    bind_textdomain_codeset("messages", "UTF-8");
    textdomain("messages");
*/

	/*
	 * LCA Init Common Var
	 */
	
	
	global $is_admin;
	$is_admin = $centreon->user->admin;

	$DBRESULT =& $pearDB->query("SELECT topology_parent,topology_name,topology_id,topology_url,topology_page FROM topology WHERE topology_page = '".$p."'");
	$redirect =& $DBRESULT->fetchRow();
?>