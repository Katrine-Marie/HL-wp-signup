<?php
/**********
* Plugin Name: Heyloyalty WP signup
* Plugin URI: https://github.com/Katrine-Marie/HL-wp-signup
* Description: Easily embed a Heyloyalty signup form into your posts/pages
* Version: 1.0.0
* Author: Katrine-Marie Burmeister
* Author URI: https://fjordstudio.dk
* License:     GNU General Public License v3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

namespace nebula\heyloyalty;

if(!defined('ABSPATH')){
	exit('Go away!');
}

define('nebula_heyloyalty_DIR', plugin_dir_path(__FILE__));
$setup = new Initialization();

// Init admin page control
include_once nebula_heyloyalty_DIR . 'admin/admin_control.php';
$admin_page = new admin_control();




// Welcome screen
include_once nebula_heyloyalty_DIR . 'admin/admin_welcome.php';
$welcome_page = new admin_welcome();

// Init class
class Initialization{
    public function __construct(){
        register_activation_hook( __FILE__, array($this, 'plugin_activated' ));
        register_deactivation_hook( __FILE__, array($this, 'plugin_deactivated' ));
        register_uninstall_hook( __FILE__, array($this, 'plugin_uninstall' ) );
    }
    public static function plugin_activated(){
			set_transient('_nebula_heyloyalty_welcome',true,30);
    }
    public function plugin_deactivated(){
         // This will run when the plugin is deactivated, use to delete the database
    }
    public function plugin_uninstall() {

    }
}
