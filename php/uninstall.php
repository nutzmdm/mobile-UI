<?php

if (!isset ($oreon)) {
		exit ();
	}

/*Get Centreon Version*/
$DBRESULT =& $pearDB->query("SELECT `value` FROM `informations` WHERE `key` = 'version' LIMIT 1");
$release = $DBRESULT->fetchRow();
$version = $release["value"];

$rootIndex = $centreon_path."www/index.php";

$originalIndex = $centreon_path.'www/modules/mobile-UI/install/index.'.$version.'.php.ori';

$restoreOriginalIndex = 'cp '.$originalIndex.' '.$rootIndex.'';

$deleteIndexMobile = 'rm '.$centreon_path.'www/indexmobile.php';

shell_exec($restoreOriginalIndex);
shell_exec($deleteIndexMobile);

?>