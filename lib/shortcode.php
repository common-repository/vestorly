<?php
/*-------------------------------------------------------
 * VESTORLY SHORTCODE
 *-----------------------------------------------------*/

add_shortcode( 'vestorly', 'vestorly_shortcode_init' );
function vestorly_shortcode_init( $atts ) {
  ob_start();
  the_widget( 'Vestorly_Widget',
    $instance = shortcode_atts( array(
      'skip'            => '0',
      'limit'           => '10',
      'height'          => '270px',
      'width'           => '100%',
      'display'         => 'carousel',
      'animation'       => 'fade',
      'library'         => '',
      'anonymous'       => '',
      'slideshow'       => '',
	 ), $atts ),
    $args = array (
      'before_widget'   => '',
      'before_title'    => '',
      'after_title'     => '',
      'after_widget'    => ''
    )
  );
  $contents = ob_get_clean();
  return $contents;
}
