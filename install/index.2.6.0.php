<?php
/*
 * Copyright 2005-2015 Centreon
 * Centreon is developped by : Julien Mathis and Romain Le Merlus under
 * GPL Licence 2.0.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation ; either version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see <http://www.gnu.org/licenses>.
 *
 * Linking this program statically or dynamically with other modules is making a
 * combined work based on this program. Thus, the terms and conditions of the GNU
 * General Public License cover the whole combination.
 *
 * As a special exception, the copyright holders of this program give Centreon
 * permission to link this program with independent modules to produce an executable,
 * regardless of the license terms of these independent modules, and to copy and
 * distribute the resulting executable under terms of Centreon choice, provided that
 * Centreon also meet, for each linked independent module, the terms  and conditions
 * of the license of that module. An independent module is a module which is not
 * derived from this program. If you modify this program, you may extend this
 * exception to your version of the program, but you are not obliged to do so. If you
 * do not wish to do so, delete this exception statement from your version.
 *
 * For more information : contact@centreon.com
 *
 */

//index.php version 2.6.0

//Patched version for Mobile-ui module

$useragent=$_SERVER['HTTP_USER_AGENT'];

ini_set('display_errors', 'Off');

$etc = "@CENTREON_ETC@";

clearstatcache(true, "$etc/centreon.conf.php");
if (!file_exists("$etc/centreon.conf.php") && is_dir('./install')) {
    header("Location: ./install/setup.php");
    return;
} elseif (file_exists("$etc/centreon.conf.php") && is_dir('install')) {
    require_once ("$etc/centreon.conf.php");
    header("Location: ./install/upgrade.php");
} else {
    if (file_exists("$etc/centreon.conf.php")) {
        require_once ("$etc/centreon.conf.php");
        $freeze = 0;
    } else {
        $freeze = 1;
        require_once ("../centreon.conf.php");
        $msg = _("You have to move centreon configuration file from temporary directory to final directory");
    }
}

require_once "$classdir/centreon.class.php";
require_once "$classdir/centreonSession.class.php";
require_once "$classdir/centreonAuth.SSO.class.php";
require_once "$classdir/centreonLog.class.php";
require_once "$classdir/centreonDB.class.php";

/*
 * Get auth type
 */
global $pearDB;
$pearDB = new CentreonDB();

$DBRESULT = $pearDB->query("SELECT * FROM `options`");
while ($generalOption = $DBRESULT->fetchRow()) {
    $generalOptions[$generalOption["key"]] = $generalOption["value"];
}
$DBRESULT->free();

/*
 * Set Skin For CSS properties
 */
$skin = "./Themes/".$generalOptions["template"]."/";

/*
 * detect installation dir
 */
$file_install_acces = 0;
if (file_exists("./install/setup.php")){
    $error_msg = "Installation Directory '". getcwd() ."/install/' is accessible. Delete this directory to prevent security problem.";
    $file_install_acces = 1;
}

/*
 * Set PHP Session Expiration time
 */
ini_set("session.gc_maxlifetime", "31536000");

CentreonSession::start();

if (isset($_GET["disconnect"])) {
    
    $centreon = & $_SESSION["centreon"];
    
    /*
     * Init log class
     */
    if (is_object($centreon)) {
        $CentreonLog = new CentreonUserLog($centreon->user->get_id(), $pearDB);
        $CentreonLog->insertLog(1, "Contact '".$centreon->user->get_alias()."' logout");

        $pearDB->query("DELETE FROM session WHERE session_id = '".session_id()."'");

        CentreonSession::restart();
    }
}

/*
 * already connected
 */
if (isset($_SESSION["centreon"])) {
    $centreon = & $_SESSION["centreon"];

	//Detect browser type. Redirect on custom login if smartphone detected
		if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|
						ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|
						plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||
						preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|
						an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w
						|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica
						|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene
						|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)
						|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt
						( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/
						|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )
						|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)
						|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a
						|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)
						|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )
						|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)
						|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)
						|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
				{header('Location: main.php?p=10');}
		else 	{header('Location: main.php');}
}

