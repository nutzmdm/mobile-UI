<?php

if (!isset($oreon))
		exit();

//include header
require_once ("./modules/mobile-UI/include/common/header.php");

//include centreon page
require_once $centreon_path."www/include/home/home.php";

//getting user options
$userOptions = getUserOptions();
$tempoScripts = $userOptions['script_execution_tempo'];

include ("./modules/mobile-UI/include/home/homeHTML.php");

?>






