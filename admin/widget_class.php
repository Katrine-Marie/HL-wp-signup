<?php

class HL_WP__Widget extends WP_Widget {

	public function __construct() {
    parent::__construct(
    		'HL_WP_custom_widget',
    		__( 'HL WP Widget', '' ),
    		array(
    			'customize_selective_refresh' => true,
    		)
    );
	}

	// The widget form
	public function form( $instance ) {
    // Set widget defaults
  	$defaults = array(
  		'title'    => 'Sign up for our newsletter',
  		'text'     => ''
  	);


		
	}

}

// Register the widget
function HL_WP_custom_widget() {
	register_widget( 'HL_WP__Widget' );
}
add_action( 'widgets_init', 'HL_WP_custom_widget' );
