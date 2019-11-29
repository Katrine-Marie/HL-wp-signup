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

  	// Parse current settings with defaults
  	extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

  	<?php // Widget Title ?>
  	<p>
  		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Widget Title</label>
  		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  	</p>

  	<?php // Text Field ?>
  	<p>
  		<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>">Descriptive Text</label>
  		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
  	</p>

  <?php
	}

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
  	$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
  	$instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
  	return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {
    extract( $args );

		// Check the widget options
  	$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
  	$text     = isset( $instance['text'] ) ? $instance['text'] : '';
	}

}

// Register the widget
function HL_WP_custom_widget() {
	register_widget( 'HL_WP__Widget' );
}
add_action( 'widgets_init', 'HL_WP_custom_widget' );
