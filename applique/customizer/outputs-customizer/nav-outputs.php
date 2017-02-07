<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$nav_bg 	 		= get_theme_mod( 'df_nav_bg_color', '#565148' );
$nav_txt 	 		= get_theme_mod( 'df_nav_txt_color', '#FFFFFF' );
$nav_txt_hvr 		= get_theme_mod( 'df_nav_txt_hvr_color', '#d1c9bd' );
$subnav_bg 	 		= get_theme_mod( 'df_subnav_bg_color', '#f5f5f0' );
$subnav_txt 		= get_theme_mod( 'df_subnav_txt_color', '#6b6051' );
$subnav_txt_hvr 	= get_theme_mod( 'df_subnav_txt_hvr_color', '#ffffff' );
$subnav_bg_hvr  	= get_theme_mod( 'df_subnav_bg_hvr_color', '#565148' );
$border 			= get_theme_mod( 'df_nav_border', 0 );
$nav_border_clr 	= get_theme_mod( 'df_nav_border_color', '#565148' );
$sub_border_clr 	= get_theme_mod( 'df_sub_border_color', '#565148' );
$df_nav_text_trans  = get_theme_mod( 'df_nav_text_trans', 'uppercase' );
?>

/* Main Navigation Bar */
#masthead .nav-wrapper-inner, .df-mobile-menu, .df-mobile-menu .inner-wrapper {
	background: <?php echo esc_html( $nav_bg ); ?>;
}
.df-menu-content .content-wrap {
	background: <?php echo esc_html( $nav_bg ); ?>;
	opacity: .95;
}
#masthead .nav > li > a, .df-mobile-menu .col-right a, .df-mobile-menu .nav > li > a, .df-mobile-menu .df-social-connect a, #masthead .sticky-btp .scroll-top i {
	color: <?php echo esc_html( $nav_txt ); ?>;
}
.df-mobile-menu .df-top, .df-mobile-menu .df-middle, .df-mobile-menu .df-bottom{
	border-color: <?php echo esc_html( $nav_txt ); ?>;
}
#masthead .nav > li:hover > a, #masthead .sticky-btp .scroll-top:hover i {
	color: <?php echo esc_html( $nav_txt_hvr ); ?>;
}
.df-header-inner ul.nav .menu-item > a::after {
	background: <?php echo esc_html( $nav_txt_hvr ); ?>;
}
@media only screen and ( max-width: 768px ) {
	.df-mobile-menu .btnshow, .nav .menu-item .sub-menu .menu-item a {
		color: <?php echo esc_html( $nav_txt ); ?>;
	}
}
/* Sub Navigation */
.nav li .sub-menu {
	background: <?php echo esc_html( $subnav_bg ); ?>;
}
.nav .sub-menu > li > a, .df-mobile-menu .nav .sub-menu > li > a {
	color: <?php echo esc_html( $subnav_txt ); ?>;
}
.nav .sub-menu > li:hover > a {
	color: <?php echo esc_html( $subnav_txt_hvr ); ?>;
	background: <?php echo esc_html( $subnav_bg_hvr ); ?>;
}

/* Navigation Border Color */
<?php if ( $border == 1 ) : ?>
	.nav-wrapper-inner.border-bottom,
	.nav-wrapper-inner.border-top {
		border-color: <?php echo esc_html( $nav_border_clr ); ?>;
	}
<?php endif ?>

.nav .menu-item-has-children .sub-menu,
.nav .menu-item .sub-menu .menu-item a {
	border-color: <?php echo esc_html( $sub_border_clr ); ?>;
}

/* Navigation Text Transform */
.nav .menu-item{
	text-transform: <?php echo esc_html( $df_nav_text_trans ); ?>;
}