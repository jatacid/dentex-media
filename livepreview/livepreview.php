<?php

add_action( 'wp_enqueue_scripts','load_on_builder' );

function load_on_builder () {
    if ( isset( $_GET['fl_builder'] ) ) {

		wp_enqueue_script( 'bbpaneloptions', BBLIVEPREVIEW_URL.'livepreview/includes/jquery.bbpaneloptions.js' , array ( 'jquery' ) , '' , false );
		wp_enqueue_script( 'bblivepreview', BBLIVEPREVIEW_URL.'livepreview/includes/livepreview.js' , array ( 'jquery' ) , '' , false );




  }
}
