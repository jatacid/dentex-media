<?php
/*
Plugin Name: Dentex Media Plugin
Plugin URI: https://www.dentexmedia.com.au
Description: A plugin for setting up wordpress environment to ideal conditions.
Author: Dentex Media
Version: 3.5
Author URI: https://www.dentexmedia.com.au
*/


define( 'BRANDING', 'Advanced' );
//Updater Class
if (!function_exists( 'github_plugin_updater_test_init' )) {
function github_plugin_updater_test_init() {

include_once 'updater.php';
define( 'WP_GITHUB_FORCE_UPDATE', true );
}
}
add_action( 'init', 'github_plugin_updater_test_init' );



function dentex_media_updater() {
	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
$login = 'jatacid/dentex-media';

		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'dentex-media',
			'api_url' => 'https://api.github.com/repos/' . $login,
			'raw_url' => 'https://raw.github.com/' . $login .'/master',
			'github_url' => 'https://github.com/'. $login,
			'zip_url' => 'https://github.com/'. $login .'/archive/master.zip',
			'sslverify' => true,
			'requires' => '3.0',
			'tested' => '4.1',
			'readme' => 'README.md',
			'access_token' => '',
		);
		new WP_GitHub_Updater( $config );
}
}
add_action( 'init', 'dentex_media_updater' );





//Enqueue custom styles & css

function dm_head(){
	global $plugin_url;
  $plugin_url = plugins_url( '/', __FILE__ );
  //wp_enqueue_style ('dm-style', $plugin_url . 'dm-style.css');
  //wp_enqueue_script ('dm-script',$plugin_url . 'dm-script.js', array( 'jquery' ),'1.0.1', true );



}
//add_action('wp_enqueue_scripts','dm_head');



// Load environment (ensures certain settings remain on at all times)
require_once 'dm-environment.php';

// Load installer
require_once 'dm-install.php';

// Load shorcodes settings
require_once 'dm-shortcodes.php';

// Load white-labelling
require_once 'dm-whitelabel.php';

// Load Beaver Builder Stuff
  if ( class_exists( 'FLBuilder' ) ) {
define( 'BBLIVEPREVIEW_VERSION' , '1.1.8' );
define( 'BBLIVEPREVIEW_DIR', plugin_dir_path( __FILE__ ) );
define( 'BBLIVEPREVIEW_URL', plugins_url( '/', __FILE__ ) );

       require_once ( 'livepreview/livepreview.php' );

  }
