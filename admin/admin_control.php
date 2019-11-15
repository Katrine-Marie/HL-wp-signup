<?php

namespace nebula\heyloyalty;

/* admin functions */
class admin_control {

	public $hl_embed_code;
	public $hl_wp_aut;

	public $hl_wp_api_key;
	public $hl_wp_secret_key;
	public $hl_wp_list_id;
	public $hl_wp_form_heading;

	public $hl_wp_field_firstname;
	public $hl_wp_field_lastname;
	public $hl_wp_field_mobile;

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
					You can insert Heyloyalty forms in two different ways.<br>
					The easy way is to copy/paste an embed code after creating a form in the Heyloyalty dashboard, and inserting it below.<br>
					The advanced way is to insert your Heyloyalty API key and secret key, and pick out which form fields to work with. This creates a custom form.
				</p>
				<p>
					Once you've set up the form, you can add it to your content in the following ways:
				</p>
				<ul style="list-style-type:disc;padding-left:24px;">
					<li>Tick the checkbox below, automatically adding the form to all posts and pages.</li>
					<li>Copy the shortcode written below the form, and paste it into either a content field or a widget wherever you want a form to appear.</li>
				</ul>

				<br>

				<form method="post" enctype="multipart/form-data" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
					<label name="HL-aut-embed" for="HL-aut-embed">Automatically insert on all posts:</label>
					<input type="checkbox" name="HL-aut-embed" value="Yes" <?php if(get_option('hl-wp-aut') == 'Yes'){echo 'checked';} ?>>

					<br><br>

					<div class="block tabset">

						<input type="radio" name="tabs" id="tab1" checked />
  					<label for="tab1" class="tab-label">Simple</label>
  					<div class="tab-content">

						<h2>Simple Usage:</h2>

					<label name="HL-wp_embed-value" for="HL-wp_embed-value">Insert your embed code here:</label>
					<textarea style="min-height:150px;display:block;width:100%;resize:none;" name="HL-wp_embed-value" type="text"><?php echo stripslashes(get_option('hl-wp-embed')); ?></textarea>

				</div>
					<input type="radio" name="tabs" id="tab2"/>
					<label for="tab2" class="tab-label">Advanced</label>
					<div class="tab-content">

						<h2>Advanced Usage:</h2>

					</div>
				</div>
					<input type="hidden" name="action" value="hl-wp_settings">
					<?php
						wp_nonce_field('HL-settings-save', 'HL-custom-message');
						submit_button();
					?>
				</form>
				<p>
					Copy/paste the shortcode <code>[heyloyalty_wp_signup]</code> to insert the form into a post, page or widget of your choice.
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
