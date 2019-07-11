jQuery(document).ready(function( $ ) {

	// Icon picker function
	function wplookIconPicker( parentClass, inputClass ) {

		// Check for events here using event delagation
		// More info here: http://stackoverflow.com/a/5540632

		$( '#customize-controls, .icon-picker-parent' ).on( 'click', '.icon-picker .item', function() {

			// Copy value over to the input box
			$( this ).parents( parentClass ).find( inputClass ).val( $( this ).data( 'code' ) );

			// Manually trigger change event to get Customizer to 'see' it
			$( this ).parents( parentClass ).find( inputClass ).trigger( 'change' );

			// Set the class of the clicked item to selected
			$( this ).siblings().removeClass( 'selected' );
			$( this ).addClass( 'selected' );

		} );

		// Scroll to .selected on load
		// NOTE: Not currently working in Customizer
		$( '.icon-picker' ).each( function() {

			if( $( this ).find( '.item.selected' ).length > 0 ) {
				var selectedTop = $( this ).find( '.item.selected' )[0].getBoundingClientRect().top;
				var listTop = $( this )[0].getBoundingClientRect().top;

				$( this ).find( '.icon-list' ).scrollTop( selectedTop - listTop );
			}

		} );

		// Remove .selected from icons if field is manually changed
		var inputValue;

		$( '#customize-controls, .icon-picker-parent' ).on( 'keydown', parentClass + ' ' + inputClass, function() {

			inputValue = $( this ).val();

		} );

		$( '#customize-controls, .icon-picker-parent' ).on( 'keyup', parentClass + ' ' + inputClass, function() {

			if( $( this ).val() != inputValue ) {
				$( this ).parents( parentClass ).find( '.icon-picker .item' ).removeClass( 'selected' );
			}

		} );

		// Show more icons button
		$( '#customize-controls, .icon-picker-parent' ).on( 'click', '.icon-picker .show-more-button', function() {

			$( this ).parents( '.show-more' ).siblings( '.icon-list' ).css( 'height', 'auto' );
			$( this ).parents( '.show-more' ).css( 'display', 'none' );

		} );

		// Reduce the opacity of the .show-more gradient as the user nears the end of the list
		// Due to this http://stackoverflow.com/a/30476388 we've got to use pure JS methods...
		document.addEventListener( 'scroll', function (event) {

			if( $( event.target ).hasClass( 'icon-list' ) ) {

				var totalHeight = $( event.target )[0].scrollHeight;
				var scrollBottom = $( event.target ).scrollTop() + $( event.target ).innerHeight();
				var actualHeight = ( totalHeight - scrollBottom > 0 ? totalHeight - scrollBottom : 0 );

				if( actualHeight <= 300 ) {
					$( event.target ).parents( '.icon-picker' ).find( '.show-more .background' ).css( 'opacity', actualHeight / 300 );
				} else {
					if( $( event.target ).parents( '.icon-picker' ).find( '.show-more .background' ).css( 'opacity' ) < 1 ) {
						$( event.target ).parents( '.icon-picker' ).find( '.show-more .background' ).css( 'opacity', 1 );
					}
				}

			}

		}, true );

	}

	// Run icon picker JS
	if( $( '.icon-picker' ).length > 0 ) {
		wplookIconPicker( '.icon-picker-parent', 'input.icon-picker-input' );
	}

	// Object containing new WPlook Admin functions
	var wplookAdmin = {

		// Object for interacting with custom media picker instances
		// Based on: https://www.gavick.com/blog/use-wordpress-media-manager-plugintheme
		mediaPicker: {

			// Define variables used in the below functions
			input: false,
			button: false,
			image: false,

			// Construct media picker - create it, close it, set values etc.
			construct: function( functionInput, functionButton, functionImage ) {
				input = $( functionInput );
				button = $( functionButton );
				image = $( functionImage );

				// Check if media picker instance already exists
				if( wp.media.frames.wplookMediaPicker ) {
					wp.media.frames.wplookMediaPicker.open();
					return;
				}

				// Configure media picker instance
				wp.media.frames.wplookMediaPicker = wp.media({
					title: wplookAjaxParams.selectImage,
					multiple: false,
					library: {
						type: 'image'
					},
					button: {
						text: wplookAjaxParams.useSelectedImage
					}
				});

				// Closing event for media manger
				wp.media.frames.wplookMediaPicker.on( 'close', wplookAdmin.mediaPicker.set_selection_to_input );
				// Image selection event
				wp.media.frames.wplookMediaPicker.on( 'select', wplookAdmin.mediaPicker.set_selection_to_input );
				// Showing media manager
				wp.media.frames.wplookMediaPicker.open();
			},

			// Set picker selection URL as input value, as defined above
			set_selection_to_input: function() {

				var selection = wp.media.frames.wplookMediaPicker.state().get( 'selection' );

				if ( !selection ) {
					return;
				}

				selection.each( function(attachment) {
					// Set input to the URL of the selected image
					var url = attachment.attributes.url;
					input.val( url );

					// Show the image on the page
					image.attr( 'src', url );
				} );

				// Trigger 'change' on the input box so that Customizer updates the page
				input.trigger( 'change' );

			}

		}

	};

	// Run media picker JS
	$( '#customize-theme-controls, .widget-liquid-right' ).on( 'click', '.media-picker-button', function( event ) {
		var button = $( this );
		var input = button.siblings( 'input' );
		var image = button.siblings( 'img' );

		wplookAdmin.mediaPicker.construct( input, button, image );
	});

});
