//Forces the show/hide to scroll open/closed
jQuery(document).ready(function(){
  jQuery('.wpsm-content').slideToggle('slow');
  jQuery(".wpsm-show").prev().css( "display", "inline" );


    jQuery('.wpsm-show').on('click', function(e) {

        $txt = jQuery(this).text();
        if ( $txt != ' «« hide ' ){
            jQuery(this).text(' «« hide ');
        } else{
            jQuery(this).text(' »» read more ');
        }
        jQuery(this).next('.wpsm-content').slideToggle('slow');
        e.preventDefault();
    });
});


