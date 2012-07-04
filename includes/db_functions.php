<?php
# Connect to the database
function db_connect()
{
	$link = mysql_connect('localhost', 'root', 'root');
	
	return $link;
}

# Check is fruitworks coworking open
function is_coworking_open()
{
	$override_status  = mysql_query("SELECT count(status) FROM status WHERE name = 'switch' AND override = 1");
	
	$result_status = mysql_query("SELECT count(status) FROM status WHERE status = 'active' AND override = 0");	
}

?>