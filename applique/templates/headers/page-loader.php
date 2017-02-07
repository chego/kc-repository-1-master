<?php
$enable_page_loader = get_theme_mod( 'df_enable_page_loader', 0 );
$page_loader_image  = get_theme_mod( 'df_loader_icon' );
?>

<?php if ( $enable_page_loader == 1 ) : ?>

	<div class="ajax_loader">

		<div class="ajax_loader_1">

			<?php if ( $page_loader_image == '' ) :

				echo df_loading_spinners();

			else : ?>

				<div class="ajax_loader_2">

					<img src="<?php echo esc_url( $page_loader_image ); ?>" alt="Page Loader" />

				</div>

			<?php endif; ?>

		</div>

	</div>

<?php endif; ?>