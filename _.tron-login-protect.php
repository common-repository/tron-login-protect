<?php
/**
  Plugin Name:        Tron Login Protect
  Description:        Protect your wp-admin area with a private pin.
  Version:            1.0.1 
  Author:             Tron 
  Author URI:         https://tronusa.businessshop.net
  Author URI:         mailto:tronusa@businessshop.net?&subject=Tron-Login-Protect
  License:            GPL v2, written 2022
  License URI:        https://www.gnu.org/licenses/gpl-2.0.html
**/

require_once('row_meta.php'); 
require_once('settings_page.php'); 

// If not logged in, check for valid pin number, if not go to the 404 page. 
if (!function_exists('tron_login_protect_wp_admin_headers')) {
	function tron_login_protect_wp_admin_headers() {
		if (!is_user_logged_in()) {
			$saved_pin = sanitize_text_field(get_option('tron_login_protect_pin')); 
			if (!empty($saved_pin)) {
				$url_pin = ""; 
				if (!empty($_GET['pin'])) $url_pin = sanitize_text_field($_GET['pin']);  // strip_tags - no HTML, just a number
				if ($saved_pin != $url_pin) { 
					header('HTTP/1.1 401 Unauthorized'); 
					$site_url = get_site_url(); // basically the same as https://{$_SERVER['HTTP_HOST']}
					$site_url = sanitize_text_field($site_url); // strip_tags - no HTML, just a url
					header("Location: $site_url/404/"); 
				}
			}
		}  
	}
	add_action('login_init', 'tron_login_protect_wp_admin_headers');
}

// Avoid 404 page on logout. 
function tron_login_protect_auto_redirect_after_logout(){
	$saved_pin = sanitize_text_field(get_option('tron_login_protect_pin'));
  wp_safe_redirect(home_url() . "/wp-login.php?pin=$saved_pin&logout=true");
  exit;
}
add_action('wp_logout','tron_login_protect_auto_redirect_after_logout');
