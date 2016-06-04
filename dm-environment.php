<?php

//Disables the double optin with subscribe forms on mailchimp
add_filter( 'fl_builder_mailchimp_double_option', '__return_false' );

//Makes Formidable upload to default location
add_filter('frm_upload_folder', 'frm_custom_upload');
function frm_custom_upload($folder){
	$folder = '';
	return $folder;
}