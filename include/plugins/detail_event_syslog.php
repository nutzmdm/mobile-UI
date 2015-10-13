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

require_once "SyslogDBconnect.php";

if(isset($_GET['page'])) {
$page = $_GET['page'];}
else  { $page = 0; }

if(isset($_GET['nb'])){
$nb = $_GET["nb"];}
else { $nb = 5;}

if(isset($_GET['host'])) {
$host = $_GET["host"];}
else { $host = null;}
$query_syslog = 'SELECT *
				FROM
				logs
				WHERE
				seq = "'.$_GET['event_id'].'"';
$result_syslog = mysql_query ($query_syslog);
$obj_query_syslog = mysql_fetch_object ($result_syslog);				
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
	<link href="../../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../js/mobile-UI.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>

</head>
<body>
    <div data-role="page">
        <div data-role="header" data-theme="<?php echo $theme;?>">
		<a href="1_plugin_Syslog.php?<?php echo '&page='.$page.'&nb='.$nb.'&host='.$host.'';?>" data-role="button" data-icon="back" class="ui-btn-left" data-transition="slidedown">Back</a>
		<a href="../mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade">Home</a>
            <h1>D&eacute;tails</h1>
        </div>
        <div data-role="content">
		<h6>
			<ul data-role="listview" data-inset="true">
					<?php 
						$result_query_syslog = mysql_query ($query_syslog);
						
						
							echo "<li class='list-item-syslog'>";
							echo	"<div class='list-item-syslog'>";
							echo	"<font size='1'>";
							echo	$obj_query_syslog->datetime;
							echo	"<br />";
							echo	"<table style='border:1px solid #fffff2'>";
							echo	"<tr>";
							echo	"<td>H&ocirc;te</td>";
							echo	"<td style='border:1px solid #fffff2'>Marqueur</td>";
							echo	"<td style='border:1px solid #fffff2'>Priorit&eacute;</td>";
							echo	"</tr>";
							echo	"<tr style='border:1px solid #fffff2'>";
							echo	"<td style='border:1px solid #fffff2'>$obj_query_syslog->host</td>";
							echo	"<td style='border:1px solid #fffff2'>";
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
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF00FF'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "emerg")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF00FF'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "panic")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF0000'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "alert")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF0000'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "critical")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF4200'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "crit")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF4200'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "error")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF6A00'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "err")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FF6A00'>";
									echo $obj_query_syslog->priority;}									
							elseif ($obj_query_syslog->priority == "warning")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FFFF00'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "warn")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FFFF00'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "notice")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#A0FFA0'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "informational")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#A0FFA0'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "info")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#6DFF6D'>";
									echo $obj_query_syslog->priority;}
							elseif ($obj_query_syslog->priority == "debug")
								{	echo	"<td style='border:1px solid #fffff2; background-color:#FFFFFF'>";
									echo $obj_query_syslog->priority;}
							echo "</td>";
							echo	"</tr></table>";
							echo 	"</font>";
							echo 	"</div>";
							echo 	"</li>";
							echo	"</ul>";
							echo	"<br />";
							echo	"<div>";
							echo	"<p>";
							echo	"$obj_query_syslog->tag: $obj_query_syslog->program";
							echo	"<br />";
							echo	"<br />";
							echo	$obj_query_syslog->msg;
							echo	"</p>";
							echo	"</div>";
							
					?>
			</h6>	
		</div>
	</div>
</body>
</html>

</html>

<?php mysql_close($link_DB_syslog); ?>
		
		
		
		
		