if (isset($_POST["submit"])
    || (isset($_GET["autologin"]) && $_GET["autologin"] && isset($_GET["p"]) && $_GET["autologin"] && isset($generalOptions["enable_autologin"]) && $generalOptions["enable_autologin"])
    || (isset($_POST["autologin"]) && $_POST["autologin"] && isset($_POST["p"]) && isset($generalOptions["enable_autologin"]) && $generalOptions["enable_autologin"])
    || (!isset($generalOptions['sso_enable']) || $generalOptions['sso_enable'] == 1)) {
    
    /*
     * Init log class
     */
    $CentreonLog = new CentreonUserLog(-1, $pearDB);

    if (isset($_POST['p'])) {
        $_GET["p"] = $_POST["p"];			
    }
    
    /*
     * Get Connexion parameters
     */
    isset($_GET["autologin"]) ? $autologin = $_GET["autologin"] : $autologin = 0;
    isset($_GET["useralias"]) ? $useraliasG = $_GET["useralias"] : $useraliasG = NULL;
    isset($_POST["useralias"]) ? $useraliasP = $_POST["useralias"] : $useraliasP = NULL;
    $useraliasG ? $useralias = $useraliasG : $useralias = $useraliasP;
    
    isset($_GET["password"]) ? $passwordG = $_GET["password"] : $passwordG = NULL;
    isset($_POST["password"]) ? $passwordP = $_POST["password"] : $passwordP = NULL;
    $passwordG ? $password = $passwordG : $password = $passwordP;

    $token = "";
    if (isset($_REQUEST['token']) && $_REQUEST['token']) {
        $token = $_REQUEST['token'];
    }

    if (!isset($encryptType)) {
        $encryptType = 1;
    }

    $centreonAuth = new CentreonAuthSSO($useralias, $password, $autologin, $pearDB, $CentreonLog, $encryptType, $token, $generalOptions);

    if ($centreonAuth->passwdOk == 1) {

        $centreon = new Centreon($centreonAuth->userInfos, $generalOptions["nagios_version"]);
        $_SESSION["centreon"] = $centreon;
        $pearDB->query("INSERT INTO `session` (`session_id` , `user_id` , `current_page` , `last_reload`, `ip_address`) VALUES ('".session_id()."', '".$centreon->user->user_id."', '1', '".time()."', '".$_SERVER["REMOTE_ADDR"]."')");
        if (!isset($_POST["submit"]))	{
            $args = NULL;
            foreach ($_GET as $key => $value) {
                $args ? $args .= "&".$key."=".$value : $args = $key."=".$value;					
            }
            header("Location: ./main.php?".$args."");
        } else {
            header("Location: ./main.php");
        }
        $connect = true;
    } else {
        $connect = false;	    	
    }
}

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|
                        ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|
                        plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||
                        preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|
                        an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w
                        |bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica
                        |dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene
                        |gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)
                        |tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt
                        ( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/
                        |ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )
                        |mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)
                        |oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a
                        |qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)
                        |sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )
                        |sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)
                        |utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)
                        |wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
						
		if (isset($_POST["submit-mobile"])
		|| (isset($_GET["autologin"]) && $_GET["autologin"] && isset($_GET["p"]) && $_GET["autologin"] && isset($generalOptions["enable_autologin"]) && $generalOptions["enable_autologin"])
		|| (isset($_POST["autologin"]) && $_POST["autologin"] && isset($_POST["p"]) && isset($generalOptions["enable_autologin"]) && $generalOptions["enable_autologin"])
		|| (!isset($generalOptions['sso_enable']) || $generalOptions['sso_enable'] == 1)) {
		
		/*
		 * Init log class
		 */
		$CentreonLog = new CentreonUserLog(-1, $pearDB);

		if (isset($_POST['p'])) {
			$_GET["p"] = $_POST["p"];			
		}
		
		/*
		 * Get Connexion parameters
		 */
		isset($_GET["autologin"]) ? $autologin = $_GET["autologin"] : $autologin = 0;
		isset($_GET["useralias"]) ? $useraliasG = $_GET["useralias"] : $useraliasG = NULL;
		isset($_POST["useralias"]) ? $useraliasP = $_POST["useralias"] : $useraliasP = NULL;
		$useraliasG ? $useralias = $useraliasG : $useralias = $useraliasP;
		
		isset($_GET["password"]) ? $passwordG = $_GET["password"] : $passwordG = NULL;
		isset($_POST["password"]) ? $passwordP = $_POST["password"] : $passwordP = NULL;
		$passwordG ? $password = $passwordG : $password = $passwordP;

		$token = "";
		if (isset($_REQUEST['token']) && $_REQUEST['token']) {
			$token = $_REQUEST['token'];
		}

		if (!isset($encryptType)) {
			$encryptType = 1;
		}

		$centreonAuth = new CentreonAuthSSO($useralias, $password, $autologin, $pearDB, $CentreonLog, $encryptType, $token, $generalOptions);

		if ($centreonAuth->passwdOk == 1) {

			$centreon = new Centreon($centreonAuth->userInfos, $generalOptions["nagios_version"]);
			$_SESSION["centreon"] = $centreon;
			$pearDB->query("INSERT INTO `session` (`session_id` , `user_id` , `current_page` , `last_reload`, `ip_address`) VALUES ('".session_id()."', '".$centreon->user->user_id."', '1', '".time()."', '".$_SERVER["REMOTE_ADDR"]."')");
			if (!isset($_POST["submit-mobile"]))	{
				$args = NULL;
				foreach ($_GET as $key => $value) {
					$args ? $args .= "&".$key."=".$value : $args = $key."=".$value;					
				}
				header("Location: ./main.php?p=10");
			}
			$connect = true;
		} else {
			$connect = false;	    	
		}
	}
}

/*
 * Check PHP version
 *
 *  Centreon 2.x doesn't support PHP < 5
 *
 */
if (version_compare(phpversion(), '5.0') < 0){
    echo "<div class='msg'> PHP version is < 5.0. Please Upgrade PHP</div>";
} else {
		//Detect browser type. Redirect on custom login if smartphone detected
			if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|
							ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|
							plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||
							preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|
							an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w
							|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica
							|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene
							|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)
							|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt
							( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/
							|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )
							|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)
							|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a
							|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)
							|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )
							|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)
							|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)
							|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
				include_once("modules/mobile-UI/include/login-mobile.php");
	else{
	include_once("./login.php");}
}

?>