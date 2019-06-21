<?php

namespace nebula\heyloyalty;

class heyloyaltyAutomaticAddition {

	public $content;

	public function __construct(){
		add_filter( 'the_content', array($this, 'heyloyaltyForm_the_content') );
	}

	public function heyloyaltyForm_the_content( $content )
	{
		$formContent = stripslashes(get_option('hl-wp-embed'));

		return $formContent;
	}

}

new heyloyaltyAutomaticAddition();
