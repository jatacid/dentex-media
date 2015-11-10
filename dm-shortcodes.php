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