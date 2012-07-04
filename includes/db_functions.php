<?php
# Connect to the database
function db_connect()
{
	$link = mysql_connect('localhost', 'root', 'root');
	
	
	if ($link)
	{
		$link = mysql_select_db("coworking_status");
	}
	
	if (!$link)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	return $link;
}

# Check is fruitworks coworking open. First check whether any "overrides" are in effect, then the
# statuses of others.
function is_coworking_open()
{ 
	$override = mysql_fetch_array(mysql_query("SELECT count(status_id) FROM status WHERE active = 1 AND override = 1"));
		
	if (!$override[0])
	{
		$individuals = mysql_fetch_array(mysql_query("SELECT count(status_id) FROM status WHERE active = 1 AND override = 0"));
		return $individuals[0];
	}
	
	return $override[0];
}

# Toggle coworking open and closed using an override override switch.
function toggle_coworking()
{
	$open_coworking = 0;
	
	if (!is_coworking_open())
	{
		$open_coworking = 1;
	}
	
	return mysql_query("UPDATE status SET active = $open_coworking WHERE name = 'front_switch'");
}
?>