/**
 * Table of Content
 *
 * 	  1. Logo background color
 * 	  2. Logo border color
 * 	  3. Navigation background color
 * 	  4. Navigation text color
 * 	  5. Navigation text hover color
 * 	  6. Navigation border color
 * 	  7. Sub navigation background color
 * 	  8. Sub navigation text color
 * 	  9. Sub navigation text hover color
 * 	  10. Sub navigation background hover color
 * 	  11. Sub navigation border color
 * 	  12. Footer background color
 * 	  13. Footer text color
 * 	  14. Footer text hover color
 * 	  15. Footer border color
 * 	  16. Button Fill Color
 * 	  17. Button Fill Hover Color
 *    18. Button Fill Font Color
 * 	  19. Button Outline Border Color
 * 	  20. Button Outline Font Color
 * 	  21. Button Outline Hover Color
 * 	  22. Button Outline Font Color Hover
 * 	  23. Accent Color
 * 	  24. Header Color
 * 	  25. Body Font Color
 * 	  26. Meta Font Color
 * 	  27. Border Color
 * 	  28. Widget Header Color
 *	  29. Body Background Color
 *    30. Content Background Color
 */

jQuery( document ).ready( function( $ ) {

	var api = wp.customize;

	/* 1. Logo background color. */
	api( 'df_logo_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding' ).css( 'background-color', to );
		} );
	} );

	/* 2. Logo border color. */
	api( 'df_logo_border', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding' ).css( 'border-color', to );
		} );
	} );

	/* 3. Navigation background color. */
	api( 'df_nav_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '#masthead .nav-wrapper-inner' ).css( 'background', to );
		} );
	} );

	/* 4. Navigation text color. */
	api( 'df_nav_txt_color', function( value ) {
		value.bind( function( to ) {
			$( '#masthead .nav > li > a, .df-mobile-menu .col-right a, .df-mobile-menu .nav > li > a, .df-mobile-menu .df-social-connect a, #masthead .sticky-btp .scroll-top i' ).css( 'color', to );
		} );
	} );

	/* 5. Navigation text hover color. */
	api( 'df_nav_txt_hvr_color', function( value ) {
		value.bind( function( to ) {
			$( '#masthead .nav > li:hover > a' ).css( 'color', to );
		} );
	} );

	/* 6. Navigation border color. */
	api( 'df_nav_border_color', function( value ) {
		value.bind( function( to ) {
			$( '.nav-wrapper-inner.border-bottom, .nav-wrapper-inner.border-top' ).css( 'border-color', to );
		} );
	} );

	/* 7. Sub navigation background color. */
	api( 'df_subnav_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.nav .menu-item-has-children .sub-menu' ).css( 'background', to );
		} );
	} );

	/* 8. Sub navigation text color. */
	api( 'df_subnav_txt_color', function( value ) {
		value.bind( function( to ) {
			$( '.nav .menu-item-has-children .sub-menu, .nav .menu-item .sub-menu .menu-item a' ).css( 'color', to );
		} );
	} );

	/* 9. Sub navigation text hover color. */
	api( 'df_subnav_txt_hvr_color', function( value ) {
		value.bind( function( to ) {
			$( '.nav .sub-menu > li' ).hover( function() {
				$( this ).children( 'a' ).css( 'color', to );
			},
			function() {
				$( this ).children( 'a' ).css( 'color', 'inherit' );
			}
			);
		} );
	} );

	/* 10. Sub navigation background hover color. */
	api( 'df_subnav_bg_hvr_color', function( value ) {
		value.bind( function( to ) {
			$( '.nav .sub-menu > li' ).hover( function() {
				$( this ).children( 'a' ).css( 'background', to );
			},
			function() {
				$( this ).children( 'a' ).css( 'background', 'inherit' );
			}
			);
		} );
	} );

	/* 11. Sub navigation border color. */
	api( 'df_sub_border_color', function( value ) {
		value.bind( function( to ) {
			$( '.nav .menu-item-has-children .sub-menu, .nav .menu-item .sub-menu .menu-item a' ).css( 'border-color', to );
		} );
	} );

	/* 12. Footer background color. */
	api( 'df_foot_bg', function( value ) {
		value.bind( function( to ) {
			$( '.df-footer-bottom' ).css( 'background', to );
		} );
	} );

	/* 13. Footer text color. */
	api( 'df_foot_txt', function( value ) {
		value.bind( function( to ) {
			$( '.df-footer-bottom, .df-footer-bottom a' ).css( 'color', to );
		} );
	} );

	/* 14. Footer text hover color. */
	api( 'df_foot_txt_hvr', function( value ) {
		value.bind( function( to ) {
			$( '.df-footer-bottom a:hover' ).css( 'color', to );
		} );
	} );

	/* 15. Footer border color. */
	api( 'df_foot_border', function( value ) {
		value.bind( function( to ) {
			$( '.df-footer-bottom' ).css( 'border-color', to );
		} );
	} );

	/* 16. Button Fill Color */
	api( 'df_button_fill_color', function( value ) {
		value.bind( function( to ) {
			$( '.button, input[type="submit"], input[type="reset"], input[type="button"]' ).css({
				'background': to,
				'border': to
			});
		});
	} );

	/* 17. Button Fill Hover Color */
	api( 'df_button_fill_hover_color', function( value ){
		value.bind( function( to ) {
			$( '.button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover' ).css({
				'background': to,
				'border': to
			});
		});
	} );

	/* 18. Button Fill Font Color */
	api( 'df_button_fill_font_color', function( value ){
		value.bind( function( to ) {
			$( '.button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover' ).css( 'color', to);
		});
	} );

	/* 19. Button Outline Border Color */
	api( 'df_button_outline_border_color', function( value ){
		value.bind( function( to ) {
			$( '.button.outline, button.outline, input[type="submit"].outline, input[type="reset"].outline, input[type="button"].outline, .df-pagenav div > a, .df-page-numbers ul > li > .page-numbers, .df-page-numbers ul > li > .page-numbers.dots, .df-page-numbers ul > li > .page-numbers.dots:hover, .df-page-numbers ul > li > .page-numbers.dots:focus, .widget_tag_cloud a,  .single .post_tag a' ).css('border-color', to);
		});
	} );

	/* 20. Button Outline Font Color */
	api( 'df_button_outline_font_color', function( value ){
		value.bind( function( to ) {
			$( '.button.outline, button.outline, input[type="submit"].outline, input[type="reset"].outline, input[type="button"].outline, .df-pagenav div > a, .df-page-numbers ul > li > .page-numbers, .df-page-numbers ul > li > .page-numbers.dots, .df-page-numbers ul > li > .page-numbers.dots:hover, .df-page-numbers ul > li > .page-numbers.dots:focus, .widget_tag_cloud a,  .single .post_tag a' ).css('color', to);
		});
	} );

	/* 21. Button Outline Hover Color */
	api( 'df_button_outline_hover_color', function( value ){
		value.bind( function( to ) {
			$( '.button.outline:hover, button.outline:hover, input[type="submit"].outline:hover, input[type="reset"].outline:hover, input[type="button"].outline:hover, .df-pagenav div > a:hover, .df-pagenav div > a:focus, .df-page-numbers ul > li > .page-numbers.current, .df-page-numbers ul > li > .page-numbers.current:hover, .df-page-numbers ul > li > .page-numbers.current:focus, .df-page-numbers ul > li > .page-numbers:hover, .df-page-numbers ul > li > .page-numbers:focus, .widget_tag_cloud a:hover, .single .post_tag a:hover' ).css({
				'background': to,
				'border-color': to
			});
		});
	} );

	/* 22. Button Outline Font Color Hover */
	api( 'df_button_outline_hover_font_color', function( value ){
		value.bind( function( to ) {
			$( '.button.outline:hover, button.outline:hover, input[type="submit"].outline:hover, input[type="reset"].outline:hover, input[type="button"].outline:hover, .df-pagenav div > a:hover, .df-pagenav div > a:focus, .df-page-numbers ul > li > .page-numbers.current, .df-page-numbers ul > li > .page-numbers.current:hover, .df-page-numbers ul > li > .page-numbers.current:focus, .df-page-numbers ul > li > .page-numbers:hover, .df-page-numbers ul > li > .page-numbers:focus, .widget_tag_cloud a:hover, .single .post_tag a:hover' ).css('color', to);
		});
	} );

	/* 23. Accent Color */
	api( 'df_accent_color', function( value ){
		value.bind( function( to ) {
			$('.entry-content a, .df-single-category a, .df-post-on a, .df-postmeta .comment-permalink, .author-content .author-social a, .df-pagination.df-single-paging .text-content a .more-article, .related-post-content .entry-terms a, .comment-head .reply a, .comment-head .edit a, .comments-area a, .logged-in-as a, .widget_categories li a, .widget td a, .widget .related-post-content .entry-terms a, .widget_archive a, .widget_meta li a, .widget_pages li a, .widget_recent_comments .recentcomments a, .widget_zilla_likes_widget li a, .widget_rss a, .widget_nav_menu li a').css('color', to);
		});
	} );

	/* 24. Header Color */
	api( 'df_heading_color', function( value ){
		value.bind( function( to ) {
			$('h1, h2, h3, h4, h5, h6, blockquote, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .df-related-post .related-post-title, .df-related-post .related-title, .comment-reply-title, .widget_recent_entries li a').css('color', to);
		});
	} );

	/* 25. Body Font Color */
	api( 'df_body_font_color', function( value ){
		value.bind( function( to ) {
			$('p, table, li, dl, address, label').css('color', to);
		});
	} );

	/* 26. Meta Font Color */
	api( 'df_meta_font_color', function( value ){
		value.bind( function( to ) {
			$('.df-header-title:not(.df-add_image) .df-header span, .df-postmeta .df-share, .df-post-meta, .df-page-subtitle, .df-social-connect a, .df-misc-section a, .like-btn a, .df-share li a, .df-single-paging .prev-article, .df-comments-meta, .comment-head .comment-published, .widget.quote-widget strong, .widget.widget_recent_entries .post-date, .widget_zilla_likes_widget .zilla-likes-count, .widget_rss .rss-date, .recent-big-widget .df-post-on').css('color', to);
		});
	} );

	/* 27. Border Color */
	api( 'df_border_accent_color', function( value ){
		value.bind( function( to ) {
			$('.df-postmeta, .widget h4, .recent-big-widget .separator,
.df-skin-light .widget > h4:before, .df-skin-light .df-sidebar .widget h4:before, .df-skin-light .sticky-sidebar,
.df-skin-light .widget li, .df-skin-boxed .type-post.df-list .df-inner-posts, .df-skin-boxed .type-page.df-list .df-inner-posts, .df-skin-boxed .type-post .grid-wrapper, .df-skin-boxed .type-page .grid-wrapper, .df-skin-boxed .type-post:not(.df-standard):not(.df-list) .df-postmeta-wrapper, .df-skin-boxed .type-page.df-list, .df-skin-boxed .type-post.df-list, .df-skin-boxed .df-sidebar .widget:not(.banner-widget):not(.category-widget):not(.recent-big-widget),
.df-skin-boxed .type-post, .df-skin-boxed .type-page,
.df-pagenav div > a, .df-skin-boxed .type-post.df-standard .df-postmeta-wrapper, .df-skin-boxed .type-page.df-standard .df-postmeta-wrapper,
.df-skin-boxed .type-post.df-standard .entry-content, .df-skin-boxed .type-page.df-standard .entry-content, .df-skin-boxed .type-post.df-standard:not(.sticky) .df-post-title,
.df-skin-boxed .type-page .grid-wrapper, .df-skin-boxed .type-page[class*="col-md-"] .df-postmeta-wrapper,
.df-skin-boxed .type-post.df-standard .df-affiliate, .df-skin-boxed .type-page.df-standard .df-affiliate,
.df-skin-boxed .df-sidebar .recent-big-widget .ver2,
.df-skin-boxed .type-page:not(.df-standard):not(.df-list) .df-postmeta-wrapper, .df-skin-boxed .df-inner-posts').css('border-color', to);
		});
	} );

	api( 'df_border_accent_color', function( value ){
		value.bind( function( to ) {
			$('svg').css('stroke', to);
		});
	} );

	/* 28. Widget Header Color */
	api( 'df_widget_heading_color', function( value ){
		value.bind( function( to ) {
			$('.widget h4, .recent-big-widget h3').css('color', to);
		});
	} );

	/* 29. Body Background Color */
	api( 'df_body_background_color', function( value ){
		value.bind( function( to ) {
			$('.df-wrapper').css('background-color', to);
		});
	} );

	/* 30. Content Background Color */
	api( 'df_body_content_color', function( value ){
		value.bind( function( to ) {
			$('.df-sidebar .widget:not(.banner-widget):not(.category-widget):not(.recent-big-widget),
.blog-widget-area-wrap .widget:not(.banner-widget):not(.category-widget):not(.recent-big-widget),
.grid-wrapper, .df-postmeta-wrapper, .df-skin-boxed .type-post.df-list .df-inner-posts, .df-affiliate .df-affiliate-title span, .single .df-content,
.page .df-content, .search .grid-wrapper, .search .df-postmeta-wrapper, .df-skin-boxed .type-post .df-post-title .boxed-wrap,
.df-skin-boxed .type-page .df-post-title .boxed-wrap, .df-skin-boxed .type-post.df-standard .df-affiliate,
.df-skin-boxed .type-page.df-standard .df-affiliate, body:not(.single) .sticky .sticky-content,
.df-skin-boxed .front-content .widget:not(.banner-widget):not(.category-widget):not(.recent-big-widget),
.df-skin-boxed .front-content .recent-big-widget .ver2 li, .df-skin-boxed .type-post.df-standard .entry-content, .df-skin-boxed .type-page.df-standard .entry-content,
.df-skin-boxed .df-sidebar .recent-big-widget .ver2').css('background-color', to);
		});
	} );

	/* 29. Body Background Color */
	api( 'df_border_content_accent_color', function( value ){
		value.bind( function( to ) {
			$('.df-skin-boxed .grid-outer').css('border-color', to);
		});
	} );

} );