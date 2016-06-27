( function ( $ ) {

	$( document ).ready ( function () {


		function toggle_livepreview() {
			if ( !isfullview ) {
				// remove the delagates
				FLBuilder._destroyOverlayEvents();

				// hide the bar
				$('.fl-builder-bar-content').css('opacity' , '0.3');

				// remove the top margin
				$('html.fl-builder-edit').prop('style' , 'margin-top:0px !important;' );

				// remove any remaining highlights
				$('.fl-col-highlight .fl-col-content').prop('style', 'border-width: 0px;');


				$('.bblivepreview').css('background-color', '#ff3535');

			} else {
				// activate the delegates
				FLBuilder._bindOverlayEvents();

				// show the bar
			$('.fl-builder-bar-content').css('opacity' , '1.0');

				// reenable the top margin
				$('html.fl-builder-edit').prop('style' , '' );

				// enable highlights
				$('.fl-col-highlight .fl-col-content').prop('style', '');

			$('.bblivepreview').css('background-color', 'transparent');

			}

			// close the panel
			FLBuilder._closePanel();

			// set the global value of isfullview
			isfullview = !isfullview;
		}


		/**
		 * callback function for when the FLBuilder is done saving the layout
		 * @uses  _savereset
		 * @return void
		 */
		_savedone = function () {
			// add css-class to indicate save is made
			$('.fl-builder-quicksave-button').css('background-color', '#00FF78');
			// set timeout to remove the class
			setTimeout( _savereset , 2000 );
		}
		/**
		 * callback function for resetting the layout of the save buttons
		 * @return void
		 */
		_savereset = function () {
			$('.fl-builder-quicksave-button').css('background-color', '');
		}

		/**
		 * Save the layout to Wordpress
		 * @uses  _savedone
		 * @return void
		 */
		_Quicksave = function () {
			FLBuilder.showAjaxLoader();
			FLBuilder.ajax({
				action: 'save_layout'
			}, _savedone );

		}

		// Make sure the FLBuilderModel exists before calling anything
		if ( typeof FLBuilderModel != undefined ) {
			// init state for fullview
			var isfullview = false;


			$.bbAddPanel({
				location: 'bar',
				html: 'Page CSS' ,
				style: 'button',
				class: 'custom-layout-settings'
			});

			$.bbAddPanel({
				location: 'bar',
				html: 'Quicksave',
				style: 'button',
				class:'fl-builder-quicksave-button'
			});


			$.bbAddPanel({
				location: 'bar',
				html: 'Preview',
				style: 'button',
				class:'bblivepreview'
			});



			// Add the delegates
			$('body').delegate('.bblivepreview', 'click', toggle_livepreview );
			$('body').delegate('.fl-builder-quicksave-button' , 'click' , _Quicksave );
			$('body').delegate('.custom-layout-settings', 'click', FLBuilder._layoutSettingsClicked );

//			$('body').delegate('.custom-layout-settings', 'click', FLBuilder._globalSettingsClicked);




		}
	});


}) ( jQuery );