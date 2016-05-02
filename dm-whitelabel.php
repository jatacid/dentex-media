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
  h1 {
    background-size: contain;
    background-repeat: no-repeat;
    width: 100%;
    height: 100px;

}

  h1 a {display:  none !important;}
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
//  $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('wpseo-menu');
  $wp_admin_bar->remove_node('itsec');
    $wp_admin_bar->remove_node('search');
    $wp_admin_bar->remove_node('edit');
    $wp_admin_bar->remove_node('wp-logo');
//    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('revslider');
    $wp_admin_bar->remove_node('fl-builder-frontend-edit-link');
  }
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_edit', 99999);




//Add custom CSS shortcut to adminbar
add_action( 'admin_bar_menu', 'toolbar_css_shortcut', 997 );
function toolbar_css_shortcut( $wp_admin_bar ) {

$str = "customize.php?autofocus[control]=fl-css-code";
$ur = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = admin_url();

if (current_user_can( 'administrator')){
  $args = array(
    'id'    => 'css_shortcut',
    'title' => 'CSS Shortcut',
    'href'  => $url . $str . '&url=' . $ur ,
    'meta'  => array( 'class' => 'my-toolbar-page' )
  );
  $wp_admin_bar->add_node( $args );

//add submenu to site-name link for quick access to plugins
 $args = array(
    'id'    => 'pluginshortcut',
    'title' => 'Plugins',
    'href'  => admin_url( 'plugins.php' ),
    'parent' => 'site-name'
  );
  $wp_admin_bar->add_node( $args );
}
}


//Add custom bbedit-pages shortcut to adminbar
add_action( 'admin_bar_menu', 'edit_bb_pg', 999 );
function edit_bb_pg( $wp_admin_bar ) {

if (current_user_can( 'administrator')){


$ur = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$ur = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$pos = strpos($ur, 'wp-admin');
if ($pos === false){
  $ur = $ur . '?fl_builder';
}else{
  $ur = '';
}


  $args = array(
    'id'    => 'edit_bb_pg',
    'title' => 'Edit Page in BB',
    'href'  =>  $ur,
    'meta'  => array( 'class' => 'edit_bb_pg_group' )
  );
  $wp_admin_bar->add_node( $args );

 $pages = get_pages(array( 'parent' => '0', 'sort_column' => 'menu_order'));
  foreach ( $pages as $page ) {
  $link = get_page_link( $page->ID );
  $title = $page->post_title;
  $args = array(
    'id'    => $page->ID . 'bbpg',
    'title' => $title,
    'href'  => $link . '?fl_builder',
    'parent' => 'edit_bb_pg',
    'meta'  => array( 'class' => 'edit_bb_pg_group' )
  );
  $wp_admin_bar->add_node( $args );

      $subpages = get_pages( array( 'child_of' => $page->ID, 'sort_column' => 'menu_order'));
         foreach( $subpages as $subpage ) {
            $link = get_page_link( $subpage->ID );
            $title = $subpage->post_title;
            $args = array(
                'id'    => $subpage->ID. 'bbpg',
                'title' => $title,
                'href'  => $link . '?fl_builder',
                'parent' => $page->ID . 'bbpg',
                'meta'  => array( 'class' => 'edit_bb_pg_group' )
              );
              $wp_admin_bar->add_node( $args );
         }
  }
}
}


//Add custom wp edit-pages shortcut to adminbar
add_action( 'admin_bar_menu', 'edit_wp_pg', 998 );
function edit_wp_pg( $wp_admin_bar ) {

if (current_user_can( 'administrator')){

$id = get_the_ID();

  $args = array(
    'id'    => 'edit_wp_pg',
    'title' => 'Edit Page in WP',
    'href'  => admin_url( '/post.php?post=' . $id . '&action=edit'),
    'meta'  => array( 'class' => 'edit_wp_pg_group' )
  );
  $wp_admin_bar->add_node( $args );

  $args = array(
    'id'    => 'viewedit_wp_pg',
    'title' => 'View ALL Pages in Backend',
    'href'  => admin_url( '/edit.php?post_type=page'),
    'parent' => 'edit_wp_pg',
    'meta'  => array( 'class' => 'edit_wp_pg_group' )
  );
  $wp_admin_bar->add_node( $args );



  $pages = get_pages(array( 'parent' => '0', 'sort_column' => 'menu_order'));
  foreach ( $pages as $page ) {
  $link = $page->ID;
  $title = $page->post_title;
  $args = array(
    'id'    => $page->ID . 'wppg',
    'title' => $title,
    'href'  => admin_url( '/post.php?post=' . $link . '&action=edit'),
    'parent' => 'edit_wp_pg',
    'meta'  => array( 'class' => 'edit_wp_pg_group' )
  );
  $wp_admin_bar->add_node( $args );

      $subpages = get_pages( array( 'child_of' => $page->ID, 'sort_column' => 'menu_order'));
         foreach( $subpages as $subpage ) {
            $link = $subpage->ID;
            $title = $subpage->post_title;
            $args = array(
                'id'    => $subpage->ID. 'wppg',
                'title' => $title,
                'href'  => admin_url( '/post.php?post=' . $link . '&action=edit'),
                'parent' => $page->ID . 'wppg',
                'meta'  => array( 'class' => 'edit_wp_pg_group' )
              );
              $wp_admin_bar->add_node( $args );
         }

  }
}
}


//Add navigation wp pages to shortcut to all pages to adminbar
//Add custom bbedit-pages shortcut to adminbar
add_action( 'admin_bar_menu', 'view_bb_pg', 996 );
function view_bb_pg( $wp_admin_bar ) {

if (current_user_can( 'administrator')){
  $args = array(
    'id'    => 'view_bb_pg',
    'title' => 'View Page',
    'href'  =>  '',
    'meta'  => array( 'class' => 'view_bb_pg_group' )
  );
  $wp_admin_bar->add_node( $args );

 $pages = get_pages(array( 'parent' => '0', 'sort_column' => 'menu_order'));
  foreach ( $pages as $page ) {
  $link = get_page_link( $page->ID );
  $title = $page->post_title;
  $args = array(
    'id'    => $page->ID . 'vpg',
    'title' => $title,
    'href'  => $link,
    'parent' => 'view_bb_pg',
    'meta'  => array( 'class' => 'view_bb_pg_group' )
  );
  $wp_admin_bar->add_node( $args );

      $subpages = get_pages( array( 'child_of' => $page->ID, 'sort_column' => 'menu_order'));
         foreach( $subpages as $subpage ) {
            $link = get_page_link( $subpage->ID );
            $title = $subpage->post_title;
            $args = array(
                'id'    => $subpage->ID. 'vpg',
                'title' => $title,
                'href'  => $link,
                'parent' => $page->ID . 'vpg',
                'meta'  => array( 'class' => 'view_bb_pg_group' )
              );
              $wp_admin_bar->add_node( $args );
         }
  }
}
}















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
'wps_overview_page' //wp-statistics
//'wpcf7', //ContactForm
//'wpseo_dashboard'
);

// Remove sub menus
 $sub_menus_to_stay = array(
// Dashboard
  'index.php' => 'index.php',
// Edit
  'edit.php' => 'edit.php', 'post-new.php'
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


/* testing a way to export all menu items to create a dynamic white label plugin */

/*

add_action( 'admin_init', 'admin_page_items' );

function admin_page_items() {

global $menu;

echo '<div style="float: right; max-width:  800px;">';

foreach ($menu as $key => $value) {
 echo $value[0];
 echo '<br>';
}

echo'</div>';
}
*/