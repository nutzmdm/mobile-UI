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
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
	<link href="../css/style-mobile.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="js/mobile-UI.js"></script>

</head>

<body>
	<div data-role="page">
	
		<div data-role="header" data-theme="<?php echo $theme;?>">
			
            <h1><?php echo _("About")?></h1>
		</div>
			
		<div data-role="content">
			<div class="div-align-center">
				<p>Centreon Mobile-UI</p>
			</div>
			<div>
				<p><?php echo _("<a href=http://www.centreon.com>Centreon</a> module for mobile devices.")?></p>
			</div>
			<div>
			<p><?php echo _("Development:")?> Nicolas MOREAU</p>
			</div>
			<div>
			<p><?php echo _("This module is under GPL licence and uses <a href=http://jquerymobile.com>Jquery Mobile</a> framework.")?></p>
			</div>
		</div>
	</div>
</body>
</html>