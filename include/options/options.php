<?php

if (!isset($oreon))
		exit();

//include header
require_once ("./modules/mobile-UI/include/common/header.php");

if (isset ($_POST['update'])) {
	$tempoScripts = $_POST['tempoScripts'];
	$pageLimit = $_POST['pageLimit'];
	$theme = $_POST['theme'];
	updateOptions($tempoScripts, $pageLimit, $theme);
	}

include ("./modules/mobile-UI/include/options/optionsHTML.php");



?>
