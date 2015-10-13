<?php

if (!isset ($oreon)) {
		exit ();
	}

/*Get Centreon Version*/
$DBRESULT =& $pearDB->query("SELECT `value` FROM `informations` WHERE `key` = 'version' LIMIT 1");
$release = $DBRESULT->fetchRow();
$version = $release["value"];

include $centreon_path.'/www/modules/mobile-UI/install/conf.php';

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
file_put_contents($rootIndex, $confIndex);

?>
