<?php
//require_once "include_first.php";

/////////////////////////////////
//général
/////////////////////////////////

//poller type could be: ndo, shinken,
$poller_type = "ndo" 

//theme
$result_opt_theme = mysql_query('SELECT * FROM mui_opts mui_opts WHERE (mui_opts.opt_type = "opt_gen") AND (mui_opts.opt_label = "Theme")');
$row_opt_theme = mysql_fetch_array ($result_opt_theme);				
$theme = $row_opt_theme['opt_val'];

//ndo connexion
$ndoDB = mysql_query ('SELECT cfg_ndo2db.db_name, cfg_ndo2db.db_prefix FROM '.$conf_centreon['db'].'.cfg_ndo2db cfg_ndo2db');
$ndoDB_assoc = mysql_fetch_assoc ($ndoDB);

?>				

