/**
 * Table of Content
 *
 *  1. Affiliate Metabox show/hide
 *  2. Import customizer button switcher
 */

jQuery( document ).ready( function( $ ) {

    /**
     * 1. Affiliate Metabox show/hide
     */
	if ( $( '[name="page_template"]' ).val() == 'template-archive.php' ) {
		$( '#df_metaboxed_affiliate' ).addClass( 'hide-if-js' );
		$( '#df_metaboxed_cstm_archive' ).removeClass( 'hide-if-js' );
    } else {
		$( '#df_metaboxed_cstm_archive' ).addClass( 'hide-if-js' );
		$( '#df_metaboxed_affiliate' ).removeClass( 'hide-if-js' );
    }

    $( '[name="page_template"]' ).change(function() {
        if ( $(this).val() == 'template-archive.php' ) {
			$( '#df_metaboxed_affiliate' ).addClass( 'hide-if-js' );
			$( '#df_metaboxed_cstm_archive' ).removeClass( 'hide-if-js' );
        } else {
			$( '#df_metaboxed_cstm_archive' ).addClass( 'hide-if-js' );
			$( '#df_metaboxed_affiliate' ).removeClass( 'hide-if-js' );
        }
    });

    /**
     * 2. Import customizer button switcher
     */
    $( '#customizer-upload' ).change( function() {
        $( '#customizer-submit' ).removeAttr( 'disabled' );
    });

    /**
     * 3. Customizer skin changer
     */
     var skin = $('#customize-control-df_skin select');
     var blogLay = $('#customize-control-df_blog_layout input[value="standard"]');
     var archLay = $('#customize-control-df_arch_layout input[value="standard"]');

     var colorOptions1 = $('#customize-control-df_body_background_color');
     var colorOptions2 = $('#customize-control-df_body_content_color');
     var colorOptions3 = $('#customize-control-df_border_content_accent_color');

     if ( skin.val() == 'df-skin-light' || skin.val() == 'df-skin-bold' ) {
        colorOptions1.css('display', 'none');
        colorOptions2.css('display', 'none');
        colorOptions3.css('display', 'none');
     } else {
        colorOptions1.css('display', 'block');
        colorOptions2.css('display', 'block');
        colorOptions3.css('display', 'block');
     }

     skin.change(function() {
         if ( skin.val() == 'df-skin-light' || skin.val() == 'df-skin-bold' ) {
            colorOptions1.css('display', 'none');
            colorOptions2.css('display', 'none');
            colorOptions3.css('display', 'none');
         } else {
            colorOptions1.css('display', 'block');
            colorOptions2.css('display', 'block');
            colorOptions3.css('display', 'block');
         }
     });

});