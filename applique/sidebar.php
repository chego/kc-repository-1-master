<?php
/**
 * `dahz_attr( 'sidebar' )` are function to print attribute and microdata in sidebar element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_sidebar`.
 */ ?>
<?php

if ( get_theme_mod( 'disable_floating_sidebar', 1 ) != 1 ) :
	wp_enqueue_script( 'stickySidebar' );
endif;

?>

<?php if ( is_singular() ) : ?>

	<?php if ( class_exists('WooCommerce') && is_product() ) : ?>

		<?php if ( get_theme_mod( 'df_disable_woocommerce_single_sidebar', 0 ) == 0 ) : ?>

			<div <?php dahz_attr( 'sidebar' ); ?>>

				<div class="sticky-sidebar">

					<?php dynamic_sidebar( 'shop' ); ?>

				</div>

			</div>

		<?php endif; ?>

	<?php else: ?>

		<?php if ( get_theme_mod( 'disable_sidebar_singular', 0 ) == 0 ) : ?>

			<?php if ( !class_exists('WooCommerce') ) : ?>

					<div <?php dahz_attr( 'sidebar' ); ?>>

						<div class="sticky-sidebar">

							<?php dynamic_sidebar( 'primary' ); ?>

						</div>

					</div>
			
			<?php elseif ( class_exists('WooCommerce') && ( !is_cart() && !is_account_page() && !is_checkout() ) ) :?>

					<div <?php dahz_attr( 'sidebar' ); ?>>

						<div class="sticky-sidebar">

							<?php dynamic_sidebar( 'primary' ); ?>

						</div>

					</div>

			<?php endif; ?>

		<?php endif; ?>

	<?php endif; ?>

<?php elseif ( is_archive() || is_search() ) : ?>

	<?php if ( class_exists('WooCommerce') && ( is_shop() || is_product_category() || is_product_category() ) ) : ?>

		<?php if ( get_theme_mod( 'df_disable_woocommerce_sidebar', 0 ) == 0 ) : ?>

			<div <?php dahz_attr( 'sidebar' ); ?>>

				<div class="sticky-sidebar">

					<?php dynamic_sidebar( 'shop' ); ?>

				</div>

			</div>

		<?php endif; ?>
	
	<?php else :?>

		<?php if ( get_theme_mod( 'disable_sidebar_archive', 1 ) == 0 ) : ?>
			
				<div <?php dahz_attr( 'sidebar' ); ?>>

					<div class="sticky-sidebar">

						<?php dynamic_sidebar( 'primary' ); ?>

					</div>

				</div>

		<?php endif; ?>

	<?php endif; ?>

<?php elseif ( is_home() || is_front_page() ) : ?>

	<?php if ( get_theme_mod( 'disable_sidebar_blog', 1 ) == 0 ) : ?>

		<div <?php dahz_attr( 'sidebar' ); ?>>

			<div class="sticky-sidebar">

				<?php dynamic_sidebar( 'primary' ); ?>

			</div>

		</div>

	<?php endif; ?>

<?php else : ?>

	<div <?php dahz_attr( 'sidebar' ); ?>>

		<div class="sticky-sidebar">

			<?php dynamic_sidebar( 'primary' ); ?>

		</div>

	</div>

<?php endif; ?>