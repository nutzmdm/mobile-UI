<?php

if (!isset($oreon))
		exit();

//include header
require_once ("./modules/mobile-UI/include/common/header.php");
//include centreon page
require_once $centreon_path."www/include/monitoring/comments/commentHost.php";

//getting url parameters
if (isset ($_GET['o'])){
	$o = $_GET['o'];}
else {$o = ah;}
if (isset ($_GET['host_name']) ){
	$host_name = $_GET['host_name'];}
else {$host_name = null;}

//redirecting user to correct html page
include ("./modules/mobile-UI/include/monitoring/comments/commentHostHTML.php");

?>