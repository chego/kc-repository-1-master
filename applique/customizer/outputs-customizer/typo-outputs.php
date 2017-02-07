<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$heading_font_type   = get_theme_mod( 'df_heading_txt_type', 'Prata' );
$heading_font_weight = get_theme_mod( 'df_heading_txt_weight', '400' );
$body_font_type      = get_theme_mod( 'df_body_txt_type', 'Crimson Text' );
$body_font_weight    = get_theme_mod( 'df_body_txt_weight', '400' );
$nav_font_type       = get_theme_mod( 'df_nav_txt_type', 'Montserrat' );
$nav_font_weight     = get_theme_mod( 'df_nav_txt_weight', '400' );
$meta_font_type      = get_theme_mod( 'df_meta_txt_type', 'Montserrat' );
$meta_font_weight    = get_theme_mod( 'df_meta_txt_weight', '400' );
$btn_font_type       = get_theme_mod( 'df_btn_txt_type', 'Lato' );
$btn_font_weight     = get_theme_mod( 'df_btn_txt_weight', '400' );
?>

/* Heading Font */
h1, h2, h3, h4, h5, h6, .widget h4, .display-1, .display-2, .display-3, .display-4, blockquote, .dropcap:first-letter, .df-floating-search-form .label-text {
	font-family: <?php echo esc_html( $heading_font_type ); ?>, Georgia, Times, serif;
	font-weight: <?php echo esc_html( $heading_font_weight ); ?>;
}
body {
	font-family: <?php echo esc_html( $body_font_type ); ?>, Georgia, Times, serif;
	font-weight: <?php echo esc_html( $body_font_weight ); ?>;
}
.main-navigation {
	font-family: <?php echo esc_html( $nav_font_type ); ?>, Georgia, Times, serif;
	font-weight: <?php echo esc_html( $nav_font_weight ); ?>;
}
.df-post-on, .df-single-category, .df-postmeta span,
.df-page-subtitle, .df-header span, .featured-area,
.post_tag a, .widget_calendar caption, .widget_calendar tfoot a,
.widget_recent_entries .post-date, .df_separator a.link,
.df-social-connect .social-text, .site-footer .df-misc-section .df-misc-text, .related-post-content .entry-terms a,
.df-banner-widget span, .df-misc-section {
	font-family: <?php echo esc_html( $meta_font_type ); ?>, Georgia, Times, serif;
	font-weight: <?php echo esc_html( $meta_font_weight ); ?>;
}
.df-pagination, .button, button, input[type="submit"], input[type="reset"], input[type="button"],
.widget_tag_cloud a, .woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale,
.woocommerce-cart table.cart td.actions .coupon .input-text {
	font-family: <?php echo esc_html( $btn_font_type ); ?>, Georgia, Times, serif;
	font-weight: <?php echo esc_html( $btn_font_weight ); ?>;
}