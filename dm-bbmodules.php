<?php

// Add a template widget
function fl_load_module_layout() {
	if( class_exists('FLBuilder') ) {
		require_once  dirname( __FILE__ ) . '/modules/bb-layout-master/includes/dm-bb-layout.php';
	}
}
add_action('init', 'fl_load_module_layout', 99);