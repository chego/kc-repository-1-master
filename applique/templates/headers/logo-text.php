<div class="container">

	<?php
	/**
	 * `dahz_attr( 'site-title' )` are function to print attribute and microdata in site title element.
	 * This function locate in `libraries/attr.php` under function named `dahz_attr_site_title`.
	 */ ?>
	<h1 <?php dahz_attr( 'site-title' ); ?>>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="df-sitename display-2" title="<?php bloginfo( 'blogname' ); ?>"><?php bloginfo( 'blogname' ); ?></a>
	</h1>

	<?php
	/**
	 * `dahz_attr( 'site-description' )` are function to print attribute and microdata in site description element.
	 * This function locate in `libraries/attr.php` under function named `dahz_attr_site_description`.
	 */ ?>
	<span <?php dahz_attr( 'site-description' ); ?>>
		<?php bloginfo( 'description' ); ?>
	</span>

</div>