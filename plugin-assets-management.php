<?php
/**
 * Plugin Name:       Plugin Assets Management
 * Plugin URI:        https://classysystem.com/plugin/plugin-assets-management/
 * Description:       Handle the basics with this plugin assets management
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Gazi Akter
 * Author URI:        https://gaziakter.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://classysystem.com/
 * Text Domain:       plugin-assets
 * Domain Path:       /languages
 */

 /**
  * Define constant
  */
 define( "ASN_ASSETS_DIR", plugin_dir_url( __FILE__ ) . "assets/" );
 define( "ASN_ASSETS_PUBLIC_DIR", plugin_dir_url( __FILE__ ) . "assets/public" );
 define( "ASN_ASSETS_ADMIN_DIR", plugin_dir_url( __FILE__ ) . "assets/admin" );
 define( 'ASN_VERSION', time() );

 class AssetsNinja {
	function __construct() {

		$this->version = time();

		add_action( 'init',array($this,'asn_init' ) );
	}

    function asn_init(){
		wp_deregister_style('fontawesome-css');
		wp_register_style('fontawesome-css','//use.fontawesome.com/releases/v5.2.0/css/all.css');
	}
    
}

new AssetsNinja();