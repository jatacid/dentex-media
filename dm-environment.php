<?php

//Disables the double optin with subscribe forms on mailchimp
add_filter( 'fl_builder_mailchimp_double_option', '__return_false' );

//Makes Formidable upload to default location
add_filter('frm_upload_folder', 'frm_custom_upload');
function frm_custom_upload($folder){
	$folder = '';
	return $folder;
}


function this_plugin_first() {
    // ensure path to this file is via main wp plugin path
    $wp_path_to_this_file = preg_replace('/(.*)plugins\/(.*)$/', WP_PLUGIN_DIR."/$2", __FILE__);
    $this_plugin = plugin_basename(trim($wp_path_to_this_file));
    $active_plugins = get_option('active_plugins');
    $this_plugin_key = array_search($this_plugin, $active_plugins);
    if ($this_plugin_key) { // if it's 0 it's the first plugin already, no need to continue
        array_splice($active_plugins, $this_plugin_key, 1);
        array_unshift($active_plugins, $this_plugin);
        update_option('active_plugins', $active_plugins);
    }
}
add_action("activated_plugin", "this_plugin_first");