<?php

namespace nebula\heyloyalty;

class heyloyaltyShortcode {

	public function __construct(){
		add_shortcode('heyloyalty_wp_signup',array($this, 'heyloyalty_add_shortcode'));
	}

	public function heyloyalty_add_shortcode()
	{
		if(get_option('hl-wp-api-key') == '' && get_option('hl-wp-secret-key') == ''){
			return get_option('hl-wp-embed');
		}




		
		return get_option('hl-wp-embed');
	}

}

$heyloyaltyShortcode = new heyloyaltyShortcode();
