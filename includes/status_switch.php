<?php
$override_active = check_override_active();
$override_status = check_override_status();
$users = get_users();

// Toggle coworking if button clicked.
if (isset($_POST["override_active_toggle"]))
{
	if ($override_active)
	{
		set_override_active(0);
		$override_active = 0;
	}
	else
	{
		set_override_active(1);
		$override_active = 1;
	}
}

// Set override open
else if (isset($_POST["override_status_toggle"]))
{
	if ($override_status)
	{
		set_override_status(0);
		$override_status = 0;
	}
	else
	{
		set_override_status(1);
		$override_status = 1;
	}
}

// Set user in/out
else if (isset($_POST["user_in"])) 
{
	update_status($_POST["user_select"], time()+86400);
}
else if (isset($_POST["user_out"]))
{
	update_status($_POST["user_select"], time());
}

include("includes/status_display.php");
include("includes/user_display.php");

?>
<div class="ui_container">
	<form id="switch_buttons" action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
		<div style="float:left; width:50%;">
			<h2>Override Status</h2>
			<p>
				<input type="submit" name="override_active_toggle" value="<?php echo $override_active? "Turn override off": "Turn override on";?>" />
			</p>
			<p>
				<input <?php echo $override_active? "":"disabled=\"disabled\""; ?> <?php echo $override_active? "":"class=\"fade\""; ?> type="submit" name="override_status_toggle" value="<?php echo $override_status? "Close Coworking": "Open coworking";?>" />
			</p>
		</div>
		<div style="float:right; width:50%;">
			<h2>Set User Presence</h2>
			<p>
				<select name="user_select">
	<?php
		foreach ($users as $user)
		{
	?>
					<option value="<?php echo($user["name"]);?>"><?php echo($user["name"]); ?></option>
	<?php
		}
	?>
				</select>
			</p>
			<p>
				<input type="submit" name="user_in" value="I'm In" />
				<input type="submit" name="user_out" value="I'm Out" />
			</p>
		</div>
		<br class="clear" />
	</form>
</div>