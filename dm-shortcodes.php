<?php


//[show_more more="your text" less="your text" color="#0066CC" list="»"] Your hidden Content [/show_more]
add_shortcode( 'show_more', 'wpsm');
function wpsm( $attr, $smcontent ) {
	if (!isset($attr['color'])) $attr['color'] = '#cc0000';
	if (!isset($attr['more'])) $attr['more'] = ' »» read more ';
	$wpsm_string = '<p class="wpsm-show" style="display: inline; color: ' . $attr['color'] . ' ">';
	$wpsm_string .= $attr['more'];
	$wpsm_string .= '</p><span class="wpsm-content">';
	$wpsm_string .= $smcontent;
	$wpsm_string .= '</span>';
	return $wpsm_string;
}


//[get_param urlparam="site" default="J7Digital"]
add_shortcode( 'get_param', 'get_url_param');
function get_url_param( $attr, $smcontent ) {
	$urlparam = $attr['urlparam'];
	if (filter_input(INPUT_GET,$urlparam,FILTER_SANITIZE_STRING)) {
		$urlparam = filter_input(INPUT_GET,$urlparam,FILTER_SANITIZE_STRING);
		return $urlparam;
	}else{
		return $attr['default'];
	}
}


//[wp_login_form lostpasswordurl="/wp-login.php?action=lostpassword" newaccounturl="/wp-login.php?action=register" redirect="blog"]
add_shortcode ('wp_login_form', 'clw_shortcode');
function clw_shortcode ($attr, $content)
{
	ob_start ();
	clw_form ($attr);
	return ob_get_clean ();
}

function clw_form ($attr){

	if ( is_user_logged_in() ) { ?>
		<?php $current_user = wp_get_current_user(); ?>
		<h1>Hello <?php echo $current_user->display_name ?></h1>

	</br>
	<p>You're all logged in!</p>

	<?php
} else {


	if (!isset($attr['lostpasswordurl'])){
		$attr['lostpasswordurl'] = 'wp-login.php?action=lostpassword';
	}
	if (!isset($attr['newaccounturl'])){
		$attr['newaccounturl'] = 'wp-login.php?action=register';
	}
	if (!isset($attr['redirect'])){
		$attr['redirect'] = home_url();
	} else {
		$attr['redirect'] = home_url($attr['redirect']);
		$redirect = $attr['redirect'];
	}

	echo '<a href="' . get_option('home') . '/' .$attr['lostpasswordurl'] . '">Recover Password </a>';
	echo ' | ';
	echo '<a href="' . get_option('home') . '/' . $attr['newaccounturl'] . '">Register an Account</a>';


	$args = array(
		'echo'           => true,
		'form_id' => 'loginform',
		'label_username' => __( 'Username' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in'   => __( 'Log In' ),
		'id_username'    => 'user_login',
		'id_password'    => 'user_pass',
		'id_remember'    => 'rememberme',
		'id_submit'      => 'wp-submit',
		'value_remember' => TRUE,
		'remember'       => TRUE,
		'redirect'		=> $redirect
		);
	wp_login_form( $args );
}

}