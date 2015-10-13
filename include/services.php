<?php 

require_once "include_first.php";

//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------

include_once "common.php";

if (isset ($_GET['nb']) && ctype_digit ($_GET['nb'])){
	$nb = $_GET['nb'];}
else {$nb = 5;}

if(isset ($_GET['page']) && ctype_digit($_GET['page'])) {
$page = $_GET['page'];}
else  { $page = 0; }

$opt_icon_size = mysql_query  ('SELECT * FROM '.$conf_centreon['db'].'.mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.opt_label = "size_icons") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
$opt_icon_show = mysql_query  ('SELECT * FROM '.$conf_centreon['db'].'.mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.opt_label = "show_icons") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
$obj_opt_icon_size = mysql_fetch_object ($opt_icon_size);
$obj_opt_icon_show = mysql_fetch_object ($opt_icon_show);

if (isset ($_POST['search_input']) or (isset ($_GET['search'])))
	{
	if (isset ($_POST['search_input'])){$search = $_POST['search_input'];}
	elseif (isset ($_GET['search'])){$search = $_GET['search'];}
	$query_service_status 	=	'SELECT 
								'.$ndoDB_assoc["db_prefix"].'hosts.host_id,
								'.$ndoDB_assoc["db_prefix"].'hosts.alias,
								'.$ndoDB_assoc["db_prefix"].'services.service_id,
								'.$ndoDB_assoc["db_prefix"].'services.display_name,
								'.$ndoDB_assoc["db_prefix"].'services.icon_image,
								'.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id
								FROM
								('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
								INNER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
								ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
								INNER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
								ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
								'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
								WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
								AND ('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))
								AND (('.$ndoDB_assoc["db_prefix"].'services.display_name LIKE "%'.$search.'%")
								OR ('.$ndoDB_assoc["db_prefix"].'hosts.alias LIKE "%'.$search.'%"))
								LIMIT '.($page * $nb).','.$nb.'';
	$count_selected_service =	'SELECT COUNT(*)
								FROM
								('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
								INNER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
								ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
								INNER JOIN
								'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
								ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
								'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
								WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
								AND ('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))
								AND (('.$ndoDB_assoc["db_prefix"].'services.display_name LIKE "%'.$search.'%")
								OR ('.$ndoDB_assoc["db_prefix"].'hosts.alias LIKE "%'.$search.'%"))';
	$query_count_selected_service = mysql_query($count_selected_service);
	$row_count_selected_service = mysql_fetch_row($query_count_selected_service);
	$total_count_selected_service = $row_count_selected_service[0];
	$max_pg = ceil($total_count_selected_service / $nb);
	}
else {

	if (!isset ($_GET['inerror']))
		{
		$inerror = "2";
		$query_service_status	=	'SELECT 
									'.$ndoDB_assoc["db_prefix"].'hosts.host_id,
									'.$ndoDB_assoc["db_prefix"].'hosts.alias,
									'.$ndoDB_assoc["db_prefix"].'hosts.config_type,
									'.$ndoDB_assoc["db_prefix"].'services.service_id,
									'.$ndoDB_assoc["db_prefix"].'services.config_type,
									'.$ndoDB_assoc["db_prefix"].'services.display_name,
									'.$ndoDB_assoc["db_prefix"].'services.icon_image,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.output,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.current_state,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.last_state_change
									FROM
									('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
									ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
									ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
									'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
									WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
									AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))
									LIMIT '.($page * $nb).','.$nb.'';
		$count_selected_service =	'SELECT COUNT(*)
									FROM
									('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
									ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
									ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
									'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
									WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
									AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))';
		$query_count_selected_service = mysql_query($count_selected_service);
		$row_count_selected_service = mysql_fetch_row($query_count_selected_service);
		$total_count_selected_service = $row_count_selected_service[0];
		$max_pg = ceil($total_count_selected_service / $nb);
		}

	elseif ($_GET['inerror'] == 1)
		{
		$inerror = "1";
		$query_service_status 	=	'SELECT 
									'.$ndoDB_assoc["db_prefix"].'hosts.host_id,
									'.$ndoDB_assoc["db_prefix"].'hosts.alias,
									'.$ndoDB_assoc["db_prefix"].'hosts.config_type,
									'.$ndoDB_assoc["db_prefix"].'services.service_id,
									'.$ndoDB_assoc["db_prefix"].'services.config_type,
									'.$ndoDB_assoc["db_prefix"].'services.display_name,
									'.$ndoDB_assoc["db_prefix"].'services.icon_image,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.output,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.current_state,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.last_state_change
									FROM
									('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
									ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
									ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
									'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
									WHERE (('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 1)
									OR ('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 2)
									OR ('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 3)
									OR ('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 4))
									AND('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
									AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0)
									LIMIT '.($page * $nb).','.$nb.'';
		$count_selected_service =	'SELECT COUNT(*)
									FROM
									('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
									ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
									ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
									'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
									WHERE (('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 1)
									OR ('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 2)
									OR ('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 3)
									OR ('.$ndoDB_assoc["db_prefix"].'servicestatus.current_state = 4))
									AND('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
									AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0)';
		$query_count_selected_service = mysql_query($count_selected_service);
		$row_count_selected_service = mysql_fetch_row($query_count_selected_service);
		$total_count_selected_service = $row_count_selected_service[0];
		$max_pg = ceil($total_count_selected_service / $nb);
		}

	elseif ($_GET['inerror'] == 2)
		{
		$inerror = "2";
		$query_service_status 	=	'SELECT 
									'.$ndoDB_assoc["db_prefix"].'hosts.host_id,
									'.$ndoDB_assoc["db_prefix"].'hosts.alias,
									'.$ndoDB_assoc["db_prefix"].'hosts.config_type,
									'.$ndoDB_assoc["db_prefix"].'services.service_id,
									'.$ndoDB_assoc["db_prefix"].'services.config_type,
									'.$ndoDB_assoc["db_prefix"].'services.display_name,
									'.$ndoDB_assoc["db_prefix"].'services.icon_image,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.output,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.current_state,
									'.$ndoDB_assoc["db_prefix"].'servicestatus.last_state_change
									FROM
									('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
									ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
									ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
									'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
									WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
									AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))
									LIMIT '.($page * $nb).','.$nb.'';
		$count_selected_service =	'SELECT COUNT(*)
									FROM
									('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
									ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
									INNER JOIN
									'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
									ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
									'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
									WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
									AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))';
		$query_count_selected_service = mysql_query($count_selected_service);
		$row_count_selected_service = mysql_fetch_row($query_count_selected_service);
		$total_count_selected_service = $row_count_selected_service[0];
		$max_pg = ceil($total_count_selected_service / $nb);
		}
	
	else 	{
			$inerror = "2";
			$query_service_status 	=	'SELECT 
										'.$ndoDB_assoc["db_prefix"].'hosts.host_id,
										'.$ndoDB_assoc["db_prefix"].'hosts.alias,
										'.$ndoDB_assoc["db_prefix"].'hosts.config_type,
										'.$ndoDB_assoc["db_prefix"].'services.service_id,
										'.$ndoDB_assoc["db_prefix"].'services.config_type,
										'.$ndoDB_assoc["db_prefix"].'services.display_name,
										'.$ndoDB_assoc["db_prefix"].'services.icon_image,
										'.$ndoDB_assoc["db_prefix"].'servicestatus.servicestatus_id,
										'.$ndoDB_assoc["db_prefix"].'servicestatus.output,
										'.$ndoDB_assoc["db_prefix"].'servicestatus.current_state,
										'.$ndoDB_assoc["db_prefix"].'servicestatus.last_state_change
										FROM
										('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
										INNER JOIN
										'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
										ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
										INNER JOIN
										'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
										ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
										'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
										WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
										AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))
										LIMIT '.($page * $nb).','.$nb.'';
			$count_selected_service =	'SELECT COUNT(*)
										FROM
										('.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'services '.$ndoDB_assoc["db_prefix"].'services
										INNER JOIN
										'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'hosts '.$ndoDB_assoc["db_prefix"].'hosts
										ON ('.$ndoDB_assoc["db_prefix"].'services.host_object_id = '.$ndoDB_assoc["db_prefix"].'hosts.host_object_id))
										INNER JOIN
										'.$ndoDB_assoc["db_name"].'.'.$ndoDB_assoc["db_prefix"].'servicestatus '.$ndoDB_assoc["db_prefix"].'servicestatus
										ON ('.$ndoDB_assoc["db_prefix"].'servicestatus.service_object_id =
										'.$ndoDB_assoc["db_prefix"].'services.service_object_id)
										WHERE (('.$ndoDB_assoc["db_prefix"].'hosts.config_type = 0)
										AND('.$ndoDB_assoc["db_prefix"].'services.config_type = 0))';
			$query_count_selected_service = mysql_query($count_selected_service);
			$row_count_selected_service = mysql_fetch_row($query_count_selected_service);
			$total_count_selected_service = $row_count_selected_service[0];
			$max_pg = ceil($total_count_selected_service / $nb);
			}
		}

$result_service_status = mysql_query ($query_service_status);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Centreon - IT & Network Monitoring</title>
	<link rel="shortcut icon" href="./img/favicon.ico"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="index, nofollow" />
	<!--<meta name="viewport" content="width=479px" />-->
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
		<a href="mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade">Home</a>
            <h1><?php echo _("Services")?></h1>
        </div>
		
        <div data-role="content">
		
			<table width="100%">
			<tr><td width="100%" align="center">
				<form method="post">
				<input type="search" name="search_input" id="search"<?php if (isset ($_POST['search_input'])) {echo ' value="'.$_POST['search_input'].'"';}?>/>
				</form>
			</td></tr>
			<tr><td width="100%" align="center">
			<form method="post">
				<fieldset data-role="fieldcontain">
				<select name="host" onChange="location = this.options[this.selectedIndex].value">
					<option <?php if ($inerror == 2) {echo "selected ";} echo 'value="services.php?inerror=2"';?>><?php echo _("All services")?></option>
					<option <?php if ($inerror == 1) {echo "selected ";} echo 'value="services.php?inerror=1"';?>><?php echo _("Services problems")?></option>
					<?php if (isset ($_POST['search_input'])or isset ($_GET['search'])) {echo '<option selected>'; echo _("Search results");echo '</option>';}?>
				</select>
				</fieldset>
			</form>
			</td></tr>
			</table>
			
			<table style="width:100%">
				<tr><td><font size="2"><?php echo _("Pge N&deg;:")?></font></td><td><font size="2"><?php echo _("Results/page:")?></font></td></tr>
				<tr>
					<td style="text-align:left; width:40%;">
					<form method="post">
					<fieldset data-role="fieldcontain"><select name="pge_number" onChange="location = this.options[this.selectedIndex].value">							
						<?php
							
									for($i = 0 ; $i < $max_pg ; $i++) 
										{
										if ($i == $page)
											{echo '<option selected value="services.php?page='.$i.'&nb='.$nb.'&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
										echo'">'.$i.'</option>';}
										else 
											{echo '<option value="services.php?page='.$i.'&nb='.$nb.'&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
										echo'">'.$i.'</option>';}
										}
									
						?>
						</select></fieldset></form>
					</td>
						
				 	<td style="text-align:left; width:60%;"><select name="results_pge" onChange="location = this.options[this.selectedIndex].value">									
						<?php	if (!isset ($_GET['nb']))	
									{
									echo '<option selected value="services.php?page='.$page.'&nb=5&inerror='.$inerror.'';
											if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
										echo '">5</option>';
									echo '<option value="services.php?page='.$page.'&nb=10&inerror='.$inerror.'';
											if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
										echo '">10</option>';
									echo '<option value="services.php?page='.$page.'&nb=15&inerror='.$inerror.'';
											if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
										echo '">15</option>';
									echo '<option value="services.php?page='.$page.'&nb=20&inerror='.$inerror.'';
											if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
										echo '">20</option>';
									}
								else
									{
										if ($nb == 5)
										{	echo '<option selected value="services.php?page='.$page.'&nb=5&inerror='.$inerror.'';
												if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">5</option>';
											echo '<option value="services.php?page='.$page.'&nb=10&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">10</option>';
											echo '<option value="services.php?page='.$page.'&nb=15&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">15</option>';
											echo '<option value="services.php?page='.$page.'&nb=20&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">20</option>';
										}
										elseif ($nb == 10)
										{	echo '<option value="services.php?page='.$page.'&nb=5&inerror='.$inerror.'';
												if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">5</option>';
											echo '<option selected value="services.php?page='.$page.'&nb=10&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">10</option>';
											echo '<option value="services.php?page='.$page.'&nb=15&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">15</option>';
											echo '<option value="services.php?page='.$page.'&nb=20&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">20</option>';
										}
										elseif ($nb == 15)
										{	echo '<option value="services.php?page='.$page.'&nb=5&inerror='.$inerror.'';
												if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">5</option>';
											echo '<option value="services.php?page='.$page.'&nb=10&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">10</option>';
											echo '<option selected value="services.php?page='.$page.'&nb=15&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">15</option>';
											echo '<option value="services.php?page='.$page.'&nb=20&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">20</option>';
										}
										elseif ($nb == 20)
										{	echo '<option value="services.php?page='.$page.'&nb=5&inerror='.$inerror.'';
												if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">5</option>';
											echo '<option value="services.php?page='.$page.'&nb=10&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">10</option>';
											echo '<option value="services.php?page='.$page.'&nb=15&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">15</option>';
											echo '<option selected value="services.php?page='.$page.'&nb=20&inerror='.$inerror.'';
													if (isset ($_POST['search_input']))
														{echo '&search='.$_POST['search_input'].'';}
													elseif (isset ($_GET['search']))
														{echo '&search='.$_GET['search'].'';}
												echo '">20</option>';
										}
									}
									?>
							</select>
					</td>
				
				</tr>
			</table>
			
			<ul data-role="listview" data-inset="true">
				<?php
				
					while($obj_service_status = mysql_fetch_object ($result_service_status))
						{ 
							echo '	
									<li class="list-item-services">
									<a data-transition="slideup" href="service_details.php?host_id='.$obj_service_status->host_id.'&service_id='.$obj_service_status->service_id.'&status_id='.$obj_service_status->servicestatus_id.'&inerror='.$inerror.'">
										<div>
											<table class="tbl-service-status">
												<tr>';
													if ($obj_opt_icon_show->opt_val == 1)
														{
														echo '	<td class="td1-host-status">
																	<img src="icone.php?HostIconPath='.$obj_service_status->icon_image.'&IconSize='.$obj_opt_icon_size->opt_val.'"svce=1" />
																</td>';
														}
							echo'					<td class="td2-service-status"><font size="2">
													'.$obj_service_status->alias.'
													</td>
													<td class=td3-service-status">
														<img src="img/std_small_service_'.$obj_service_status->current_state.'.png" />
													</td>
												</tr>
											</table>
										</div>
									</a>
									</li>';
						}
					
				?>
			</ul>
		</div>
	</div>
</body>
</html>