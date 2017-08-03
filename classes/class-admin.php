<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Change DB Prefix Plugin Admin class.
 */
class CdprefixPlugin_Admin {
	/**
	 * @var string
	 */
	public $theme_path; //To overwrite template
	/**
	 * Create a null object of CdprefixPlugin_Admin
	 *
	 * @return CdprefixPlugin_Admin $cdprefixPlugin_AdminObj
	 */
	public function Create($plugin_path) {
		return 	$cdprefixPlugin_AdminObj = new CdprefixPlugin_Admin($plugin_path);
	}
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct($plugin_path) {
		$this->theme_path	= THEME_PATH;
		$this->plugin_path	= $plugin_path;
		//add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		$this->createAdminFromData();
	}
	/**
	 * admin_enqueue_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_enqueue_scripts( ) {echo "fist";exit;
		do_action( PLUGIN_SLUG. '_register_styles' );
		do_action( 'uberMenu_after_init' );
		//wp_enqueue_style( 'download_monitor_menu_css', $download_monitor->plugin_url() . '/assets/css/menu.css' );
		//wp_enqueue_script( 'jquery-blockui', $download_monitor->plugin_url() . '/assets/js/blockui.min.js', array( 'jquery' ), '2.61' );
	}
	/*
	 * 
	 */
	public function createAdminFromData(){
		$this->getTemplate(TEMPLATES_PATH, 'render_admin.php');
		
	}
	protected function getTemplate($directory_path, $filename ) {
			$located = $this->templateLocation( $directory_path, $filename );
			if ( $var && is_array( $var ) ) {
				extract( $var );
			}			
			if ( $return ) {
				ob_start();
			}
			// include file located
			include( $located );
			if ( $return ) {
				return ob_get_clean();
			}
	}
	protected function templateLocation( $directory_path, $filename ) {
		$template_path =  $this->theme_path. $filename;
        $located = locate_template( array( $template_path) );

        if ( ! $located ) {
            $located = $this->plugin_path.$directory_path .$filename;
        }

        return $located;
    }
}