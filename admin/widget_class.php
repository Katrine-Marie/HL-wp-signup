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

  	// WordPress core before_widget hook (always include )
  	echo $before_widget;

    // Display the widget
     echo '<div class="widget-text wp_widget_plugin_box">';

    if(get_option('hl-wp-api-key') == '' && get_option('hl-wp-secret-key') == ''){
      $formContent = stripslashes(get_option('hl-wp-embed'));
    }else {
      $dataOpts = '';
      if(get_option('hl-wp-field-firstname') || get_option('hl-wp-field-lastname')){
        $dataOpts .= 'name';
      }
      if(get_option('hl-wp-field-mobile')){
        $dataOpts .= ',mobile';
      }

      if ( $title ) {
    		$dataOpts .= '&formHeading=' . $title;
    	}
      if ( $text ) {
    		$dataOpts .= '&formDesc=' . $text;
    	}

      $apiKeyParam = urlencode(base64_encode(get_option('hl-wp-api-key')));
      $secretKeyParam = urlencode(base64_encode(get_option('hl-wp-secret-key')));
      $listIDParam = urlencode(base64_encode(get_option('hl-wp-list-id')));

      $formContent = '<iframe style="width:100%;height:350px;" frameborder="0" src="' . get_home_url() . '/wp-content/plugins/HL-wp-signup/users/custom_form.php?dataOpts='. $dataOpts .'&access1='. $apiKeyParam .'&access2=' . $secretKeyParam . '&list=' . $listIDParam . '"></iframe>';
    }

    echo $formContent;

  	echo '</div>';

  	// WordPress core after_widget hook (always include )
  	echo $after_widget;
	}

}

// Register the widget
function HL_WP_custom_widget() {
	register_widget( 'HL_WP__Widget' );
}
add_action( 'widgets_init', 'HL_WP_custom_widget' );
