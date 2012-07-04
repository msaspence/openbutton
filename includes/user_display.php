<div class="ui_container">
	<h2>Users online</h2>
	<ul id="user_display">
	<?php
	$user_data = get_users_online();

foreach($user_data as $user)
{
?>
		<li><?php echo($user["name"]); ?> (<span class="dates"><?php echo($user["active"])?> - <?php echo($user["expire"])?></span>)</li>
<?php	
}
?>
	</ul>
</div>