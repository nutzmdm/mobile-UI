<?php 
require_once "include_first.php";
$plugin_Filename = "1_plugin_Syslog.php";

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

$module_name = "Syslog";
$query_IsInstalled = mysql_query ('SELECT * FROM modules_informations WHERE name="'.$module_name.'"');
$IsInstalled_module = mysql_fetch_object ($query_IsInstalled);

require_once "SyslogDBconnect.php";

// Numéro de la page à afficher
if(isset ($_GET['page'])) {
$page = $_GET['page'];}
else { $page = 0; }

// Nombre de résultats par page
if(isset($_GET['nb'])){
$nb = $_GET["nb"];}
else { $nb = 5;}

//hote à afficher
if(isset($_GET['host'])) {
$host = $_GET['host'];}
else {$host= null;}


// Nombre total d'enregistrements
$sql = 'SELECT COUNT(*) FROM logs';
$query = mysql_query($sql);
$row = mysql_fetch_row($query);
$total = $row[0];

// Nombre d'enregistrements pour l'hôte sélectionné
$count_selected_host = 'SELECT COUNT(*) FROM logs WHERE `host`="'.$host.'"';
$query_count_selected_host = mysql_query ($count_selected_host);
$nbr_selected_host = mysql_fetch_row ($query_count_selected_host);
$total_selected_hots = $nbr_selected_host[0];

// Nombre maximum de pages
$max_pg = ceil($total / $nb);
$max_pg_selected_host = ceil($total_selected_hots / $nb);

