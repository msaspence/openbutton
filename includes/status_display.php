<?php
include("db_functions.php");

db_connect();
?>
<div id="status_display">
	<p>The <span>Fruitworks</span> coworking space is currently</p>
	
	<p class="status"><?php echo (is_coworking_open()) ? "OPEN": "CLOSED"; ?></p>
</div>

<?php
?>