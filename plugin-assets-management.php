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
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_front_assets' ) );

	}

    function asn_init(){
		wp_deregister_style('fontawesome-css');
		wp_register_style('fontawesome-css','//use.fontawesome.com/releases/v5.2.0/css/all.css');
	}

    function load_textdomain() {
		load_plugin_textdomain( 'plugin-assets', false, plugin_dir_url( __FILE__ ) . "/languages" );
	}

    function load_front_assets() {
		wp_enqueue_style( 'asn-main-css', ASN_ASSETS_PUBLIC_DIR . "/css/main.css", null, $this->version );

		/*wp_enqueue_script( 'asn-main-js', ASN_ASSETS_PUBLIC_DIR . "/js/main.js", array(
			'jquery',
			'asn-another-js'
		), $this->version, true );

		wp_enqueue_script( 'asn-another-js', ASN_ASSETS_PUBLIC_DIR . "/js/another.js", array(
			'jquery',
			'asn-more-js'
		), $this->version, true );

		wp_enqueue_script( 'asn-more-js', ASN_ASSETS_PUBLIC_DIR . "/js/more.js", array( 'jquery' ), $this->version, true );*/

		$js_files = array(
			'asn-main-js'=>array('path'=>ASN_ASSETS_PUBLIC_DIR . "/js/main.js",'dep'=>array('jquery','asn-another-js')),
			'asn-another-js'=>array('path'=>ASN_ASSETS_PUBLIC_DIR . "/js/another.js",'dep'=>array('jquery','asn-more-js')),
			'asn-more-js'=>array('path'=>ASN_ASSETS_PUBLIC_DIR . "/js/more.js",'dep'=>array('jquery')),
		);
		foreach($js_files as $handle=>$fileinfo){
			wp_enqueue_script($handle,$fileinfo['path'],$fileinfo['dep'],$this->version,true);
		}


		$data     = array(
			'name' => 'Gazi Akter',
			'url'  => 'https:/gaziakter.com/'
		);
		$moredata = array(
			'name' => 'Gazi Akter',
			'url'  => 'https:/gaziakter.com/'
		);

		$translated_strings = array(
			'greetings' => __( 'Hello World', 'plugin-assets' )
		);

		wp_localize_script( 'asn-more-js', 'sitedata', $data );
		wp_localize_script( 'asn-more-js', 'moredata', $moredata );
		wp_localize_script( 'asn-more-js', 'translations', $translated_strings );

	}
    
}

new AssetsNinja();