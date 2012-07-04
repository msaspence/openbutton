<h2>Users online</h2>
<ul id="users_online">
<?php
$user_data = get_users_online();

foreach($user_data as $user)
{
?>
	<li><?php echo($user); ?></li>
<?php	
}
?>
</ul>