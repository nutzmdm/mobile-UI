<?php require_once "include_first.php";

$query_syslog_DB_connect =	'SELECT 
							mod_syslog_opt.syslog_db_server,
							mod_syslog_opt.syslog_db_name,
							mod_syslog_opt.syslog_db_user,
							mod_syslog_opt.syslog_db_password
							FROM centreon.mod_syslog_opt mod_syslog_opt';

$result_syslog_DB_connect = mysql_query ($query_syslog_DB_connect);
$obj_syslog_DB_connect = mysql_fetch_assoc ($result_syslog_DB_connect);	
					
$link_DB_syslog = mysql_connect($obj_syslog_DB_connect["syslog_db_server"],$obj_syslog_DB_connect["syslog_db_user"],$obj_syslog_DB_connect["syslog_db_password"])
	or die ('Erreur1 : '.mysql_error());
mysql_select_db($obj_syslog_DB_connect["syslog_db_name"])
	 or die ('Erreur2 :'.mysql_error());
	 
?>