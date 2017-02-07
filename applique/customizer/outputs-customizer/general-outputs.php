<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$df_framed = get_theme_mod( 'df_framed', 1 );
$df_color  = get_theme_mod( 'df_framed_color', '#dad4ca' );
?>

<?php if ( $df_framed == 1 ) : ?>
	@media only screen and ( min-width: 1024px ) {
		.df-wrapper {
			border: 15px solid;
			border-color: <?php echo esc_html( $df_color ); ?>;
		}
		.df-sticky-admin, .df-sticky {
			width: auto;
			left: 15px;
			right: 15px;
		}
		#content-wrap .df-social-connect a {
			padding-left: 15px;
		}
		.df-social-connect.scrolled {
			left: 15px !important;
		}
		.df-misc-section.scrolled {
			right: 25px !important;
		}
		#content-wrap .df-misc-section a {
			right: -65px;
		}
	}
<?php endif; ?>