<?php 
/*
 # Written 2022
 #   by Jeffrey Quade 
**/
?>
<?php
require_once('config.php');

// Menu Settings
if (!function_exists('wpp_tron_login_protect_settings_add_pages')) {
	
	function wpp_tron_login_protect_settings_add_pages() {
		add_options_page(
			__(WPP_TRON_LOGIN_PROTECT_SETTING_NAME, WPP_TRON_LOGIN_PROTECT_SETTING_NAME . "_221022"),	
			__(WPP_TRON_LOGIN_PROTECT_SETTING_NAME, WPP_TRON_LOGIN_PROTECT_SETTING_NAME . "_221022"),	
			'manage_options', 										
			strtolower(str_replace(' ', '-', WPP_TRON_LOGIN_PROTECT_SETTING_NAME)), 	  
			'wpp_tron_login_protect_settings_page'					
		);
		
		// Next menu .
	}
	// Hook for adding admin menus 
	add_action('admin_menu', 'wpp_tron_login_protect_settings_add_pages');

	// mt_settings_page() displays the page content for the settings submenu
	function wpp_tron_login_protect_settings_page() {
		//must check that the user has the required capability 
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
	
		// variables for the field and option names 	
		if (isset($_POST)) { 
		
			// Save the posted value in the database
			$message = ""; 
			$new_pin = sanitize_text_field($_POST['tron_login_protect_pin']); 
			if (is_numeric($new_pin)) { // Validate numbers only allowed. 
				update_option('tron_login_protect_pin', $new_pin);
			} else $message = "only numbers are allowed"; 
			
			// Put an settings updated message on the screen
	?>
			<div class="updated"><p><strong>
				<?php 
				if (empty($message)) _e(esc_html(sanitize_text_field('settings saved')));
					else _e(esc_html(sanitize_text_field($message))); 
				?>
      </strong></p></div>
	<?php
		}
		// Now display the settings editing screen
		?>
		<div class="wrap">
    <h2>
		<?php 
		// header
		_e(esc_html(sanitize_text_field(__(WPP_TRON_LOGIN_PROTECT_SETTING_NAME))));
		// settings form
		?> 
		</h2>
<form name="form1" method="post" action="">
<script type="text/javascript">
function jsOnKeypressNumbersOnly(evt) {
	
	var key = (evt.keyCode) ? evt.keyCode : evt.charCode; // FF fix, key in charCode.
	if (evt.keyCode == 46 && evt.which == 0 && evt.charCode == 0 && !evt.char) 
		return true; // Delete key pressed in FF. 

	if (window.event) ctrlDown = window.event.ctrlKey; // Don't care about altKey or shiftKey
		else ctrlDown = evt.ctrlKey || evt.metaKey; // Mac support
	if (ctrlDown) return true;
	return (
		key <= 31 || 
			(key >= "0".charCodeAt(0) && key <= "9".charCodeAt(0)) 
	);
} 
</script>
      
	<div style="height:auto; width:500px; border-bottom:1px dotted #AAA; margin:0; padding-bottom:5px;">
  	<strong>Settings:</strong>
  </div>

			<p>
				<?php 
				_e(esc_html(sanitize_text_field("Enter 4 digit pin: "))); 
				$tron_login_protect_pin = sanitize_text_field(get_option('tron_login_protect_pin')); 
				?><br />
				<input type="text" name="tron_login_protect_pin" value="<?php _e(esc_html($tron_login_protect_pin)); ?>" size="4" maxlength="4" onKeyPress="return jsOnKeypressNumbersOnly(event || window.event);" />
			<i>Upgrade to Pro for longer pin.</i></p>

			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
			</p>
</form>
To access your wp-admin area go to . . . 
<br />
<br />

<?php
	$site_url = sanitize_text_field(get_site_url()); // same as 'https://' . {$_SERVER['HTTP_HOST']}
	// strip_tags - no HTML, just a url 
	$url_link = sanitize_text_field($site_url . '/wp-login.php?pin=' . get_option('tron_login_protect_pin')); 
?>
  <a href="<?php _e(esc_html($url_link)); ?>" target="_blank">
<?php 
	_e($url_link); ?>  
  </a>

		</div>
	<?php
} }
