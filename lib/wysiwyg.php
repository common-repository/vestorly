<?php
/* -------------------------------------------------------
 * VESTORLY PLUGIN ROW META
 * -----------------------------------------------------*/

define('VESTORLY_PLUGIN_OPTIONS_LINK_TEXT', (get_option('vestorly.advisor_connected') == 'true') ? __('Settings') : __('Connect to Vestorly'));
define('VESTORLY_PLUGIN_OPTIONS_LINK', '<a href="' . admin_url('options-general.php?page=vestorly-options-page') . '"><strong>' . VESTORLY_PLUGIN_OPTIONS_LINK_TEXT . '</strong></a>');

if (is_admin()) {
    add_filter('plugin_row_meta', 'vestorly_plugin_row_meta', 10, 2);
}
function vestorly_plugin_row_meta($links, $file) {
    $plugin_file = plugin_basename(__FILE__);

    if ($file == $plugin_file) {
        $links = array_merge($links, array('vestorly_link' => VESTORLY_PLUGIN_OPTIONS_LINK));
    }
    return $links;
}



/* -------------------------------------------------------
 * VESTORLY SHORTCODE BUTTON
 * ----------------------------------------------------- */

add_action('admin_init', 'vestorly_shortcode_button_init');
function vestorly_shortcode_button_init() {

    if (!get_option('vestorly.advisor_connected')) {
        return;
    }

    //Abort early if the user will never see TinyMCE
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
        return;

    // Add a callback to register our tinymce plugin
    add_filter("mce_external_plugins", 'vestorly_tinymce_plugin');

    // Add a callback to add our button to the TinyMCE toolbar
    add_filter('mce_buttons', 'vestorly_tinymce_button');
}

// Callback to register our tinyMCE plugin
function vestorly_tinymce_plugin($plugin_array) {
    $plugin_array['vestorly_button'] = plugins_url('vestorly') . '/vestorly.js';
    return $plugin_array;
}

// Callback to add button to the tinyMCE toolbar
function vestorly_tinymce_button($buttons) {
    $buttons[] = 'vestorly_button';
    return $buttons;
}



/* -------------------------------------------------------
 * VESTORLY AJAX ENDPOINT
 * ----------------------------------------------------- */

add_action('wp_ajax_vestorly_get_advisor', 'vestorly_get_advisor');

function vestorly_get_advisor() {
    $arr = array('api_url' => VESTORLY_API_URL, 'token' => get_option('vestorly.auth'));

    echo json_encode($arr);
    exit;
}
