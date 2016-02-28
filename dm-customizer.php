<?php

function dentex_register_theme_customizer( $wp_customize ) {
// Add the Dentex Media Settings to the customizer.
  $wp_customize->add_section( 'dentex-media', array(
    'title'=> __( 'Dentex Media Settings', 'fl-automator' ),
    'description' => __( 'Select the template to use as a header. It has the ID of #custom-header.', 'fl-automator' ),
    'priority'=> 130,
    ) );

    $wp_customize->add_setting('dentex_header_template', array(
      'default' => 'Choose A Template',
      )
    );

      $wp_customize->add_control('dentex_header_template', array(
        'label' => 'Template',
        'description' => 'Render a BB template file within "header" tags',
        'section' => 'dentex-media',
        'type' => 'select',
        'choices' => get_bb_templates()

        )
      );


}
add_action( 'customize_register', 'dentex_register_theme_customizer' );





function insert_custom_template() {

$settings =  FLCustomizer::get_mods();
$template = $settings['dentex_header_template'];
if ($template !== '' ){
echo '<header id="dentex-header">' . do_shortcode('[fl_builder_insert_layout id="'.$template.'"]') . '</header>';
} 
}
add_action( 'fl_after_header', 'insert_custom_template' );


function get_bb_templates() {
    $data  = array();
    $query = new WP_Query( array(
        'post_type'     => 'fl-builder-template',
        'orderby'       => 'title',
        'order'       => 'ASC',
        'posts_per_page'  => '-1'
    ));

  $data = array(
        '' => 'Choose A Template'
    );

foreach( $query->posts as &$post ) {
        $data[ $post->ID ] = $post->post_title;
    }
    return $data;
}
