<?php

if (!isset ($oreon)) {
		exit ();
	}

/*Get Centreon Version*/
$DBRESULT =& $pearDB->query("SELECT `value` FROM `informations` WHERE `key` = 'version' LIMIT 1");
$release = $DBRESULT->fetchRow();
$version = $release["value"];

//include $centreon_path.'/www/modules/mobile-UI/install/conf.php';

$rootIndex = $centreon_path."www/index.php";
$modIndex = $centreon_path."www/modules/mobile-UI/install/smartphones.php";
$patchIndexDir = $centreon_path."www/modules/mobile-UI/install/index.patch";

$cpOriginalIndex = 'cp '.$rootIndex.' '.$centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php.ori';
$cpMobileIndex = 'cp '.$modIndex.' '.$centreon_path.'www/';
$chmodOldIndex = 'chmod 775 '.$centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php.ori';
$chmodMobileIndex = 'chmod 775 '.$centreon_path.'www/smartphone.php';
$patchIndex = 'patch '.$rootIndex.' < '.$patchIndexDir;
$chmodIndex = 'chmod 775 '.$centreon_path.'www/index.php';

shell_exec($cpOriginalIndex);
shell_exec($cpMobileIndex);
shell_exec($chmodOldIndex);
shell_exec($chmodMobileIndex);
shell_exec($patchIndex);
shell_exec($chmodIndex);

?>
