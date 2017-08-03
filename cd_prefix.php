<?php
/*
Plugin Name: Change Database Prefix
Plugin URI: http://www.creativedev.in
Description: a plugin to change database prefix
Version: 2.1
Date: 22-11-2016
Author: Ms. Bhumi Shah
Author URI: http://www.thecreativedev.com
*/

class CdprefixPlugin {
	/**
	 * @var string
	 */
	public $version = PLUGIN_VERSION;
	
	/**
	 * @var string
	 */
	public $plugin_url;
	public $plugin_path;
	public function __construct() {	
		$this->plugin_url        = ( plugins_url( '/', __FILE__ ) );
		$this->plugin_path       = ( plugin_dir_path( __FILE__ ) );
		
		// include constant file
		include_once(plugin_dir_path( __FILE__ ) . "/includes/plugin_constants.php");

		add_action( 'admin_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );
		if ( is_multisite() )
			add_action( 'network_admin_menu', array( $this, 'admin_menu' ) );
		else
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		//Localisation
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		// To include Script and styles
		if ( defined('DOING_AJAX') ) {
			include_once( 'classes/class-ajax-handler.php' );
		}
	}
	/**
	 * Localisation
	 *
	 * @access private
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_textdomain(PLUGIN_SLUG, WP_LANG_DIR . '/'.PLUGIN_SLUG.'/'.PLUGIN_SLUG.'-' . get_locale() . '.mo' );
		load_plugin_textdomain( PLUGIN_SLUG, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	} 
	/**
	 * admin_menu function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_menu() {
		add_menu_page(PLUGIN_TEXT,PLUGIN_TEXT, 'manage_options', PLUGIN_PAGE_SLUG, array( $this, 'admin_page' ), plugins_url(IMAGES_PATH.PLUGIN_IMAGE, __FILE__ ), 81.3 );
		require_once( $this->plugin_path .CLASSES_PATH.'class-admin.php' );
	}

	/**
	 * Output addons page
	 */
	public function admin_page() {	
		$ObjCdprefixPlugin_Admin	= CdprefixPlugin_Admin::Create($this->plugin_path);
	}
	
	/**
	 * settings_page function.
	 *
	 * @access public
	 * @return void
	 */
	public function settings_page() {
	}
    
    public function register_plugin_scripts() {
    	wp_register_script( 'cdp-bootstrapjs', $this->plugin_url.JS_PATH .'bootstrap.min.js' );
    	wp_enqueue_script( 'cdp-bootstrapjs' );
    	wp_register_script( 'scriptjs', $this->plugin_url.JS_PATH .'script.js' );
    	wp_enqueue_script( 'scriptjs' );
    	wp_register_style( 'cdp-bootstrapcss',$this->plugin_url.CSS_PATH .'bootstrap.css' );
    	wp_enqueue_style( 'cdp-bootstrapcss' );
    	wp_register_style( 'cdp-customcss',$this->plugin_url.CSS_PATH .'style.css' );
    	wp_enqueue_style( 'cdp-customcss' );
    	wp_localize_script('ajax-params',  'ajax_params_vars',  array(
		    	'ajaxurl'      => admin_url( 'admin-ajax.php' ),
		    	'ajaxnonce'   => wp_create_nonce( 'my_ajax_validation' ))
    	);    
    }
}
$cdprefixPlugin = new CdprefixPlugin();
?>