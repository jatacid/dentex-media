<?php

function dentex_register_theme_customizer( $wp_customize ) {
// Add the Dentex Media Settings to the customizer.
  $wp_customize->add_section( 'dentex-media', array(
    'title'=> __( 'Dentex Media Settings', 'fl-automator' ),
    'description' => __( 'Enter the html code below to override the "header" section for your theme.', 'fl-automator' ),
    'priority'=> 130,
    ) );

    $wp_customize->add_setting( 'dentex_header_active', array(
      'default'=> 'Off',
      ) );

      $wp_customize->add_control( 'dentex_header_active', array(
        'label'=> __( 'Custom Header?', 'fl-automator' ),
        'section' => 'dentex-media',
        'type'=> 'select',
        'choices' => array(
          'dentex_header_off' => __( 'Off', 'fl-automator' ),
          'dentex_header_on' => __( 'On','fl-automator' ),
          ),
        ) );


    $wp_customize->add_setting('dentex_header_html_textbox', array(
      'default' => '<h1>DentexHeaderGoesHere</h1>',
      )
    );

      $wp_customize->add_control('dentex_header_html_textbox', array(
        'label' => 'HTML',
        'description' => 'HTML Code stored within "header" tags',
        'section' => 'dentex-media',
        'type' => 'textarea',
        )
      );


    $wp_customize->add_setting( 'dentex_media_css', array(
      'default' => '@media (min-width: 768px){}
@media (min-width: 992px){}
@media (min-width: 1100px){}
@media (min-width: 1200px){}',
      )
    );

      $wp_customize->add_control( 'dentex_media_css', array(
        'label' => 'Media CSS',
        'description' => 'Enter css for mobile device media queries and above',
        'section'=> 'dentex-media',
        'type' => 'textarea',
        )
      );




}
add_action( 'customize_register', 'dentex_register_theme_customizer' );







function dent_header(){
  $settings = FLCustomizer::get_mods();

  if ( 'dentex_header_on' == $settings[ 'dentex_header_active' ] ) {

echo '<header fl-page-header fl-page-header-primary>' . $settings[ 'dentex_header_html_textbox' ] . '</header>';
  }

}
add_action('fl_before_header', 'dent_header');



function dent_media_css(){
  $settings = FLCustomizer::get_mods();

// CSS
     echo '<style type="text/css">' . $settings[ 'dentex_media_css' ] . '</style>' . "\n";
}
    add_action('fl_head', 'dent_media_css');
