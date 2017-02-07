<?php
$copy_content = get_theme_mod( 'df_foot_copy' );

do_action( 'wpml_register_single_string', 'Copyright Content', 'Copyright-Footer ', $copy_content );

$footer_text = apply_filters( 'wpml_translate_single_string', $copy_content, 'Copyright Content', 'Copyright-Footer ' );
?>

<div class="siteinfo">

	<?php if ( $footer_text == '' ): ?>

		<p><?php echo sprintf( '%1$s %4$s %3$s %2$s', esc_html__( 'Copyright &copy; ', 'applique' ) . '<span itemprop="copyrightYear">' . date( 'Y' ) . '</span>', get_bloginfo( 'name' ) . '.', esc_html__( 'All Rights Reserved.', 'applique' ), '<span itemprop="copyrightHolder">DAHZ</span>' ); ?></p>

	<?php else : ?>

		<?php echo do_shortcode( $footer_text ); ?>

	<?php endif ?>

</div><!-- end of site info -->
