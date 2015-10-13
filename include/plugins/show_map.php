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

include_once "../common.php";

$module_name = "PHP-Weathermap";
$query_IsInstalled = mysql_query ('SELECT * FROM modules_informations WHERE name="'.$module_name.'"');
$IsInstalled_module = mysql_fetch_object ($query_IsInstalled);

if (!isset ($_GET['id'])) 
	{exit();}
else {$id = $_GET['id'];}

$centreon_path = "/usr/local/centreon/";
$path_editor = $centreon_path."www/modules/php-weathermap/configuration/editor/";
$path_renderer = $centreon_path."www/modules/php-weathermap/views/renderer/";
$mapdir = $path_editor.'configs/';

$query_select_maps =	'SELECT *
						FROM
						'.$conf_centreon['db'].'.pwm_maps
						WHERE
						pwm_id = '.$id.'';
$result_select_maps = mysql_query ($query_select_maps);
$obj_select_maps = mysql_fetch_object ($result_select_maps);

$pwm_name = $obj_select_maps->pwm_name;

require_once $centreon_path . "www/class/centreonDB.class.php";
require_once $centreon_path . "www/class/centreonHost.class.php";
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
			<a href="../mobile-UI.php" data-role="button" data-icon="home" class="ui-btn-right" data-transition="fade">Home</a>
            <h1>Weathermap</h1>
        </div>
        <div data-role="content">
		<?php 
		system($path_editor."weathermap --config ".$mapdir.$pwm_name." --htmloutput ".$path_renderer.$pwm_name.".html  --output ".$path_renderer.$pwm_name.".png");
		
			print '<div class="div_show_map"><img max-width="100%" max-height:="100%" src=../../../php-weathermap/views/renderer/'.$pwm_name.'.png></img></div>';
			
		
		?>
		
		
		
		</div>
	</div>
</body>
</html>

</html>