<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Need Featured Image for CPT
 * Plugin URI:        https://github.com/manchumahara/cbxwpwritelog
 * Description:       Without Featured image can't add custom post.
 * Version:           1.0.0
 * Author:            Aminul Haq Mallik
 * Author URI:        https://codeboxr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nfic
 * Domain Path:       /languages
 */

require_once 'class-plugin-admin.php';

register_activation_hook( __FILE__, 'nfic_set_default_on_activation' );
function nfic_set_default_on_activation() {
	add_option( 'nfi_post_types', array('post') );
	// We added the 86400 (one day) below, because without it
	//      first run behavior was confusing
}
