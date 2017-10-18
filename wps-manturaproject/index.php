<?php
ob_start();
/**
 * Plugin Name: Mantura Project Addons
 * Plugin URI: 
 * Description: Mantura Project Addons 
 * Version: 1.0.0
 * Author: Web Planet Soft
 * Author URI:  http://webplanetsoft.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	die("You can't access this file directly"); // disable direct access
}


class WPS_MANTURA_PROJECT
{
		
	public $aParams;
	public function __construct()
	{
		global $wpdb;
		
		add_action( 'init', array($this, 'wps_mantura_project_init'));
		add_action( 'get_footer', array(&$this,'wps_mantura_project_footer_styles' ));		
	
		//shortcodes
		add_shortcode('wps_mantura_company',array($this, 'wps_mantura_company_shortcode'));
		
		//ajax		
		add_action( 'wp_ajax_wps_mantura_company_ajax', array(&$this,'wps_mantura_company_ajax' ));
		add_action('wp_ajax_nopriv_wps_mantura_company_ajax', array(&$this,'wps_mantura_company_ajax'));
		
	
		register_activation_hook( __FILE__, array($this,'activation_wps_plugin') );
		register_uninstall_hook( __FILE__, array($this,'uninstall_wps_plugin' ));			
	}	


	public function wps_mantura_project_init()
	{
		register_post_type( 'wps_mantura_company',
			array(
			  'labels' => array(
				'name' => __( 'Mantura Company' ),
				'singular_name' => __( 'Mantura Company' )
			  ),
			  'public' => true,
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
			)
		  );
		  
		  register_taxonomy('company_type',
			array('wps_mantura_company'),
			array(
				 'labels' => array(
				  'name' => 'Company Type',
				  'add_new_item' => 'Add New Type',
				  'new_item_name' => "New Type"
				 ),
				 'show_ui' => true,
				 'show_tagcloud' => true,
				 'hierarchical' => false
			 )
		   );
		  
	}
		
	public function set_template($aTemplate,$aOpts = array())
	{
		ob_start();		
		$aParams['template'] = $aTemplate;
		$aVars = $aOpts ? array_merge($aParams,$aOpts) : $aParams;
		include "template/template.php";		
		return ob_get_clean();		
	}	

	public function wps_mantura_project_footer_styles()
	{		
		//wp_enqueue_script('wps_mantura_project_script', plugins_url( 'src/custom.js', __FILE__) );
		//wp_enqueue_style('wps_mantura_project_style', plugins_url( 'src/style.css', __FILE__ ) );
	}
	
	public function wps_mantura_company_ajax()
	{
		$return = false;
		$aVals = $_POST['wpsval'];
		if($aVals)
		{
		
			$arg = array(
			  'post_title'    => $aVals['title'],
			  'post_content'  =>  $aVals['description'],
			  'post_status'   => 'publish',
			  'post_type'   => 'wps_mantura_company',
			  'post_author'   => 0,
			  'comment_status' => 'closed',
              'ping_status' => 'closed',
			  'tax_input' => array('company_type' => array($aVals['type']))
			);
			$post_id = wp_insert_post($arg);
			$return = true;
		}
		return $return;
		exit;
	}

	public function wps_mantura_company_shortcode()
	{
		return $this->set_template('company');
	}
	
	
	function activation_wps_plugin()
	{
		global $wpdb;		
	}
	
	function uninstall_wps_plugin()
	{
		global $wpdb;		
	}
	
}

$wpsObj = new WPS_MANTURA_PROJECT;
