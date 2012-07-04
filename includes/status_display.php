<?php
include("db_functions.php");

$open = is_coworking_open();
?>
<div id="status_display">
	<p>The <span>Fruitworks</span> coworking space is currently</p>
	
	<p class="status"><?php echo $open ? "OPEN":"CLOSED"; ?></p>
</div>
<?php
?>