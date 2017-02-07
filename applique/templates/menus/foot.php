<?php if ( has_nav_menu( 'footer-menu' ) ) : // Check if there's a menu assigned to the 'footer-menu' location. ?>

	<?php
	/**
	 * `dahz_attr( 'menu' )` are function to print attribute and microdata in main menu element.
	 * This function locate in `libraries/attr.php` under function named `dahz_attr_menu`.
	 */ ?>
	<div <?php dahz_attr( 'menu' ); ?>>

		<?php wp_nav_menu( array(
			'theme_location'  => 'footer-menu',
            'menu_class'      => 'nav aligncenter',
            'container'       => 'div',
			'container_class' => 'container',
            'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
        ) ); ?>

	</div>

<?php else: ?>

	<?php if ( current_user_can( 'administrator' ) ) : ?>

		<div class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

			<ul class="nav aligncenter">

				<li class="menu-item">

				<?php echo sprintf( '<a href="%1$swp-admin/nav-menus.php">%2$s</a>', esc_url( home_url( '/' ) ), esc_html__( 'Setup a Menu', 'applique' ) ); ?>

				</li>

			</ul>

		</div>

	<?php endif; ?>

<?php endif; ?>