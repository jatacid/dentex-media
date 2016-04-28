<?php
//Add functions here which control the wordpress environment


//Disables the double optin with subscribe forms on mailchimp
add_filter( 'fl_builder_mailchimp_double_option', '__return_false' );

