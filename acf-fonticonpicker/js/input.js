(function($){
    function enableFontIconPickerFor($el) {
        $el.find('.acf-iconpicker').each(function(){
            if ( !$(this).parents('.acf-clone').length ){
                // Let's iconpick!!!
                $(this).fontIconPicker();   
            }
        });
    }
    if( typeof acf.add_action !== 'undefined' ) {
        // ACF5
        acf.add_action('ready append', function( $el ){
            enableFontIconPickerFor($el);
        }); 
    } else {
        // ACF4
        $(document).on('acf/include_fields', function(e, postbox){
            enableFontIconPickerFor($(postbox));
        });
    }
})(jQuery);
