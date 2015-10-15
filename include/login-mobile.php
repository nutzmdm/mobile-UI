<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Centreon - IT & Network Monitoring</title>
	<link rel="shortcut icon" href="./img/favicon.ico"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="index, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!--Import CSS & Javascript-->

	<link href="./modules/mobile-UI/css/default/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css" />
	<link href="./modules/mobile-UI/css/style-mobile.css" rel="stylesheet" type="text/css"/>	

	<script src="./modules/mobile-UI/include/js/jquery-1.11.1.min.js"></script>
	<script src="./modules/mobile-UI/include/js/mobile-UI.js"></script>
	<script src="./modules/mobile-UI/include/js/jquery.mobile-1.4.5.min.js"></script>
	
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />

	
</head>
<?php


	/*
	 * Init Date
	 */
	$date = date("d/m/Y");

	if (isset($msg_error))
		echo "<div style='padding-top: 60px;'>$msg_error</span></div>";
	else if (isset($_POST["submit-mobile"]))
		echo "<div style='padding-top: 60px;'><span class='msg'>Invalid user</span></div>";
?>

	
<body>
	<div data-role="page">
	
		<div data-role="header">
			<table width="100%">
				<tr width="100%">
					<td style="text-align:left; width:15%;">
						<font size="1"><?php
						/*
						* Print Centreon Version
						*/
						$DBRESULT =& $pearDB->query("SELECT `value` FROM `informations` WHERE `key` = 'version' LIMIT 1");
						$release = $DBRESULT->fetchRow();
						echo $release["value"];
						?>
						</font>
					</td>
					<td style="width:68%; text-align:center">
						<img src="modules/mobile-UI/include/img/centreon_med.png" align="center">
					</td>
					<td style="text-align:right; width:30%;">
						<font size="1"><?php echo $date; ?></font>
					</td>
				</tr>
			</table>
		</div>
		
		<div data-role="content">
			<font size="2">
			<table width="100%">
				<td width="1%"></td>
				<td style="text-align:center; width:98%">MOBILE</td>
				<td width="1%"></td>
				</tr>
			</table>
			</font>
				<form action="./index.php?p=10" method="post" name="login">
			
					<?php
					if (isset($_GET["disconnect"]) && $_GET["disconnect"] == 2)
						print "<div><span>Session Expired.</span></div>";
					if ($file_install_acces)
						print "<div><span>$error_msg</span></div>";
					if (isset($msg) && $msg)
						print "<div><span>$msg</span></div>";
					?>

					<p>
					<fieldset data-role="fieldcontain">
						<table style="width:100%">
							<tr><td style="text-align:left; width:15%"><label for="useralias">Login:</label></td>
							<td style="text-align:center; width:85%"><input type="text" name="useralias" value="" <?php if (isset($freeze) && $freeze) print "disabled='disabled'"; ?>></td></tr>
							<tr><td style="text-align:left; width:15%"><br /><label for="password">Password:</label></td>
							<td style="text-align:center; width:85%"><input type="password" name="password" value="" <?php if (isset($freeze) && $freeze) print "disabled='disabled'"; ?>></td></tr>
						</table>	
						<table style="width:100%">
							<tr><td style="text-align:center; width:100%"><br /><br /><input type="Submit" name="submit-mobile" value="Connect &rarr;" <?php if ($file_install_acces) print "disabled"; ?> ></td></tr>
						</table>
						
					</fieldset>
					</p>
				</form>
        </div>	
	</div>	
</body>
</html>