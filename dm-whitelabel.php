<?php


function remove_dashboard_meta() {
remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
}
add_action('admin_init', 'remove_dashboard_meta');


add_filter('admin_footer_text', 'modify_footer_admin');
function modify_footer_admin () {
  echo 'Created by <a href="http://www.dentexmedia.com.au/">Dentex Media</a>';
}

function dm_dashboard_widget() {
// Display whatever it is you want to show
  echo '<h3>Hello.</h3><br>
  Welcome to your Wordpress website. <br>
  Wordpress is a powerful platform for you to manage your content. <br>
  Use the links to the left to manage parts of your site. <br>
  There is a lot of documentation available online. <br>
  If you still need direct support, then contact your web developer.';
}
// Create the function use in the action hook
function dm_add_dashboard_widget() {
  wp_add_dashboard_widget('dm_dashboard_widget1', 'Welcome To Your Wordpress CMS', 'dm_dashboard_widget');
}
add_action('wp_dashboard_setup', 'dm_add_dashboard_widget' );

// remove upgrade notification
remove_action( 'admin_notices', 'update_nag', 3 );


function new_login_styles() {
  echo '<style type="text/css">
  h1 a {background-image: none !important;}
  body {background-color: white;}
</style>';
}
add_action('login_head','new_login_styles');



//Change the howdy message
function howdy_message($translated_text, $text, $domain) {
    $new_message = str_replace('Howdy, ', 'User Currently Logged In :  ', $text);
    return $new_message;
}

add_filter('gettext', 'howdy_message', 10, 3);




 //This section removes the comments and new menus from Admin Bar
function my_admin_bar_edit() {

  // remove icons from the default menu bar
  global $wp_admin_bar;
 $wp_admin_bar->remove_node('comments');
  $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('wpseo-menu');
  $wp_admin_bar->remove_node('itsec');
    $wp_admin_bar->remove_node('search');

    $wp_admin_bar->remove_node('wp-logo');
//    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('revslider');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_edit', 99999);






function filter_admin_menues() {
// If administrator then do nothing & exit this function, otherwise hide all the menu options
if (current_user_can( 'administrator')){ 
return;
}



//Remove main menus
 $main_menus_to_stay = array(
'index.php', // Dashboard
'edit.php', // Posts
'edit.php?post_type=page', //Pages
//'options-general.php',//Settings
'upload.php', //Media
//'edit-comments.php', //Comments
//'themes.php', //Appearance
//'plugins.php', //plugins
//'users.php',//Users
'profile.php',//Users
//'tools.php', //Tools
'revslider.php',//Users
'wp-statistics/wp-statistics.php' //wp-statistics
//'wpcf7', //ContactForm
//'wpseo_dashboard'
);

// Remove sub menus
 $sub_menus_to_stay = array(
// Dashboard
  'index.php' => ['index.php'],
// Edit
  'edit.php' => ['edit.php', 'post-new.php']
  );

 if (isset($GLOBALS['menu']) && is_array($GLOBALS['menu'])) {
  foreach ($GLOBALS['menu'] as $k => $main_menu_array) {
// Remove main menu
    if (!in_array($main_menu_array[2], $main_menus_to_stay)) {
      remove_menu_page($main_menu_array[2]);
    } else {
    }
  }
}
remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
remove_submenu_page('index.php', 'update-core.php');
}

// Filter admin side navigation menues
add_action('admin_init','filter_admin_menues');

