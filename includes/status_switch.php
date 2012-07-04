<?php
// Toggle coworking if button clicked.
if (isset($_POST["switch"]))
{
	toggle_coworking();
}
?>
<form id="status_switch" action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
	<p>
		<input type="submit" name="switch" value="<?php echo is_coworking_open()? "Close Coworking": "Open Coworking"; ?>">
	</p>
</form>