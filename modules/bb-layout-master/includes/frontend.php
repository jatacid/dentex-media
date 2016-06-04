<?php
if( $settings->dm_layout_id ){
	echo do_shortcode('[fl_builder_insert_layout id="'. $settings->dm_layout_id .'"]');
}else{ ?>

	<div class="alert alert-warning" style="color: #000;" role="alert"><?php _e('Please, select a layout before','bb-layout'); ?></div>

<?php }