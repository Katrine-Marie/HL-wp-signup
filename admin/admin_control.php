<?php

namespace nebula\heyloyalty;

/* admin functions */
class admin_control {

	public $hl_embed_code;
	public $hl_wp_aut;

	public function __construct(){
		add_action('admin_notices', array($this, 'empty_field_notice'));
		add_action('admin_menu', array($this, 'add_options_page'));
		add_action('admin_post_hl-wp_settings', array($this, 'ValidatePage'));
	}

	public function add_options_page(){
		add_options_page('HL WP Signup Admin', 'HL-wp Signup', 'manage_options', 'hl-wp_admin_page', array($this, 'render_admin'));
	}

	public function render_admin(){
	
	}

	function ValidatePage(){
		$this->hl_wp_aut = $_POST['HL-aut-embed'];
		$this->hl_embed_code = $_POST['HL-wp_embed-value'];
		$this->SavePage();
	}

	private function SavePage(){
		if(!($this->has_valid_nonce() && current_user_can('manage_options'))){
			echo "Error: You can not save this data";
			exit;
		}

		update_option('hl-wp-aut', $this->hl_wp_aut);
		update_option('hl-wp-embed', $this->hl_embed_code);
		$this->redirect();
	}

	private function has_valid_nonce(){
		if(!isset($_POST['HL-custom-message'])){
			return false;
		}

		$field = wp_unslash($_POST['HL-custom-message']);
		$action = 'HL-settings-save';

		return wp_verify_nonce($field, $action);
	}

	private function redirect(){
		if(!isset($_POST['_wp_http_referer'])){
			$_POST['_wp_http_referer'] = wp_login_url();
		}

		$url = sanitize_text_field(wp_unslash($_POST['_wp_http_referer']));

		wp_safe_redirect(urldecode($url));
		exit;
	}

}
