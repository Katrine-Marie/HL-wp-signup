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
		}else {
			$dataOpts = '';
			if(get_option('hl-wp-field-firstname') || get_option('hl-wp-field-lastname')){
				$dataOpts .= 'name';
			}
			if(get_option('hl-wp-field-mobile')){
				$dataOpts .= ',mobile';
			}

			if(get_option('hl-wp-form-heading')){
				$dataOpts .= '&formHeading=' . get_option('hl-wp-form-heading');
			}

			$apiKeyParam = urlencode(base64_encode(get_option('hl-wp-api-key')));
			$secretKeyParam = urlencode(base64_encode(get_option('hl-wp-secret-key')));
			$listIDParam = urlencode(base64_encode(get_option('hl-wp-list-id')));

			$formContent = '';

			return $formContent;
		}
	}

}

$heyloyaltyShortcode = new heyloyaltyShortcode();
