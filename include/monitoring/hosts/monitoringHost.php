<?php

if (!isset($oreon))
		exit();

//include header
require_once ("./modules/mobile-UI/include/common/header.php");
//include centreon page
require_once $centreon_path."www/include/monitoring/status/monitoringHost.php";

//getting url parameters
if (isset ($_GET['num']) && ctype_digit ($_GET['num'])){
	$num = $_GET['num'];}
else {$num = 0;}
if (isset ($_GET['limit']) && ctype_digit ($_GET['limit'])){
	$limit = $_GET['limit'];}
else {$limit = 10;}
if (isset ($_GET['o'])){
	$o = $_GET['o'];}
else {$o = h;}
if (isset ($_GET['p'])){
	$p = $_GET['p'];}
else {$p = "10";}
if (isset ($_GET['host_name']) ){
	$host_name = $_GET['host_name'];}
else {$host_name = null;}

//getting session parameters
if (isset($_SESSION['centreon']->historySearch['./modules/mobile-UI/include/monitoring/hosts/monitoringHost.php']))
	{$monitoringHostSearch = $_SESSION['centreon']->historySearch['./modules/mobile-UI/include/monitoring/hosts/monitoringHost.php'];}

//redirecting user to correct html page
if ($o == h || $o == h_up || $o == h_down || $o == h_unreachable || $o == h_pending || $o == h_unhandled || $o == hpb || $o == h_unhandled || $o == svc){
	include ("./modules/mobile-UI/include/monitoring/hosts/monitoringHostMainHTML.php");}
else if ($o == hd){
	include ("./modules/mobile-UI/include/monitoring/hosts/monitoringHostDetailsHTML.php");}
else {exit();}

?>

