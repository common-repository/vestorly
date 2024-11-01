<?php
/**
 * Plugin Name: Vestorly
 * Plugin URI: http://wordpress.org/extend/plugins/vestorly
 * Description: Displays Vestorly content.
 * Author: Vestorly
 * Author URI: http://www.vestorly.com
 * Developers: Jason Jimenez, Greg Gilbert
 * Developer URI: http://www.vestorly.com
 * Version: 1.3.6
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

define('VESTORLY_API_URL', 'https://www.vestorly.com/api');


add_action('wp_enqueue_scripts', 'vestorly_inject_js');
function vestorly_inject_js() {
    wp_enqueue_script('iframeResizer', plugins_url('assets/iframeResizer.min.js', __FILE__));
}

require(__DIR__.'/lib/menu.php');
require(__DIR__.'/lib/widget.php');
require(__DIR__.'/lib/wysiwyg.php');
require(__DIR__.'/lib/shortcode.php');
