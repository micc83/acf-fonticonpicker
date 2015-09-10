(function($){
	if( typeof acf.add_action !== 'undefined' ) {
		acf.add_action('ready append', function( $el ){
			// Let's iconpick!!!
			$('.acf-iconpicker').fontIconPicker();
		});	
	} else {
		// ACF4
		$(document).on('acf/include_fields', function(e, postbox){
			$(postbox).find('.acf-iconpicker').each(function(){
				// The check is made so repeaters wont trigger the script before time
				if ( !$(this).parents('.row-clone').length ){
					// Let's iconpick!!!
					$(this).fontIconPicker();	
				}	
			});	
		});
	}
})(jQuery);