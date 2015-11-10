<?php
//Runs a deletion and settings customization function to set wordpress to ideal environment


// Find and delete the WP default 'Hello world!'
$post = get_page_by_path('hello-world',OBJECT,'post');
if ($post){
  wp_delete_post($post->ID,true);
}

// Find and delete the WP default 'Sample Page'
$defaultPage = get_page_by_title( 'Sample Page' );
if ($defaultPage) {
  wp_delete_post( $defaultPage->ID );
}


if(get_page_by_title('Home')) {
}
else {
  global $wpdb;
// First Page
  $first_page = get_site_option( 'first_page', $first_page );
  $first_post_guid = get_option('home') . '/?page_id=1';
  $wpdb->insert( $wpdb->posts, array(
    'post_date' => $now,
    'post_date_gmt' => $now_gmt,
    'post_content' => '',
    'post_excerpt' => '',
    'post_title' => __( 'Home' ),


    /* translators: Default page slug */
    'post_name' => __( 'home' ),
    'post_modified' => $now,
    'post_modified_gmt' => $now_gmt,
    'guid' => $first_post_guid,
    'post_type' => 'page',
    'to_ping' => '',
    'pinged' => '',
    'comment_status' => 'closed',
    'post_content_filtered' => ''
    ));

  $wpdb->insert( $wpdb->postmeta, array( 'post_id' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'default' ) );

// Use a static front page
  $about = get_page_by_title( 'Home' );
  update_option( 'page_on_front', $about->ID );
  update_option( 'show_on_front', 'page' );

// Setup a Menu
  $menu_name = "Menu1";
  $menu_id = wp_create_nav_menu($menu_name);

// Uncategorized ID is always 1
  wp_update_term(1, 'category', array(
    'name' => 'Blog',
    'slug' => 'blog',
    'description' => 'Blog'
    ));


  update_option( 'show_avatars', 0);

// Set Timezone
  update_option( 'timezone_string', 'Australia/Brisbane' );

// Start of the Week
// 0 is Sunday, 1 is Monday and so on
  update_option( 'start_of_week', 1 );

// Increase the Size of the Post Editor
  update_option( 'default_post_edit_rows', 40 );

// Don't Organize Uploads by Date
  update_option('uploads_use_yearmonth_folders',0);

// Update Permalinks
  update_option( 'selection','custom' );
  update_option( 'permalink_structure','/%postname%/' );

  update_option( 'comment_moderation', 1 );

  /** Before a comment appears the comment author must have a previously approved comment: false */
  update_option( 'comment_whitelist', 0 );


  /** Allow people to post comments on new articles (this setting may be overridden for individual articles): false */
  update_option( 'default_comment_status', 0 );


// Disable Smilies
  update_option( 'use_smilies', 0 );

  /* Limit saved revisions */
  define('WP_POST_REVISIONS', 20);

  update_user_meta( $user_id, 'show_welcome_panel', 0 );

  define( 'WP_DEFAULT_THEME', 'bb-child' );
  update_option('template', 'bb-theme');
  update_option('stylesheet', 'bb-child');


  $plugins = FALSE;
$plugins = get_option('active_plugins'); // get active plugins
if ( $plugins ) {
// plugins to active
  $pugins_to_active = array(
    'bb-plugin/fl-builder.php'
    );

  foreach ( $pugins_to_active as $plugin ) {
    if ( ! in_array( $plugin, $plugins ) ) {
      array_push( $plugins, $plugin );
      update_option( 'active_plugins', $plugins );
    }
  }
} // end if $plugins
}