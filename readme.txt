=== Tron Login Protect ===
Contributors: tronusa
Tags: wp-admin protect, secure admin, block hackers
Donate link: https://www.paypal.com/donate/?cmd=_s-xclick&hosted_button_id=AEX4MXWZPR6K2
Requires at least: 4.9.13
Tested up to: 6.1
Requires PHP: 5.6
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Protect the wp-admin from hackers. 

== Description ==
Protect the wp-admin area with a personalized pin. Without the pin unwelcome hackers are sent to the 404 page making your admin area completely invisible to unwelcome visitors. 

== Installation ==
1. Upload \"test-plugin.php\" to the \"/wp-content/plugins/\" directory.
2. Activate the plugin through the \"Plugins\" menu in WordPress.
3. Go to the Settings menu and enter your secret pin and press Save.

== Frequently Asked Questions ==
= Locked Out? =
Do not panic. Use phpMyAdmin or other database editor. Search in the `wp_options table` and search for "tron_login_protect_pin" in the option_value field or execute and delete or change the value. Or using an FTP program delete the plugin, log into the wp-admin area, reinstall the plugin, and reset the pin right away.  

= Pro version =
In progress, with allow a longer pin than 4 digits.


== Screenshots ==
1. screenshot-1.png

== Changelog ==
= 1.0.1 =
* Initial public release.

= 1.0.0 =
* In house version for personal use and testing.

== Upgrade Notice ==
= 1.0.1 =
This version has minor improvements over 1.0.0. And extra comments were removed. 