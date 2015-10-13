<?php

if (!isset ($oreon)) {
		exit ();
	}

//require_once $centreon_path."www/header.php";

require_once $centreon_path."www/modules/mobile-UI/include/common/common-Func.php";

$userOptions = getUserOptions();
$tempoScripts = $userOptions['script_execution_tempo'];
$pageLimit = $userOptions['limit_display'];

?>