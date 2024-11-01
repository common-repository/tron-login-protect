<?php 
/*
 # Written 2022
 #   by Jeffrey Quade 
**/
?>
<?php

// if uninstall.php is not called by WordPress, die 
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

// delete options
$options = array(
	'tron_login_protect_pin'
);

foreach ($options as $option) {
	if (get_option($option)) delete_option($option);
}
