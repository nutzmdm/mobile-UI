<?php
require_once "include_first.php";


include_once "common.php";

if (isset ($_GET['instance_id']))
{$instance_id = $_GET['instance_id'];}
else {$instance_id = null;}

$query_instances =	'SELECT
					instance.instance_id,
					instance.instance_name
					FROM
					'.$conf_centreon['dbcstg'].'.instance instance';
$result_instances = mysql_query ($query_instances);

$query_enginestats =	'SELECT 
						nagios_stats.stat_value
						FROM
						'.$conf_centreon['dbcstg'].'.nagios_stats nagios_stats
						INNER JOIN
						'.$conf_centreon['dbcstg'].'.instance instance
						ON
						(nagios_stats.instance_id = instance.instance_id)
						WHERE
						(instance.instance_id = '.$instance_id.')';						
$result_enginestats = mysql_query ($query_enginestats);
?>

<!------------------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------->


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
	<meta name="Generator" content="Centreon - Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved." />
	<meta name="robots" content="index, nofollow" />
	<!--<meta name="viewport" content="width=479px" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!--Import CSS & Javascript-->
	
	<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
	<link href="../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/mobile-UI.js"></script>

<script>
 $(document).ready(function() {
 	 $("#div_recap").load("recap.php");
   var refreshId = setInterval(function() {
      $("#div_recap").load('recap.php');
   }, 10000);
   $.ajaxSetup({ cache: false });
});
</script>
	
</head>

<body>
	<div data-role="page">
	
		<div data-role="header" data-theme="<?php echo $theme;?>">
			<a href="mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade"><?php echo _("Home")?></a>
			<h1><?php echo _("Statistics")?></h1>	
		</div>
			
		<div data-role="content">
			
			<table width="100%">
			<tr>
			<td width="10%">Poller:</td>
			<td width="90%">
			<form method="post">
				<fieldset data-role="fieldcontain">
				<select name="host" onChange="location = this.options[this.selectedIndex].value">
				<?php
					echo '<option value=""></option>';
					while ($array_instances = mysql_fetch_array($result_instances))
						{
						if ($array_instances['instance_id'] == $_GET['instance_id']) 
							{echo '<option selected value="enginestats.php?instance_id='.$array_instances['instance_id'].'">'.htmlentities($array_instances['instance_name']).'</option>';}
						else 	{
								echo '<option value="enginestats.php?instance_id='.$array_instances['instance_id'].'">'.htmlentities($array_instances['instance_name']).'</option>';
								}
						}
						echo '</select>';
				?>
				</fieldset>
			</form>
			</td>
			</tr>
			</table>
			<font size="1">
			<table width="100%">
				<tr style="border:1px solid #fffff2">
					<td colspan="4"style="border:1px solid #BABABA; 
											background-color:#BABABA;
											-webkit-border-radius: 4px;
											-moz-border-radius: 4px;
											border-radius: 4px;"><?php echo _("Actively checked")?></td>
				</tr>
				<tr>
					<td><?php echo _("Time frame")?></td>
					<td><?php echo _("Hosts checked")?></td>
					<td><?php echo _("Services checked")?></td>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><= 1 min</td>
					<td style="border:1px solid #fffff2"><?php	mysql_data_seek ($result_enginestats,6);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,20);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><= 5 min</td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,5);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,19);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><= 15 min</td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,3);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,17);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><= 60 min</td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,4);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,18);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
			</table>	
			
			<table width="100%">
				<tr style="border:1px solid #fffff2">
					<td colspan="4"style="border:1px solid #BABABA; 
											background-color:#BABABA;
											-webkit-border-radius: 4px;
											-moz-border-radius: 4px;
											border-radius: 4px;"><?php echo _("Check latency")?></td>
				</tr>
				<tr>
					<td></td>
					<td><?php echo _("Minimum")?></td>
					<td><?php echo _("Maximum")?></td>
					<td><?php echo _("Average")?></td>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><?php echo _("Hosts")?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,12);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,11);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,10);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><?php echo _("Services")?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,26);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,25);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,24);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
			</table>
			
			<table width="100%">
				<tr style="border:1px solid #fffff2">
					<td colspan="4"style="border:1px solid #BABABA; 
											background-color:#BABABA;
											-webkit-border-radius: 4px;
											-moz-border-radius: 4px;
											border-radius: 4px;"><?php echo _("Checks execution time")?></td>
				</tr>
				<tr>
					<td></td>
					<td><?php echo _("Minimum")?></td>
					<td><?php echo _("Maximum")?></td>
					<td><?php echo _("Average")?></td>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><?php echo _("Hosts")?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,9);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,8);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,7);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><?php echo _("Services")?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,23);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,22);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,21);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
			</table>
			
			<table width="100%">
				<tr style="border:1px solid #fffff2">
					<td colspan="4"style="border:1px solid #BABABA; 
											background-color:#BABABA;
											-webkit-border-radius: 4px;
											-moz-border-radius: 4px;
											border-radius: 4px;"><?php echo _("Buffer usage")?></td>
				</tr>
				<tr>
					<td><?php echo _("In use")?></td>
					<td><?php echo _("Max used")?></td>
					<td><?php echo _("Total available")?></td>
				<tr style="border:1px solid #fffff2">
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,29);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,28);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
					<td style="border:1px solid #fffff2"><?php mysql_data_seek ($result_enginestats,27);
																$obj_enginestats = mysql_fetch_object ($result_enginestats);
																echo $obj_enginestats->stat_value;
																?></td>
				</tr>
			</table>
			</font>
		</div>
	</div>
</body>
</html>