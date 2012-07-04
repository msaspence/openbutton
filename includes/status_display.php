<?php
$coworking_open = is_coworking_open(); 
?>
<div id="status_display" class="<?php echo $coworking_open ? "open":"closed"; ?>">
	<p>The <span>Fruitworks</span> coworking space is currently</p>
	
	<p class="status"><?php echo $coworking_open ? "OPEN": "CLOSED"; ?></p>
</div>
<?php
?>