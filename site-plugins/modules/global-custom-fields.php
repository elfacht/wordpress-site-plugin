<?php

/* =Global custom fields
------------------------------------------------------*/
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_menu_page('Global Custom Fields', 'Global Custom Fields', '6', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() { ?>
	<div class='wrap'>
	<h2>Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Footer Credits</strong><br />
	<input type="text" name="footer-credits" size="45" value="<?php echo get_option('footer-credits'); ?>" /></p>

	<p><strong>Welcome Message</strong><br />
	<textarea name="welcome-message" rows="5" cols="45"><?php echo get_option('welcome-message'); ?></textarea></p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />

	<?php
		// Add all new input fields to this variable
		$option_values = "";
		$option_values .= "footer-credits";
		$option_values .= ",welcome-message";
	?>
	<input type="hidden" name="page_options" value="<?php echo $option_values; ?>" />

	</form>
	</div>
<?php } ?>