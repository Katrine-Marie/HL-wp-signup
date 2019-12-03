<?php

namespace nebula\heyloyalty;

class heyloyaltyAutomaticAddition {

	public $content;

	public function __construct(){
		add_filter( 'the_content', array($this, 'heyloyaltyForm_the_content') );
	}

	public function heyloyaltyForm_the_content( $content )
	{

		if( is_single() ){
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

				if(get_option('hl-wp-form-heading')){
					$dataOpts .= '&formHeading=' . get_option('hl-wp-form-heading');
				}

				$apiKeyParam = urlencode(base64_encode(get_option('hl-wp-api-key')));
				$secretKeyParam = urlencode(base64_encode(get_option('hl-wp-secret-key')));
				$listIDParam = urlencode(base64_encode(get_option('hl-wp-list-id')));


			}

			$content .= '<br>' . $formContent;
		}
		return $content;
	}

}

new heyloyaltyAutomaticAddition();
