<?php
$active_timeout_mins = 10;

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

# Check whether a status is active or not.
function is_status_active($name)
{
	
	$result = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE name = '$name'"));
	
	if ($result)
	{
		$time = time();
		$expires = strtotime($result["expires"]);
		
		return (($time - $expires) < 0);
	}
	
	return $result;
}

# Get a list of all the users.
function get_users()
{
	$result = mysql_query("SELECT * FROM status");
	$users = array();
	
	while ($data = mysql_fetch_assoc($result))
	{
		$users[] = $data;
	}
	
	return $users;
}

# Get a list of the current users online.
function get_users_online()
{
	$time = time();
	
	$users = array();
	$result = mysql_query("SELECT * FROM status");
	
	while ($data = mysql_fetch_assoc($result))
	{
		$expires = strtotime($data["expire"]);
		
		if (($time - $expires) < 0)
		{
			$users[] = $data;
		}
	}
	
	return $users;
}

# Check is coworking open. First check whether any "overrides" are in effect, then the
# statuses of users.
function is_coworking_open()
{ 
	$override = mysql_fetch_array(mysql_query("SELECT is_open, active FROM override WHERE active = 1 AND override_id = 1"));
		
	if (!$override[1])
	{
		$users = get_users_online();
		return sizeof($users);
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

# Check override either open or closed.
function check_override_status()
{	
	$result =  mysql_fetch_array(mysql_query("SELECT is_open FROM override WHERE override_id = 1"));
	
	return $result[0];
}

# Set override either open or closed.
function set_override_status($status)
{	
	return mysql_query("UPDATE override SET is_open = $status WHERE override_id = 1");
}


# Check a status with a given name exists.
function status_exists($name)
{
	$result = mysql_fetch_array(mysql_query("SELECT count(status_id) FROM status WHERE name = '$name'"));
	return $result[0];
}

# Update a status with a given name with a date to expire at
function update_status($name, $expire_at)
{
	if (status_exists($name))
	{
		$active = date("Y-m-d H:i:s", time());
		$expires = date("Y-m-d H:i:s", $expire_at);
		return mysql_query("UPDATE status SET active = '$active', expire = '$expires' WHERE name = '$name'");
	}
		
	return false;
}

?>