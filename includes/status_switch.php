<?php
$override_active = check_override_active();

// Toggle coworking if button clicked.
if (isset($_POST["override_toggle"]))
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
else if (isset($_POST["open_coworking"]))
{
	set_override_status(1);
}

// Set override close
else if (isset($_POST["close_coworking"]))
{
	set_override_status(0);
}

include("includes/status_display.php");
include("includes/user_display.php");
?>
<form class="switch_button" action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
	<p>
		<input type="submit" name="close_coworking" value="Close Coworking" />
	</p>
</form>
<form class="switch_button" action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
	<p>
		<input type="submit" name="open_coworking" value="Open Coworking" />
	</p>
</form>
<form class="switch_button" action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
	<p>
		<input type="submit" name="override_toggle" value="<?php echo $override_active? "Turn override off": "Turn override on";?>" />
	</p>
</form>