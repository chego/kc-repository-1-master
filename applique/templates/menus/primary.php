<?php
$border = '';

if ( get_theme_mod( 'df_nav_border', 1 ) == 1 ) {

	if ( get_theme_mod( 'df_nav_pos', 'nav_top' ) == 'nav_top' ) {
		$border = 'border-bottom';
	} else {
		$border = 'border-top border-bottom';
	}

} ?>

<?php if ( has_nav_menu( 'primary-menu' ) ) : // Check if there's a menu assigned to the 'primary-menu' location. ?>

	<?php
	/**
	 * `dahz_attr( 'menu' )` are function to print attribute and microdata in main menu element.
	 * This function locate in `libraries/attr.php` under function named `dahz_attr_menu`.
	 */ ?>
	<div <?php dahz_attr( 'menu' ); ?>>

		<div class="nav-wrapper-inner <?php echo esc_attr( $border ); ?>">

			<div class="sticky-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="df-sitename" title="<?php bloginfo( 'blogname' ); ?>" itemprop="headline">

					<img src="<?php echo get_theme_mod( 'df_sticky_logo', get_template_directory_uri() . '/assets/images/round.png' ) ?>" alt="<?php bloginfo( 'blogname' ); ?>">

				</a>
			</div>

			<?php wp_nav_menu( array(
				'theme_location'  => 'primary-menu',
	            'menu_class'      => 'nav aligncenter',
	            'container'       => 'div',
				'container_class' => 'container',
	            'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
	        ) ); ?>

			<div class="sticky-btp">
				<a class="scroll-top"><i class="ion-ios-arrow-thin-up"></i><i class="ion-ios-arrow-thin-up"></i></a>
			</div>

		</div>

	</div>

<?php else: ?>

	<?php if ( current_user_can( 'administrator' ) ) : ?>

		<div class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

			<div class="nav-wrapper-inner <?php echo esc_attr( $border ); ?>">

				<div class="sticky-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="df-sitename" title="<?php bloginfo( 'blogname' ); ?>" itemprop="headline">

						<img src="<?php echo get_theme_mod( 'df_sticky_logo', get_template_directory_uri() . '/assets/images/round.png' ) ?>" alt="<?php bloginfo( 'blogname' ); ?>">

					</a>
				</div>

				<div class="container">

					<ul class="nav aligncenter">

						<li class="menu-item">

						<?php echo sprintf( '<a href="%1$swp-admin/nav-menus.php">%2$s</a>', esc_url( home_url( '/' ) ), esc_html__( 'Setup a Menu', 'applique' ) ); ?>

						</li>

					</ul>

				</div>

				<div class="sticky-btp">
					<a class="scroll-top"><i class="ion-ios-arrow-thin-up"></i><i class="ion-ios-arrow-thin-up"></i></a>
				</div>

			</div>

		</div>

	<?php endif; ?>

<?php endif; ?>