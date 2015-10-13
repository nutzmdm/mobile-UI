<?php
if (!isset ($oreon)) {
		exit ();
	}
/*Get Centreon Version*/
$DBRESULT =& $pearDB->query("SELECT `value` FROM `informations` WHERE `key` = 'version' LIMIT 1");
$release = $DBRESULT->fetchRow();
$version = $release["value"];

include $centreon_path.'/www/modules/mobile-UI/install/conf.php';

if (isset ($_POST['patchIndexButton'])){

	$rootIndex = $centreon_path."www/index.php";

	//downloading last versions
	$downloadIndex = 'cd modules/mobile-UI/install/ && wget -t 2 -nc https://raw.githubusercontent.com/nutzmdm/Mobile-UI/master/install/index.'.$version.'.php';
	$downloadGenericIndex = 'cd modules/mobile-UI/install/ && wget -t 2 -nc https://raw.githubusercontent.com/nutzmdm/Mobile-UI/master/install/index.generic.php';

	shell_exec($downloadIndex);
	shell_exec($downloadGenericIndex);

	if (file_exists ($centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php')){
		$modIndex = $centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php';}
	else {$modIndex = $centreon_path.'www/modules/mobile-UI/install/index.generic.php';}

	$cpOriginalIndex = 'cp '.$rootIndex.' '.$centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php.ori';
	$cpNewIndex = 'cp '.$modIndex.' '.$rootIndex.'';
	$chmodOldIndex = 'chmod 775 '.$centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php.ori';

	shell_exec($cpOriginalIndex);
	shell_exec($cpNewIndex);
	shell_exec($chmodOldIndex);

	$confIndex = str_replace('@CENTREON_ETC@', $etc, file_get_contents($rootIndex)); 
	file_put_contents($rootIndex, $confIndex);}

$openRootIndex = file_get_contents(''.$centreon_path.'/www/index.php');
$verifVersion = strpos($openRootIndex, 'Patched version for Mobile-ui module');

if ($verifVersion === false){
	echo '<br /><br /><br />';
	echo '<table style="width:100%"><tr><td style="text-align:center">';
	echo 'You need to patch index.php in order to detect mobile browsers.';
	echo '<br /><br /><br />';
	echo '</td></tr><tr><td style="text-align:center">';
	echo '<form action="./main.php?p=628" method="post" name="patch"><input type="Submit" name="patchIndexButton" value="&nbsp;&nbsp;&nbsp;&nbsp;hit me to patch your index.php&nbsp;&nbsp;&nbsp;&nbsp;"></form>';
	echo '<br /><br /><br />';
	echo '</td></tr></table>';}

else {
	echo '<br /><br /><br />';
	echo '<table style="width:100%"><tr><td style="text-align:center">';
	echo 'index.php already patched to detect mobile browsers. Nothing to do here!';
	echo '</td></tr></table>';
	echo '<br /><br /><br />';}

?>