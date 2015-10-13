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



//--------------------------------------------------------------------------------------------------------------------------------------------					
if(isset($_POST['soumettre']))
	{
	$req_gen_opts_theme_maj = mysql_query ('SELECT * FROM '.$conf_centreon['db'].'.mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
	mysql_query ('UPDATE '.$conf_centreon['db'].'.mui_opts SET opt_val ="'.$_POST['show_icons'].'" WHERE mui_opts.opt_type = "opt_gen" AND mui_opts.opt_label ="show_icons" AND mui_opts.user_id = "'.$centreon->user->user_id.'"');
	mysql_query ('UPDATE '.$conf_centreon['db'].'.mui_opts SET opt_val ="'.$_POST['size_icons'].'" WHERE mui_opts.opt_type = "opt_gen" AND mui_opts.opt_label ="size_icons" AND mui_opts.user_id = "'.$centreon->user->user_id.'"');
	
	while ($array_gen_opts_theme_maj = mysql_fetch_array($req_gen_opts_theme_maj))	
		{
		$selected_opt_gen_theme = $_POST['modif_opt_gen_theme_'.$array_gen_opts_theme_maj['opt_label'].''];						
		$query_update_gen_opts_theme = 'UPDATE '.$conf_centreon['db'].'.mui_opts SET opt_val = "'.$selected_opt_gen_theme.'" WHERE mui_opts.opt_type = "opt_gen" AND mui_opts.opt_label = "Theme" AND mui_opts.user_id = "'.$centreon->user->user_id.'"'; 
		$resultat_update_gen_opts_theme = mysql_query($query_update_gen_opts_theme); 
		}
	$req_plugins_opts_maj = mysql_query ('SELECT mui_opts.opt_type, mui_opts.opt_label, mui_opts.opt_val FROM '.$conf_centreon['db'].'.mui_opts mui_opts WHERE (mui_opts.opt_type = "module_IsActive") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
	while ($array_plugins_maj = mysql_fetch_array($req_plugins_opts_maj))	
		{
		$selected_slider_active_status = $_POST['Activate_plugin_'.$array_plugins_maj['opt_label'].''];
		$query_update_status_module = 'UPDATE '.$conf_centreon['db'].'.mui_opts SET opt_val = "'.$selected_slider_active_status.'" WHERE mui_opts.opt_type = "module_IsActive" AND mui_opts.opt_label = "'.$array_plugins_maj['opt_label'].'" AND mui_opts.user_id = "'.$centreon->user->user_id.'"'; 
		$resultat_update_status_module = mysql_query($query_update_status_module); 
		}
	mysql_query ('UPDATE '.$conf_centreon['db'].'.mui_opts SET opt_val ="'.$_POST['suffixe_maps'].'" WHERE mui_opts.opt_type = "opt_weathermap" AND mui_opts.opt_label ="SuffixeMaps" AND mui_opts.user_id = "'.$centreon->user->user_id.'"');
	mysql_query ('UPDATE '.$conf_centreon['db'].'.mui_opts SET opt_val = "'.$_POST['show_suffixed_maps'].'" WHERE mui_opts.opt_type = "opt_weathermap" AND mui_opts.opt_label ="ShowSuffixedMaps" AND mui_opts.user_id = "'.$centreon->user->user_id.'"');
	}		
	
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
	<meta name="Generator" content="Centreon - Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved." />
	<meta name="robots" content="index, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!--Import CSS & Javascript-->	
	<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
	<link href="../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/mobile-UI.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
	
</head>

<body <?php if (isset ($_POST['soumettre'])){echo 'onLoad="window.location.reload()"';}?>>
	<div data-role="page">
	
		<div data-role="header" data-theme="<?php echo $theme;?>">
			<a href="about.php" data-rel="dialog" data-icon="info" data-iconpos="notext" class="ui-btn-left" data-transition="pop"><?php echo _("About")?></a>
			<a href="mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade"><?php echo _("Home")?></a>
            <h1><?php echo _("Options")?></h1>
		</div>
			
		<div data-role="content">
			<form action="options.php" method="post">
			<?php 	
					echo '<h4>';echo _("General options");echo '<h4>';
					$req_gen_opts_theme = mysql_query  ('SELECT * FROM mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.opt_label = "Theme") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
					$req_gen_opts_show_icons = mysql_query  ('SELECT * FROM mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.opt_label = "show_icons") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
					$req_gen_opts_size_icons = mysql_query  ('SELECT * FROM mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.opt_label = "size_icons") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
					$obj_gen_opts_show_icons = mysql_fetch_object($req_gen_opts_show_icons);
					$obj_gen_opts_size_icons = mysql_fetch_object($req_gen_opts_size_icons);
					echo '<table class="tbl-def">';
					while ($array_opt_gen_theme = mysql_fetch_array($req_gen_opts_theme))
						{
						echo'
							<tr>
								<td class="td-left-opts">
									<h5><div class="div-align-left-opts">';echo _("Theme");echo '</div></h5>
								</td>
								<td class="td-right-opts">
									<div class="div-align-right-opts">
										<select name="modif_opt_gen_theme_'.$array_opt_gen_theme['opt_label'].'">';
						echo 				'<option ';
												if ($array_opt_gen_theme['opt_val'] == "a"){echo 'selected ';}
						echo					 'value="a">a</option>
											<option ';
												if ($array_opt_gen_theme['opt_val'] == "b"){echo 'selected ';}
						echo 					'value="b">b</option>
											<option ';
												if ($array_opt_gen_theme['opt_val'] == "c"){echo 'selected ';}
						echo 					'value="c">c</option>
											<option ';
												if ($array_opt_gen_theme['opt_val'] == "d"){echo 'selected ';}
						echo 					'value="d">d</option>
										</select>
									</div>
								</td>
							</tr>';
						}
						echo '
							<tr>
								<td class="td-left-opts">
									<div class="div-align-left-opts">
										<h5>';echo _("Show hosts and services icons");echo '</h5>
									</div>
								</td>
								<td class="td-right-opts">
									<div class="div-align-right-opts">
										<select name="show_icons" data-role="slider">';
						echo				'<option ';
												if ($obj_gen_opts_show_icons->opt_val == 0){echo 'selected ';}
						echo					'value="0">0</option>
											<option ';
												if ($obj_gen_opts_show_icons->opt_val == 1){echo 'selected ';}
						echo					'value="1">|</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td class="td_left_opts">
									<div class="div-align-left-opts">
										<h5>';echo _("Icons size (in pixels)");echo '</h5>
									</div></td>
								<td class="td-right-opts>
									<div class="div-align-right-opts">
										<input type="text" name="size_icons" value="'.$obj_gen_opts_size_icons->opt_val.'"/>
									</div>
								</td>
							</tr>';
					echo '</table>';
					
					echo '<h4>';echo _("Show modules:");echo '</h4>';  
					//changer le statut d'affichage des plugins
					$req_plugins_opts = mysql_query ('SELECT mui_opts.opt_type, mui_opts.opt_label, mui_opts.opt_val FROM mui_opts mui_opts WHERE (mui_opts.opt_type = "module_IsActive") AND (mui_opts.user_id = "'.$centreon->user->user_id.'")');
					echo '<table class="tbl-def">';
					while ($array_plugins = mysql_fetch_array($req_plugins_opts))
						{
						echo'
							<tr>
								<td class="td-left-opts">
									<h5><div class="div-align-left-opts">'.$array_plugins['opt_label'].'</div></h5>
								</td>
								<td class="td-right-opts">
									<div class="div-align-right-opts">
										<select name="Activate_plugin_'.$array_plugins['opt_label'].'" id="flip-a" data-role="slider">';
						echo 				'<option ';
												if ($array_plugins['opt_val'] == 0){echo 'selected ';}
						echo					 'value="0">0</option>
											<option ';
												if ($array_plugins['opt_val'] == 1){echo 'selected ';}
						echo 					'value="1">|</option>
										</select>
									</div>
								</td>
							</tr>';
						}
					echo '</table>';
					
					//Options d'affichage pour le plugin weathermap
					if ($obj_opts_plugins->label = "weathermap" && $obj_opts_plugins->opt_type = "Module_IsActive" && $obj_opts_plugins->opt_val = "1")
						{
						$req_plugins_opts_weathermap1 = mysql_query ('SELECT * FROM mui_opts WHERE opt_type = "opt_weathermap" AND opt_label="SuffixeMaps" AND mui_opts.user_id = "'.$centreon->user->user_id.'"');
						$req_plugins_opts_weathermap2 = mysql_query ('SELECT * FROM mui_opts WHERE opt_type = "opt_weathermap" AND opt_label="ShowSuffixedMaps" AND mui_opts.user_id = "'.$centreon->user->user_id.'"');
						$obj_opts_plugins_weathermap1 = mysql_fetch_object($req_plugins_opts_weathermap1);
						$obj_opts_plugins_weathermap2 = mysql_fetch_object($req_plugins_opts_weathermap2);
						echo '
							<h4>';echo _("Weathermap options:");echo '</h4>
							<table class="tbl-def">
								<tr>
									<td class="td-left-opts">
										<div class="div-align-left-opts">
											<h5>';echo _("Mobile maps suffix");echo '</h5>
										</div>
									</td>
									<td class="td-right-opts>
										<div class="div-align-right-opts">
											<input type="text" name="suffixe_maps" value="'.$obj_opts_plugins_weathermap1->opt_val.'"/>
										</div>
									</td>
								</tr>
								<tr>
									<td class="td-left-opts">
										<div class="div-align-left-opts">
											<h5>';echo _("Show only maps whose name ends with suffix");echo '</h5>
										</div>
									</td>
									<td class="td-right-opts">
										<div class="div-align-right-opts">
											<select name="show_suffixed_maps" id="flip-b" data-role="slider">';
						echo						'<option ';
														if ($obj_opts_plugins_weathermap2->opt_val == 0){echo 'selected ';}
						echo								'value="0">0</option>
													<option ';
														if ($obj_opts_plugins_weathermap2->opt_val == 1){echo 'selected ';}
						echo								'value="1">|</option>
											</select>
										</div>
									</td>
								</tr>
							</table>';
						}
							
					if(!isset($_POST['soumettre']))
						{
						echo '
								<div class="div-align-center">
									<input type="submit" name="soumettre" value="';echo _("Save");echo '">
								</div>';
						}
					else 
						{
						echo '	<div class="div-align-center">
									<p>';
										echo _("Vos pr&eacute;f&eacute;rences ont &eacute;t&eacute; enregistr&eacute;es");
									echo '</p>
								</div>';
						}
				?>
			</form>	
		</div>
	</div>
</body>
</html>