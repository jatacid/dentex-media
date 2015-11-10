<?php
/*
Plugin Name: Dentex Media Plugin
Plugin URI: https://www.dentexmedia.com.au
Description: A plugin for setting up wordpress environment to ideal conditions.
Author: Dentex Media
Version: 1.0.1
Author URI: http://www.dentexmedia.com.au
*/



//Updater Class
add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {

	include_once 'updater.php';

	define( 'WP_GITHUB_FORCE_UPDATE', true );

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
			'requires' => '4.2',
			'tested' => '4.3',
			'readme' => 'README.md',
			'access_token' => 'ddeb3d9457870d518b565043ec8003ba7eb235eb',
		);

		new WP_GitHub_Updater( $config );

	}

}



//Enqueue custom styles & css
add_action('fl_head','dm_head');
function dm_head(){ ?>
<?php
  $plugin_url = plugins_url( '/', __FILE__ );
  wp_enqueue_style (
    'dm-style',
    $plugin_url . 'dm-style.css'
  );
  wp_enqueue_script (
    'dm-script',
    $plugin_url . 'dm-script.js',
    array( 'jquery' ),
    '1.0.1',
    true
  );
}






// Load customizer settings (adds a custom part to the customizer)
require_once 'dm-customizer.php';

// Load environment (ensures certain settings remain on at all times)
require_once 'dm-environment.php';

// Load installer
require_once 'dm-install.php';

// Load shorcodes settings 
require_once 'dm-shortcodes.php';

// Load white-labelling
require_once 'dm-whitelabel.php';
