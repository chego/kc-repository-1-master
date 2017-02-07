<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$df_featured_txt_style	= get_theme_mod( 'df_featured_txt_style', 'normal' );
$df_featured_txt_trans	= get_theme_mod( 'df_featured_txt_trans', 'italic' );

?>

/* Featured H1 Typography */
.featured-area h1{
	font-style: <?php echo esc_html( $df_featured_txt_style ); ?>;
	text-transform: <?php echo esc_html( $df_featured_txt_trans ); ?>;
}