<?php 
require_once "include_first.php";

//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
include_once "common.php";

$host_id = $_GET['host_id'];
$service_id = $_GET['service_id'];
$servicestatus_id = $_GET['status_id'];

$query_details_service =	'SELECT 
								'.$ndoDB_assoc["db_prefix"].'hosts.alias,
								'.$ndoDB_assoc["db_prefix"].'hosts.display_name AS host_display_name,
								'.$ndoDB_assoc["db_prefix"].'services.service_id,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id,
								'.$ndoDB_assoc["db_prefix"].'services.display_name,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.output,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.perfdata,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.current_state,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.has_been_checked,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.current_check_attempt,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.max_check_attempts,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_check,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.next_check,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_state_change,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.check_type,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_hard_state_change,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_hard_state,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_time_ok,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_time_warning,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_time_unknown,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.last_time_critical,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.state_type,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.execution_time,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.notifications_enabled,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.problem_has_been_acknowledged,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.acknowledgement_type,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.active_checks_enabled,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.passive_checks_enabled,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.latency,
								'.$ndoDB_assoc["db_prefix"].'acknowledgements.acknowledgement_id,
								'.$ndoDB_assoc["db_prefix"].'hosts.config_type
							FROM    
								(('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
							INNER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
							ON 
								('.$ndoDB_assoc["db_prefix"].'services.host_object_id =
								'.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
							INNER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
							ON 
								('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
								'.$ndoDB_assoc["db_prefix"].'services.service_object_id))
							LEFT OUTER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'acknowledgements '.$ndoDB_assoc["db_prefix"].'acknowledgements
							ON 
								('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'acknowledgements.object_id)
							WHERE    
								('.$ndoDB_assoc["db_prefix"].'services.service_id = '.$service_id.')
							AND 
								('.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id = '.$servicestatus_id.')
							AND 
								('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)';

$result_details_service = mysql_query ($query_details_service);
$obj_details_service = mysql_fetch_object ($result_details_service);

?>

<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Centreon - IT & Network Monitoring</title>
	<link rel="shortcut icon" href="./img/favicon.ico"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="index, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!--Import CSS & Javascript-->	
	<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
	<link href="../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/mobile-UI.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>

</head>

<body>
    <div data-role="page">
        <div data-role="header" data-theme="<?php echo $theme;?>">
			<a href="services.php?inerror=<?php echo $_GET['inerror'];?>" data-role="button" data-icon="back" class="ui-btn-left" data-transition="slidedown">Back</a>
			<a href="mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade">Home</a>
			<h1><?php echo _("Details")?></h1>
        </div>
		
		<div data-role="content">
			<font size="2">
			<table width="100%">
				<td width="1%"></td>
				<td style="text-align:center; width:98%"><?php echo _("Service detailed status")?></td>
				<td width="1%"></td>
				</tr>
			</table>
			</font>	
			
			<h6>
				<font color="#30536D"><b><?php echo _("Name:")?></font></b>
					<?php echo ''.$obj_details_service->display_name.' '.$obj_details_service->alias.'' ; ?>
				<ul data-role="listview" data-inset="true">
					<li>
						<div><font size="1">
							<font color="#30536D"><?php echo _("Host is: ")?></font><?php echo ''.$obj_details_service->host_display_name.''; ?>
								<table class="tbl-detail">
									<tr>
										<td class="td-titre-tbl-detail"><?php echo _("Service status")?></td>
											<?php
												if ($obj_details_service->current_state == 0 ) 
													{echo '<td class="td-statut-OK">';echo _("Ok");echo '</td>';}
												elseif ($obj_details_service->current_state == 1 )
													{echo '<td class="td-statut-warning">';echo _("Warning");echo '</td>';}
												elseif ($obj_details_service->current_state == 2 )
													{echo '<td class="td-statut-critical">';echo _("Critical");echo '</td>';}
												elseif ($obj_details_service->current_state == 3 )
													{echo '<td class="td-statut-unknown">';echo _("Unknown");echo '</td>';}
												elseif ($obj_details_service->current_state == 4 )
													{echo '<td class="td-statut-pending">';echo _("Pending");echo '</td>';}
											?>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Attempt:")?></td>
										<td class="td-tbl-detail">
										<?php echo ''.$obj_details_service->current_check_attempt.''; ?>/<?php echo ''.$obj_details_service->max_check_attempts.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Last check:")?></td>
										<td class="td-tbl-detail">
										<?php echo ''.$obj_details_service->last_check.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Next check")?></td>
										<td class="td-tbl-detail">
										<?php echo ''.$obj_details_service->next_check.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Latency:")?></td>
										<td class="td-tbl-detail">
										<?php echo ''.$obj_details_service->latency.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Execution time")?></td>
										<td class="td-tbl-detail">
										<?php echo ''.$obj_details_service->execution_time.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Last change")?></td>
										<td class="td-tbl-detail">
										<?php echo ''.$obj_details_service->last_state_change.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Notifications enabled?")?></td>
										<?php
											if ($obj_details_service->notifications_enabled == 0 ) 
												{echo '<td class="td-notif-ctrl-tbl-detail-non">';echo _("No");echo '</td>';}
											elseif ($obj_details_service->notifications_enabled == 1 )
												{echo '<td class="td-notif-ctrl-tbl-detail-oui">';echo _("Yes");echo '</td>';}
										?>
									</tr>
									<tr>
										<td style="border:1px solid #fffff2"><?php echo _("Active checks")?></td>
										<?php
											if ($obj_details_service->active_checks_enabled == 0 ) 
												{echo '<td class="td-notif-ctrl-tbl-detail-non">'; echo _("No");echo '</td>';}
											elseif ($obj_details_service->active_checks_enabled == 1 )
												{echo '<td class="td-notif-ctrl-tbl-detail-oui">'; echo _("Yes");echo '</td>';}
										?>
									</tr>
									<tr>
										<td style="border:1px solid #fffff2"><?php echo _("Passive checks")?></td>
										<?php
											if ($obj_details_service->passive_checks_enabled == 0 ) 
												{echo '<td class="td-notif-ctrl-tbl-detail-non">';echo _("No");echo '</td>';}
											elseif ($obj_details_service->passive_checks_enabled == 1 )
												{echo '<td class="td-notif-ctrl-tbl-detail-oui">';echo _("Yes");echo '</td>';}
										?>
									</tr>
								</table>
							</font>
						</div>
					</li>
				</ul>
			</h6>
			<div>
				<font><?php echo _("Detailed status")?></font>
				<br />
				<font>
				<?php echo ''.$obj_details_service->output.''; ?>
				</font>
			</div>
		</div>
	</div>	
</body>
</html>
