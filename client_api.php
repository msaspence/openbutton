<?php
include("includes/db_functions.php");
db_connect();

# Set a user active
if (isset($_GET["set_active"]))
{
	$name = mysql_real_escape_string($_GET["set_active"]);
	update_status($name);
}

# Show the current status, json encoded.
else if (isset($_GET["current_status"]))
{
	$is_coworking_open = is_coworking_open();
	$users_online = get_users_online();
	$override_active = check_override_active();
	$override_status = check_override_status();
	
	$data = array(
		"coworking_open" => $is_coworking_open,
		"users_online" => $users_online,
		"override_active" => $override_active,
		"override_open" => $override_status
	);
	
	echo json_encode($data);
}
?>