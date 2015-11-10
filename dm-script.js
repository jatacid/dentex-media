



//Forces the show/hide to scroll open/closed

jQuery('.wpsm-content').addClass('wpsm-content-hide')
jQuery('.wpsm-show, .wpsm-hide').removeClass('wpsm-content-hide')

    jQuery('.wpsm-show').on('click', function(e) {
      jQuery(this).next('.wpsm-content').slideDown("slow").removeClass('wpsm-content-hide');
      jQuery(this).slideDown("slow");
      e.preventDefault();
    });


    jQuery('.wpsm-hide').on('click', function(e) {
      var wpsm = jQuery(this).parent('.wpsm-content');
      wpsm.slideUp("slow").addClass('wpsm-content-hide');
      wpsm.prev('.wpsm-show').removeClass('wpsm-content-hide');
      e.preventDefault();
    });




