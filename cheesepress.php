<?php
/**
 * CheesePress Framework
 *
 * Main page for CheesePress Framework
 *
 * @package   CheesePress
 * @author    Ben Klein <ben@kleinis.me>
 * @license   GPL-2.0+
 * @link      http://cheesepressframework.com
 * @copyright 2014 Ben Klein
 *
 * @wordpress-plugin
 * Plugin Name:       CheesePress Framework
 * Plugin URI:        http://cheesepressframework.com
 * Description:       CheesePress Framework main script
 * Version:           0.0.1
 * Author:            Ben Klein
 * Author URI:        
 * Text Domain:       cheesepress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: 
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . '/class-myclasshelper.php' );
require_once( plugin_dir_path( __FILE__ ) . '/vendor/autoload.php' );

ActiveRecord\Config::initialize(function($cfg)
{
   $cfg->set_model_directory(plugin_dir_path( __FILE__ ) . '/models');
   $cfg->set_connections(
     array(
       'wordpress' => 'mysql://'.DB_USER.':'.DB_PASSWORD.'@'.DB_HOST.'/' . DB_NAME
     )
   );
});

ActiveRecord\Config::initialize(function($cfg)
{
  $cfg->set_default_connection('wordpress');
});

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'CheesePress', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CheesePress', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'CheesePress', 'get_instance' ) );

// Declare your custom types below: 

add_action( 'init', 'create_custom_post_type' );
function create_custom_post_type() {
    register_post_type( 'mycustom',
        array(
            'labels' => array(
                'name' => __( 'My Customs' ),
                'singular_name' => __( 'My Custom' )
            ),
            'public' => true,
            'has_archive' => false,
        )
    );
}

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-cheesepress-admin.php' );
	add_action( 'plugins_loaded', array( 'CheesePress_Admin', 'get_instance' ) );
       

}

// custom url routes and churro methods
if( file_exists(WP_PLUGIN_DIR.'/cheesepress/controllers/_config.php') )
	require WP_PLUGIN_DIR.'/cheesepress/controllers/_config.php';

// Churro needs to extend Custom
if( !class_exists('Custom_Churro') ){
	class Custom_Churro{
		static public function Routes(){
			return array();
		}
	}
}

// base class
require WP_PLUGIN_DIR.'/cheesepress/framework/_class_Churro.php';
	
// get this thing going as early as possible.
if( is_admin() ){
	add_action( 'admin_menu', 'Churro::Bootstrap' );
	
	register_activation_hook( __FILE__, 'Churro::Activation' );
} else {
	add_action( 'parse_request', 'Churro::Bootstrap' );
}