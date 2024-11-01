<?php
/* -------------------------------------------------------
 * VESTORLY WIDGET
 * -----------------------------------------------------*/

class Vestorly_Widget extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array('classname' => 'Vestorly_Widget', 'description' => 'Displays Vestorly content!');
        $control_ops = array();

        parent::__construct('Vestorly_Widget', __('Vestorly Widget'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        $options = array(
            'advisor_id'    => get_option('vestorly.advisor_id'),
            'skip'          => 0,
            'limit'         => (isset($instance['limit']) ? $instance['limit'] : 12),
            'embed_type'    => (isset($instance['display']) ? $instance['display'] : 'carousel'),
            'group_id'      => $instance['library'],
            'iframeresizer' => 'true',
            'animation'     => 'fade',
        );

        $true_values = array('true', 'on');

        if(isset($instance['slideshow']) && in_array($instance['slideshow'], $true_values)) {
            $options['auto'] = 'true';
        }

        if(isset($instance['anonymous']) && in_array($instance['anonymous'], $true_values)) {
            $options['email'] = 'anonymous@user.com';
            $options['new_user'] = 'true';
        }

        $url = get_option('vestorly.theme_api_url') . '/embed?' . http_build_query($options);
        $style = $this->buildStyles($instance);

        ob_start();
        include(__DIR__.'/../views/widget_iframe.php');
        $html = ob_get_clean();
        echo $html;
    }

    protected function buildStyles($instance)
    {
        $styles = array(
            'min-width'     => '275px',
            'max-width'     => '99%',
            'min-height'    => '270px',
            'max-height'    => '100%',
            'width'         => '100%',
            'overflow'      => 'hidden',
            'position'      => 'relative',
            'border'        => 'none',
            'margin'        => 0,
        );

        if (isset($instance['height'])) { $styles['min-height'] = $instance['height']; }
        if (isset($instance['width'])) { $styles['width'] = $instance['width']; }

        $mapped = array();

        foreach($styles as $key => $val) {
            $mapped[] = $key.':'.$val;
        }

        return implode(';', $mapped);
    }

    public function form($instance)
    {
        $skip = isset($instance['skip']) ? $instance['skip'] : '0';
        $limit = isset($instance['limit']) ? $instance['limit'] : '10';
        $height = isset($instance['height']) ? $instance['height'] : '270px';
        $width = isset($instance['width']) ? $instance['width'] : '270px';
        $display = isset($instance['display']) ? $instance['display'] : 'carousel';
        $animation = isset($instance['animation']) ? $instance['animation'] : 'fade';
        $slideshow = isset($instance['slideshow']) ? $instance['slideshow'] : '';
        $library = isset($instance['library']) ? $instance['library'] : '';
        $anonymous = isset($instance['anonymous']) ? $instance['anonymous'] : '';

        $url = VESTORLY_API_URL . '/v2/groups';
        $args = array(
            'timeout' => 30,
            'headers' => array(
              'Connection' => 'keep-alive',
              'x-vestorly-auth' => get_option("vestorly.auth")
            ),
        );
        $response = wp_remote_get($url, $args);
        $json = json_decode($response["body"]);

        ob_start();
        include(__DIR__.'/../views/widget_form.php');
        $html = ob_get_clean();

        echo $html;
    }

}

add_action('widgets_init', 'vestorly_widgets_init_action');
function vestorly_widgets_init_action() {
    register_widget('Vestorly_Widget');
}
