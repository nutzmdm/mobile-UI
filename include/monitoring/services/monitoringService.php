<?php

if (!isset($oreon))
		exit();

//include header
require_once ("./modules/mobile-UI/include/common/header.php");
//include centreon page
require_once $centreon_path."www/include/monitoring/status/monitoringService.php";

//getting url parameters
if (isset ($_GET['num']) && ctype_digit ($_GET['num'])){
	$num = $_GET['num'];}
else {$num = 0;}
if (isset ($_GET['limit']) && ctype_digit ($_GET['limit'])){
	$limit = $_GET['limit'];}
else {$limit = 10;}
if (isset ($_GET['o'])){
	$o = $_GET['o'];}
else {$o = svc;}
if (isset ($_GET['p'])){
	$p = $_GET['p'];}
else {$p = "10";}
if (isset ($_GET['host_name']) ){
	$host_name = $_GET['host_name'];}
else {$host_name = null;}
if (isset ($_GET['service_description']) ){
	$service_description = $_GET['service_description'];}
else {$service_description = null;}
if (isset ($_GET['host_search']) ){
	$monitoringHostSearch = $_GET['host_search'];}
if (isset ($_GET['search']) ){
	$monitoringServiceSearch = $_GET['search'];}
if (isset ($_GET['output_search']) ){
	$monitoringOutputSearch = $_GET['output_search'];}


//getting session parameters
if (isset($_SESSION['centreon']->historySearch['./modules/mobile-UI/include/monitoring/hosts/monitoringHost.php']))
	{$monitoringHostSearch = $_SESSION['centreon']->historySearch['./modules/mobile-UI/include/monitoring/hosts/monitoringHost.php'];}
if (isset($_SESSION['centreon']->historySearchService['./include/monitoring/status/monitoringService.php']))
	{$monitoringServiceSearch = $_SESSION['centreon']->historySearchService['./include/monitoring/status/monitoringService.php'];}
if (isset($_SESSION['centreon']->historySearchOutput['./include/monitoring/status/monitoringService.php']))
	{$monitoringOutputSearch = $_SESSION['centreon']->historySearchOutput['./include/monitoring/status/monitoringService.php'];}

//redirecting user to correct html page
if ($o == svc || $o == svc_ok || $o == svc_warning || $o == svc_critical || $o == svc_unknown || $o == svc_pending || $o == svc_unhandled || $o == svcpb){
//if ($o == svc || $o == svc_unhandled || $o == svcpb){
	include ("./modules/mobile-UI/include/monitoring/services/monitoringServiceMainHTML.php");}
else if ($o == svcd){
	include ("./modules/mobile-UI/include/monitoring/services/monitoringServiceDetailsHTML.php");}
else {exit();}

?>

