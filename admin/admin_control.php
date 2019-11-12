<?php

namespace nebula\heyloyalty;

/* admin functions */
class admin_control {

	public $hl_embed_code;
	public $hl_wp_aut;

	public function __construct(){
		global $pagenow;

		add_action('admin_notices', array($this, 'empty_field_notice'));
		add_action('admin_menu', array($this, 'add_options_page'));
		add_action('admin_post_hl-wp_settings', array($this, 'ValidatePage'));

		if (($pagenow == 'options-general.php' ) || ( $_GET["page"] == 'hl-wp_admin-page')) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
				//add_action( 'admin_enqueue_scripts', array($this,'enqueue_scripts') );
		}
	}

	public function add_options_page(){
		add_options_page('HL WP Signup Admin', 'HL-wp Signup', 'manage_options', 'hl-wp_admin_page', array($this, 'render_admin'));
	}

	public function render_admin(){
		?>
			<div class="wrap">
				<h1>
					HL WP Signup Admin
				</h1>
				<p>
					Once you have filled out the textares below with the embed code you get from the Heyloyalty control panel, you can either tick the checkbox, which automatically adds the form to all posts/pages, or you can copy and paste the shortcode written below, in order for the form to show up wherever you want in the content.
				</p>
				<form method="post" enctype="multipart/form-data" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
					<label name="HL-aut-embed" for="HL-aut-embed">Automatically insert on all posts:</label>
					<input type="checkbox" name="HL-aut-embed" value="Yes" <?php if(get_option('hl-wp-aut') == 'Yes'){echo 'checked';} ?>><br><br>
					<label name="HL-wp_embed-value" for="HL-wp_embed-value">Insert your embed code here:</label>
					<textarea style="min-height:150px;display:block;width:100%;resize:none;" name="HL-wp_embed-value" type="text"><?php echo stripslashes(get_option('hl-wp-embed')); ?></textarea>
					<input type="hidden" name="action" value="hl-wp_settings">
					<?php
						wp_nonce_field('HL-settings-save', 'HL-custom-message');
						submit_button();
					?>
				</form>
				<p>
					Use the shortcode <code>[heyloyalty_wp_signup]</code> to insert the above form into a post or page of your choice.
				</p>
			</div>
		<?php
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

	public function enqueue_styles() {
		wp_enqueue_style(
			'hl-wp-styles',
			plugins_url('css/options.css', __FILE__),
			array()
		);
	}

}
