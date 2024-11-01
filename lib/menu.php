<?php

add_action('admin_menu', 'vestorly_inject_admin_menu');
function vestorly_inject_admin_menu() {
    global $page_hook_suffix;

    if (is_admin()) {
        $page_hook_suffix = add_options_page('Vestorly Settings', 'Vestorly', 'manage_options', 'vestorly-options-page', 'vestorly_settings_form');
    }
}

function vestorly_settings_form() {
    delete_option('vestorly.response');
    delete_option('vestorly.error_message');

    if (!empty($_POST)) {

        if ($_POST['submit'] === 'Disconnect') {
            delete_option('vestorly.auth');
            delete_option('vestorly.advisor_id');
            delete_option('vestorly.theme_api_url');
            delete_option('vestorly.advisor_connected');
            delete_option('vestorly.response');
        } else {
            $url = VESTORLY_API_URL . "/v2/sessions";
            $args = array(
                'username' => $_POST['advisor_email'],
                'password' => $_POST['advisor_password'],
            );
            $response = wp_remote_post($url, array(
                'body'      => $args,
                'timeout'   => 30,
                'headers'   => array(
                    'Connection' => 'keep-alive',
                )
            ));

            if (is_wp_error($response)) {
                update_option('vestorly.error_message', wp_strip_all_tags($response->get_error_message()));
            } else {
                if ($response["response"]["code"] == '201') {
                  $body = json_decode($response["http_response"]->get_data(), true);
                  update_option('vestorly.auth', $body['vestorly-auth']);
                  update_option('vestorly.advisor_id', $body['current_user']['slug']);
                  update_option('vestorly.theme_api_url', $body['settings']['org_setting']['api_url']);
                  update_option('vestorly.advisor_connected', true);
                } else {
                  update_option('vestorly.error_message', $response["response"]["message"]);
                }
            }
        }
    }

    ob_start();
    include(__DIR__ . '/../views/menu.php');
    $html = ob_get_clean();
    echo $html;
}

add_action('admin_enqueue_scripts', 'vestorly_inject_admin_css');
function vestorly_inject_admin_css($hook) {
    global $page_hook_suffix;

    if ($hook != $page_hook_suffix)
        return;

    if (is_admin()) {
        wp_enqueue_style('options_page_style', plugins_url('../assets/vestorly.css', __FILE__));
    }
}
