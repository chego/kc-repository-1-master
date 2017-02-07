<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$logo 		 = get_theme_mod( 'df_logo', get_template_directory_uri() . '/assets/images/main-logo.png' );
$logo_height = get_theme_mod( 'df_logo_height', '214' );
$above_space = get_theme_mod( 'df_logo_above_range', '120' );
$below_space = get_theme_mod( 'df_logo_below_range', '120' );
$logo_clr 	 = get_theme_mod( 'df_logo_bg_color', '#948d80' );
$logo_border = get_theme_mod( 'df_logo_border', '#565148' );
$logo_img 	 = get_theme_mod( 'df_logo_bg_img', get_template_directory_uri() . '/assets/images/bg-logo.jpg' );
$logo_bg 	 = $logo_img != '' ? 'background-image: url(' . $logo_img . ');' : 'background-color: ' . $logo_clr . ';';
$logo_etc	 = $logo_img != '' ? 'background-repeat: ' . get_theme_mod( 'df_logo_bg_rpt', 'no-repeat' ) . ';' : '';
$logo_etc	.= $logo_img != '' ? 'background-position: ' . get_theme_mod( 'df_logo_bg_pos', 'left' ) . ';' : '';
$logo_etc	.= $logo_img != '' ? 'background-size: ' . get_theme_mod( 'df_logo_bg_size', 'auto' ) . ';' : '';
$logo_etc	.= get_theme_mod( 'df_logo_bg_par', 1 ) == 1 && $logo_img != '' ? 'background-attachment: fixed;' : '';
?>

<?php if ( $logo != '' ) : ?>
	.site-branding img {
		height: <?php echo esc_html( $logo_height . 'px' ); ?>;
	}
<?php endif; ?>

.site-branding {
	padding-top: <?php echo esc_html( $above_space . 'px' ); ?>;
	padding-bottom: <?php echo esc_html( $below_space . 'px' ); ?>;
	border-color: <?php echo esc_html( $logo_border ); ?>;
	<?php echo esc_html( $logo_bg ); ?>
	<?php echo esc_html( $logo_etc ); ?>
}