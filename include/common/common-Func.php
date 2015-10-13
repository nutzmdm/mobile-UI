<?php 

function getUserOptions() {
	global $pearDB, $centreon;
	$rq1 = "SELECT COUNT(*) AS `exist` FROM `mod_mui_opt` WHERE `user_id` = '".$centreon->user->user_id."'";
	$checkOptionsExist =& $pearDB->query($rq1);
	$checkOptionsExistForUser =& $checkOptionsExist->fetchRow();
	if(isset($checkOptionsExistForUser) && $checkOptionsExistForUser['exist'] == 0)
		{
		// create entry if there is no options defined for current user
		$queryCreateOptions = "INSERT INTO `mod_mui_opt` (`user_id`,`limit_display`,`script_execution_tempo`) VALUES ('".$centreon->user->user_id."', '10', '2')";
		$pearDB->query($queryCreateOptions);
		}
	$querySelectUserOptions = "SELECT * FROM `mod_mui_opt` WHERE `user_id` = '".$centreon->user->user_id."'";
	$Options =& $pearDB->query($querySelectUserOptions);
	$userOptions =& $Options->fetchRow();
	return $userOptions;
	}

function updateOptions($tempoScripts, $pageLimit) {
	global $pearDB, $centreon;
	$rq1 = "UPDATE  `mod_mui_opt` SET  `limit_display` =  '".$pageLimit."', `script_execution_tempo` =  '".$tempoScripts."' WHERE  `mod_mui_opt`.`user_id` ='".$centreon->user->user_id."'";
	$updateOptions =& $pearDB->query($rq1);
	return true;
	}
?>