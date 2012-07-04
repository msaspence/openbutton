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
	$override = mysql_fetch_array(mysql_query("SELECT is_open, active FROM override WHERE active = 1 AND override_id = 1"));
		
	if (!$override[1])
	{
		$individuals = mysql_fetch_array(mysql_query("SELECT count(status_id) FROM status WHERE active = 1"));
		
		return $individuals[0];
	}
	
	return $override[0];
}

# Check whether the override is in effect.
function check_override_active()
{
	$result =  mysql_fetch_array(mysql_query("SELECT active FROM override WHERE override_id = 1"));
	
	return $result[0];
}

# Turn on/off the override.
function set_override_active($active)
{	
	return mysql_query("UPDATE override SET active = $active WHERE override_id = 1");
}

# Set override either open or closed.
function set_override_status($status)
{	
	return mysql_query("UPDATE override SET is_open = $status WHERE override_id = 1");
}

# Get a list of the current users online.
function get_users_online()
{
	$users = array();
	$result = mysql_query("SELECT name FROM status WHERE active = 1");
	
	while ($data = mysql_fetch_assoc($result))
	{
		$users[] = $data["name"];
	}
	
	return $users;
}

# Check a status with a given name exists.
function status_exists($name)
{
	$result = mysql_fetch_array(mysql_query("SELECT count(status_id) FROM status WHERE name = '$name'"));
	return $result[0];
}

# Update a status with a given name
function update_status($name, $status)
{
	if (status_exists($name))
	{
		return mysql_query("UPDATE status SET active = $status WHERE name = '$name'");
	}
	
	return false;
}

?>