// Sélection de la requete en fonction de la selection ou non d'un hote
if (empty ($_GET['host']))
	{$query_syslog =	'SELECT *
					FROM `logs`
					ORDER BY  `logs`.`datetime` DESC
					LIMIT '.($page * $nb).','.$nb.'';}
	else	{$query_syslog =	'SELECT *
								FROM `logs`
								WHERE `host`="'.$host.'"
								ORDER BY  `logs`.`datetime` DESC
								LIMIT '.($page * $nb).','.$nb.'';
			}
							
$query_list_hosts =	'SELECT logs.host 
					FROM centsyslog.logs logs 
					GROUP BY logs.host';
					
//extraction de la traduction des facility
$query_facility_trad = 	'SELECT mod_syslog_filters_facility.*
						FROM '.$conf_centreon['db'].'.mod_syslog_filters_facility mod_syslog_filters_facility';
				
?>

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
            <h1>Syslog</h1>
        </div>
        
		<div data-role="content">
			<?php
				if ($IsInstalled_module->name != "Syslog")
					{
					echo 'Vous devez installer le module '.$module_name.' pour acc&eacute;der &agrave; cette page.';
					exit();
					}
				$result_list_hosts = mysql_query($query_list_hosts);
				echo '	<form method="post">';
				echo '		<fieldset data-role="fieldcontain">';
				echo '			<table style="width:100%; border:1px solid #D0D0D0"">';
				echo '				<tr>
										<td style="text-align:left; width:10%;">
											<label>H&ocirc;te(s):</label>
										</td>';
				echo '					<td style="text-align:left; width:90%;">
											<select name="host" onChange="location = this.options[this.selectedIndex].value">';
												if (!isset ($host))	
													{
				echo '								<option selected value ="'.$plugin_Filename.'?page='.$page.'&nb='.$nb.'">
														Tous
													</option>';
													while ($array_list_hosts = mysql_fetch_array($result_list_hosts))
														{
				echo '									<option value="'.$plugin_Filename.'?page='.$page.'&nb='.$nb.'&host='.$array_list_hosts['host'].'">
															'.htmlentities($array_list_hosts['host']).'
														</option>';
														}					
				echo '						</select>';
													}
												else
													{ 
				echo '								<option value ="'.$plugin_Filename.'?page='.$page.'&nb='.$nb.'">Tous</option>';
													while ($array_list_hosts = mysql_fetch_array($result_list_hosts))
														{											
														if ($array_list_hosts['host'] == $host) 
															{
				echo '										<option selected value="'.$plugin_Filename.'?page='.$page.'&nb='.$nb.'&host='.$array_list_hosts['host'].'">
																'.htmlentities($array_list_hosts['host']).'
															</option>';
															}
														else	
															{
				echo '										<option value="'.$plugin_Filename.'?page='.$page.'&nb='.$nb.'&host='.$array_list_hosts['host'].'">
																'.htmlentities($array_list_hosts['host']).'
															</option>';}
														}
				echo '						</select>';
													}
				echo '					</td>';				
				echo '			</table>';
				echo '		</fieldset>';
				echo '	</form>';
			?>	
				
			<br />
			
			<table style="width:100%; border:1px solid #D0D0D0">
				<tr>
					<td>Pge N&deg;:</td>
					<td>R&eacute;sultats/page:</td>
				</tr>
				<tr>
					<td style="text-align:left; width:40%;">
						<select name="pge_number" onChange="location = this.options[this.selectedIndex].value">							
							<?php
								if (!isset($_GET['host']))
									{
									for($i = 0 ; $i < $max_pg ; $i++) 
										{										
										if ($i == $page)
											{
								echo '		<option selected value="'.$plugin_Filename.'?page='.$i.'&nb='.$nb.'">
												'.$i.'
											</option>';
											}
											else 
												{
								echo '			<option value="'.$plugin_Filename.'?page='.$i.'&nb='.$nb.'">
													'.$i.'
												</option>';
												}
										}
									}
								else	
									{
									for($i = 0 ; $i < $max_pg_selected_host ; $i++) 
										{
										if ($i == $_GET['page'])
											{
								echo '		<option selected value="'.$plugin_Filename.'?page='.$i.'&nb='.$nb.'&host='.$_GET['host'].'">
												'.$i.'
											</option>';
											}
											else 
												{
								echo '			<option value="'.$plugin_Filename.'?page='.$i.'&nb='.$nb.'&host='.$_GET['host'].'">
													'.$i.'
												</option>';
												}
										}
									}
							?>
						</select>
					</td>	
				 	<td style="text-align:left; width:60%;"><select name="results_pge" onChange="location = this.options[this.selectedIndex].value">									
							<?php	
								if (!isset ($_GET['nb']))	
									{
									echo '<option selected value="'.$plugin_Filename.'?page='.$page.'&nb=5';
										if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
										echo '">5</option>';
									echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=10';
										if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
										echo '">10</option>';
									echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=15';
										if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
										echo '">15</option>';
									echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=20';
										if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
										echo '">20</option>';
									}
								else
									{
										if ($nb == 5)
										{	echo '<option selected value="'.$plugin_Filename.'?page='.$page.'&nb=5';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">5</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=10';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">10</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=15';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">15</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=20';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">20</option>';
										}
										elseif ($nb == 10)
										{	echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=5';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">5</option>';
											echo '<option selected value="'.$plugin_Filename.'?page='.$page.'&nb=10';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">10</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=15';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">15</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=20';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">20</option>';
										}
										elseif ($nb == 15)
										{	echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=5';
											if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">5</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=10';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">10</option>';
											echo '<option selected value="'.$plugin_Filename.'?page='.$page.'&nb=15';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">15</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=20';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">20</option>';
										}
										elseif ($nb == 20)
										{	echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=5';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">5</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=10';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">10</option>';
											echo '<option value="'.$plugin_Filename.'?page='.$page.'&nb=15';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">15</option>';
											echo '<option selected value="'.$plugin_Filename.'?page='.$page.'&nb=20';
												if (isset ($_GET['host'])) {echo'&host='.$_GET['host'].'';}
												echo '">20</option>';
										}
									}
									?>
							</select>
					</td>				
				</tr>
			</table>
		<h6>
			<ul data-role="listview" data-inset="true">
					<?php 
						$result_query_syslog = mysql_query ($query_syslog);
						while($obj_query_syslog = mysql_fetch_object ($result_query_syslog))
						{ 
							echo "<li class='list-item-syslog'>";
							echo	'<a href="detail_event_syslog.php?&page='.$page.'&nb'.$nb.'&host='.$host.'&event_id='.$obj_query_syslog->seq.'">';
							echo	'<div id="list-item-syslog">';
							echo	"<font size='1'>";
							echo	$obj_query_syslog->datetime;
							echo	"<br />";
							echo	"<table style='border:1px solid #D0D0D0'>";
							echo	"<tr>";
							echo	"<td>H&ocirc;te</td>";
							echo	"<td style='border:1px solid #D0D0D0'>Marqueur</td>";
							echo	"<td style='border:1px solid #D0D0D0'>Priorit&eacute;</td>";
							echo	"</tr>";
							echo	"<tr style='border:1px solid #D0D0D0'>";
							echo	"<td style='border:1px solid #D0D0D0'>$obj_query_syslog->host</td>";
							echo	"<td style='border:1px solid #D0D0D0'>";
																			if	($obj_query_syslog->facility == 0)
																				{echo "kern";}
																			elseif	($obj_query_syslog->facility == 1)
																				{echo "user";}
																			elseif	($obj_query_syslog->facility == 2)
																				{echo "mail";}
																			elseif	($obj_query_syslog->facility == 3)
																				{echo "daemon";}
																			elseif	($obj_query_syslog->facility == 4)
																				{echo "security/auth";}
																			elseif	($obj_query_syslog->facility == 5)
																				{echo "syslog internal";}
																			elseif	($obj_query_syslog->facility == 6)
																				{echo "lpr";}
																			elseif	($obj_query_syslog->facility == 7)
																				{echo "news";}
																			elseif	($obj_query_syslog->facility == 8)
																				{echo "uucp";}
																			elseif	($obj_query_syslog->facility == 9)
																				{echo "cron";}
																			elseif	($obj_query_syslog->facility == 10)
																				{echo "authpriv";}
																			elseif	($obj_query_syslog->facility == 11)
																				{echo "ftp";}
																			elseif	($obj_query_syslog->facility == 12)
																				{echo "ntp";}
																			elseif	($obj_query_syslog->facility == 13)
																				{echo "log audit";}
																			elseif	($obj_query_syslog->facility == 14)
																				{echo "log alert";}
																			elseif	($obj_query_syslog->facility == 15)
																				{echo "clock daemon";}
																			elseif	($obj_query_syslog->facility == 16)
																				{echo "local0";}
																			elseif	($obj_query_syslog->facility == 17)
																				{echo "local1";}
																			elseif	($obj_query_syslog->facility == 18)
																				{echo "local2";}
																			elseif	($obj_query_syslog->facility == 19)
																				{echo "local3";}
																			elseif	($obj_query_syslog->facility == 20)
																				{echo "local4";}
																			elseif	($obj_query_syslog->facility == 21)
																				{echo "local5";}
																			elseif	($obj_query_syslog->facility == 22)
																				{echo "local6";}
																			elseif	($obj_query_syslog->facility == 23)
																				{echo "local7";}
							echo	"</td>";
							if ($obj_query_syslog->priority == "emergency")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF00FF'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "emerg")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF00FF'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "panic")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF0000'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "alert")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF0000'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "critical")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF4200'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "crit")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF4200'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "error")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF6A00'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "err")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FF6A00'>";
									echo $obj_query_syslog->priority;}									
							elseif ($obj_query_syslog->priority == "warning")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FFFF00'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "warn")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FFFF00'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "notice")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#A0FFA0'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "informational")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#A0FFA0'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "info")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#6DFF6D'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "debug")
								{	echo	"<td style='border:1px solid #D0D0D0; background-color:#FFFFFF'>";
									echo $obj_query_syslog->priority;}
							echo 	"</td>";
							echo	"</tr></table>";
							echo	"<p>";
							echo	"<br />";
							echo	"$obj_query_syslog->tag: $obj_query_syslog->program";
							echo	"<br />";
							echo	$obj_query_syslog->msg;
							echo	"</p>";
							echo 	"</font>";
							echo 	"</div>";							
							echo	"</a>";
							echo 	"</li>";
						}
					?>
			</ul>
		</h6>	
	</div>
</div>

</body>
</html>

<?php mysql_close($link_DB_syslog); ?>