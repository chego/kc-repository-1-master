<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$foot_logo 		  = get_theme_mod( 'df_foot_logo' );
$foot_logo_height = get_theme_mod( 'df_foot_logo_height', '120' );
$foot_btm_range   = get_theme_mod( 'df_foot_btm_range', '90' );
$foot_bg 		  = get_theme_mod( 'df_foot_bg', '#f7f7f3' );
$foot_txt 		  = get_theme_mod( 'df_foot_txt', '#2e210f' );
$foot_txt_hover   = get_theme_mod( 'df_foot_txt_hvr', '#a9997f' );
$foot_border 	  = get_theme_mod( 'df_foot_border', '#f7f7f3' );
?>

/* Footer Logo Height */
<?php if ( $foot_logo != '' ) : ?>

	.df-foot-logo img {
		height: <?php echo esc_html( $foot_logo_height . 'px' ); ?>;
	}

<?php endif ?>

/* Bottom Range */
.df-footer-bottom {
	padding-bottom: <?php echo esc_html( $foot_btm_range . 'px' ); ?>;
	border-color: <?php echo esc_html( $foot_border ); ?>;
}

/* Footer Background Color */
.df-footer-bottom {
	background: <?php echo esc_html( $foot_bg ); ?>;
}
.df-footer-bottom, .df-footer-bottom a, .df-footer-bottom p {
	color: <?php echo esc_html( $foot_txt ); ?>;
}
.df-footer-bottom a:hover {
	color: <?php echo esc_html( $foot_txt_hover ); ?>;
}
.df-footer-bottom .main-navigation .nav a::after {
    background: <?php echo esc_html( $foot_txt_hover ); ?>;
}