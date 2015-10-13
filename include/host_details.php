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

$host_id = $_GET['host'];
$hoststatus_id = $_GET['statusid'];

$query_details_host=	'SELECT '.$ndoDB_assoc["db_prefix"].'hosts.alias,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.current_state,
       '.$ndoDB_assoc["db_prefix"].'hosts.display_name,
       '.$ndoDB_assoc["db_prefix"].'hosts.address,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.output,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.has_been_checked,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.current_check_attempt,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.max_check_attempts,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.status_update_time,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.last_check,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.next_check,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.last_state_change,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.last_time_up,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.last_time_down,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.last_time_unreachable,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.state_type,
	   '.$ndoDB_assoc["db_prefix"].'hoststatus.execution_time,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.notifications_enabled,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.problem_has_been_acknowledged,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.acknowledgement_type,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.passive_checks_enabled,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.active_checks_enabled,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.event_handler_enabled,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.percent_state_change,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.latency,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.execution_time,
       '.$ndoDB_assoc["db_prefix"].'hosts.config_type,
       '.$ndoDB_assoc["db_prefix"].'hosts.host_id,
       '.$ndoDB_assoc["db_prefix"].'hoststatus.hoststatus_id
  FROM    '.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hoststatus '.$ndoDB_assoc["db_prefix"].'hoststatus
       INNER JOIN
          '.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
       ON ('.$ndoDB_assoc["db_prefix"].'hoststatus.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id)
 WHERE     ('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
       AND ('.$ndoDB_assoc["db_prefix"].'hosts.host_id = '.$host_id.')
       AND ('.$ndoDB_assoc["db_prefix"].'hoststatus.hoststatus_id = '.$hoststatus_id.')';

$result_details_host = mysql_query ($query_details_host);
$obj_details_host = mysql_fetch_object ($result_details_host);
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
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
	<link href="../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/mobile-UI.js"></script>

</head>

<body>
    <div data-role="page">
        <div data-role="header" data-theme="<?php echo $theme;?>">
			<a href="hosts.php?inerror=<?php echo $_GET['inerror'];?>" data-role="button" data-icon="back" class="ui-btn-left" data-transition="slidedown"><?php echo _("Back")?></a>
			<a href="mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade"><?php echo _("Home")?></a>
            <h1><?php echo _("Details")?></h1>
        </div>
		
		<div data-role="content">
			<font size="2">
			<table width="100%">
				<td width="1%"></td>
				<td style="text-align:center; width:98%"><?php echo _("Host detailed status")?></td>
				<td width="1%"></td>
				</tr>
			</table>
			</font>	
			<h6>
			<font color="#30536D"><b><?php echo _("Name: ")?></font></b><?php echo ''.$obj_details_host->display_name.''; ?>
			<ul data-role="listview" data-inset="true">
				<li>
					<div>
						<font size="1">
							<font color="#30536D"><?php echo _("Alias: ")?></font><?php echo ''.$obj_details_host->alias.' "('.$obj_details_host->address.')"'; ?>
								<table class="tbl-detail">
									<tr>
										<td class="td-titre-tbl-detail"><?php echo _("Host Status")?></td>
											<?php
											if ($obj_details_host->current_state == 0 ) 
											{echo '<td class="td-statut-Up">';echo _("Up");echo '</td>';}
											elseif ($obj_details_host->current_state == 1 )
											{echo '<td class="td-statut-down">';echo _("Down");echo '</td>';}
											elseif ($obj_details_host->current_state == 2 )
											{echo '<td class="td-statut-unreachable">';echo _("Unreachable");echo '</td>';}
											elseif ($obj_details_host->current_state == 3 )
											{echo '<td class="td-statut-pending">';echo _("Pending");echo'</td>';}
										?>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Attempt:")?></td>
										<td class="td-tbl-detail"><?php echo ''.$obj_details_host->current_check_attempt.''; ?>/<?php echo ''.$obj_details_host->max_check_attempts.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Last check:")?></td>
										<td class="td-tbl-detail"><?php echo ''.$obj_details_host->last_check.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Next check:")?></td>
										<td class="td-tbl-detail"><?php echo ''.$obj_details_host->next_check.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Latency:")?></td>
										<td class="td-tbl-detail"><?php echo ''.$obj_details_host->latency.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Execution time")?></td>
										<td class="td-tbl-detail"><?php echo ''.$obj_details_host->execution_time.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Last change")?></td>
										<td class="td-tbl-detail"><?php echo ''.$obj_details_host->last_state_change.''; ?></td>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Active notifications?")?></td>
										<?php
											if ($obj_details_host->notifications_enabled == 0 ) 
											{echo '<td class="td-notif-ctrl-tbl-detail-non">';echo _("No");echo '</td>';}
											elseif ($obj_details_host->notifications_enabled == 1 )
											{echo '<td class="td-notif-ctrl-tbl-detail-oui">';echo _("Yes");echo '</td>';}
										?>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Actives checks")?></td>
										<?php
											if ($obj_details_host->active_checks_enabled == 0 ) 
											{echo '<td class="td-notif-ctrl-tbl-detail-non">';echo _("No");echo '</td>';}
											elseif ($obj_details_host->active_checks_enabled == 1 )
											{echo '<td class="td-notif-ctrl-tbl-detail-oui">';echo _("Yes");echo '</td>';}
										?>
									</tr>
									<tr>
										<td class="td-tbl-detail"><?php echo _("Passives checks")?></td>
										<?php
											if ($obj_details_host->passive_checks_enabled == 0 ) 
											{echo '<td class="td-notif-ctrl-tbl-detail-non">';echo _("No");echo '</td>';}
											elseif ($obj_details_host->passive_checks_enabled == 1 )
											{echo '<td class="td-notif-ctrl-tbl-detail-oui">';echo _("Yes");echo '</td>';}
										?>
									</tr>
								</table>
							</h3>
						</font>
					</div>
				</li>
			</ul>
			<div>
				<font><?php echo _("Host detailed status:")?></font>
				<br />
				<font><?php echo ''.$obj_details_host->output.''; ?></font>
			</div>
			</h6>
		</div>
	</div>
</body>
</html>