<?php


//[show_more more="your text" less="your text" color="#0066CC" list="»"] Your hidden Content [/show_more]

add_shortcode( 'show_more', 'wpsm');
function wpsm( $attr, $smcontent ) {
	if (!isset($attr['color'])) $attr['color'] = '#cc0000';
	if (!isset($attr['list'])) $attr['list'] = '';
	if (!isset($attr['more'])) $attr['more'] = 'show more';
	if (!isset($attr['less'])) $attr['less'] = 'show less';
	$wpsm_string  = '<div class="show_more">';
	$wpsm_string .= '<p class="wpsm-show" style="color: ' . $attr['color'] . ' ">';
	$wpsm_string .= $attr['list']. ' '  . $attr['more'];
	$wpsm_string .= '</p><div class="wpsm-content">';
	$wpsm_string .= $smcontent;
	$wpsm_string .= ' <p class="wpsm-hide" style="color: ' . $attr['color'] . ' ">';
	$wpsm_string .= $attr['list']. ' '  . $attr['less'];
	$wpsm_string .= '</p>';
	$wpsm_string .= '</div></div>';
	return $wpsm_string;
}


add_shortcode ('wp_login_form', 'clw_shortcode');
function clw_shortcode ($attr, $content)
{
	ob_start ();
	clw_form ('clw_shortcode');
	return ob_get_clean ();
}
add_action ('clw_form', 'clw_form');
function clw_form ($form_id){

	if ( is_user_logged_in() ) { ?>
	<?php $current_user = wp_get_current_user(); ?>
	<h1>Hello <?php echo $current_user->display_name ?></h1>

</br>
<p>You're all logged in! </br></br>
	Head over to your account at: <a href="<?php echo get_option('home'); ?>/my-account"><em>My Account</em></a></p>

	<?php
} else { ?>
<h1>Login</h1>
<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Recover password</a> | <a href="<?php echo get_option('home'); ?>/wp-login.php?action=register">Create an Account</a>
<?php
$args = array(
	'echo'           => true,
	'form_id' => 'loginform',
	'redirect' => site_url( '/home/ '),
	'label_username' => __( 'Username' ),
	'label_password' => __( 'Password' ),
	'label_remember' => __( 'Remember Me' ),
	'label_log_in'   => __( 'Log In' ),
	'id_username'    => 'user_login',
	'id_password'    => 'user_pass',
	'id_remember'    => 'rememberme',
	'id_submit'      => 'wp-submit',
	'value_remember' => true,
	'remember'       => true
	);
wp_login_form( $args );
}
}