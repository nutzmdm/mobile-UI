<?php 
require_once "include_first.php";
$plugin_Filename = "2_plugin_Weathermap.php";

//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------

include_once "../common.php";

$module_name = "php-weathermap";
$query_IsInstalled = mysql_query ('SELECT * FROM modules_informations WHERE name="'.$module_name.'"');
$IsInstalled_module = mysql_fetch_object ($query_IsInstalled);
$query_select_maps =	'SELECT *
						FROM
						'.$conf_centreon['db'].'.pwm_maps';
$result_select_maps = mysql_query ($query_select_maps);

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
	<link href="../../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../js/mobile-UI.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>

</head>

<body>
    <div data-role="page">
        <div data-role="header" data-theme="<?php echo $theme;?>">
			<a href="../mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade">Home</a>
            <h1>Weathermap</h1>
        </div>
		
        <div data-role="content">
			<?php
				if ($IsInstalled_module->name != "php-weathermap")
						{
						echo 'Vous devez installer le module '.$module_name.' pour acc&eacute;der &agrave; cette page.';
						exit();
						}
						
				echo '<ul data-role="listview" data-inset="true">';
				
				$query_show_suffixed = mysql_query('SELECT * FROM '.$conf_centreon['db'].'.mui_opts WHERE mui_opts.opt_type = "opt_weathermap" AND mui_opts.opt_label = "ShowSuffixedMaps"');
				$obj_show_suffixed = mysql_fetch_object ($query_show_suffixed);
				if ($obj_show_suffixed->opt_val == "1")
					{
					$query_mobile_suffixe = mysql_query('SELECT * FROM '.$conf_centreon['db'].'.mui_opts WHERE mui_opts.opt_type = "opt_weathermap" AND mui_opts.opt_label = "SuffixeMaps"');
					$obj_mobile_suffixe = mysql_fetch_object ($query_mobile_suffixe);
					$pattern = '^([a-zA-Z0-9]+)('.$obj_mobile_suffixe->opt_val.')$';
					$result_select_maps = mysql_query ('SELECT * FROM '.$conf_centreon['db'].'.pwm_maps WHERE pwm_maps.pwm_name REGEXP "'.$pattern.'"');
					while($row_select_maps = mysql_fetch_row ($result_select_maps))
						{
						echo 
							'<li class="list-item-maps">
								<a data-transition="slideup" href="show_map.php?id='.$row_select_maps[0].'">
									<div>
									<h5>'.$row_select_maps[2].'</h5>
										<table width="100%">
											<tr>
												<td style="white-space: normal;">
													<font size="1">'.$row_select_maps[3].'</font>
												</td>
											</tr>
										</table>
									</div>
									</a>
								</li>';
						}
					}
				else
					{
					while($obj_select_maps = mysql_fetch_object ($result_select_maps))
						{
						echo 
							'<li class="list-item-maps">
								<a data-transition="slideup" href="show_map.php?id='.$obj_select_maps->pwm_id.'">
									<div>
									<h5>'.$obj_select_maps->pwm_alias.'</h5>
										<table width="100%">
											<tr>
												<td style="white-space: normal;">
													<font size="1">'.$obj_select_maps->pwm_comment.'</font>
												</td>
											</tr>
										</table>
									</div>
									</a>
								</li>';
						}
					}
				echo '</ul>';
			?>
			
		</div>
	</div>
</body>
</html>