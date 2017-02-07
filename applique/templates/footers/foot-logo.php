<?php if ( get_theme_mod( 'df_foot_logo', get_template_directory_uri() . '/assets/images/footer-logos.png' ) != '' ) : ?>

	<div class="df-foot-logo">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="df-sitename" title="<?php bloginfo( 'blogname' ); ?>">
			<img src="<?php echo esc_url( get_theme_mod( 'df_foot_logo', get_template_directory_uri() . '/assets/images/footer-logo.png' ) ) ?>" alt="<?php bloginfo( 'name' ); ?>">
		</a>

	</div>

<?php endif; ?>