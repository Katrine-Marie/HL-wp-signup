<?php

namespace nebula\heyloyalty;

class admin_welcome {

	public function __construct()  {
        add_action( 'admin_init', array($this,'welcome_do_activation_redirect') );
        // Delete the redirect transient
        // Bail if activating from network, or bulk
        if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
            return;
        }
        // add to menu
        add_action('admin_menu', array($this, 'welcome_pages') );
        add_action('admin_head', array($this, 'welcome_remove_menus' ) );
    	}

    public function welcome_do_activation_redirect() {
      // Bail if no activation redirect
        if ( ! get_transient( '_nebula_heyloyalty_welcome' ) ) {
            return;
          }
      // Redirect
      wp_safe_redirect( add_query_arg( array( 'page' => 'hl-wp-signup' ), admin_url( 'index.php' ) ) );
    }

    /*
     * add a menu item
     */
    public function welcome_pages() {
      add_dashboard_page(
        'Heyloyalty WP Signup Welcome',
        'Heyloyalty WP Signup',
        'read',
        'hl-wp-signup',
        array( $this,'welcome_content')
      );
    }

    public function welcome_remove_menus() {
        remove_submenu_page( 'index.php', 'hl-wp-signup' );
    }

   /*
     * The Welcome screen
     */
    public static function welcome_content() {

?>
    <div class="wrap admin-page">
        <h1 class="title"><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<p>
		Welcome to the Heyloyalty WordPress Signup plugin.<br>
		The plugin that allows you to add Heyloyalty signup forms to your WordPress site.
	</p>

<br><hr /><br>

<p>A link to the plugin's setup page can be found at the bottom of the 'Settings' menu. <br />Go there to set up a form and manage settings.</p>


    </div>
    <?php
        // now page is seen you can delete the transient
        delete_transient( '_nebula_heyloyalty_welcome' );
    }



}
