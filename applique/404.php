<?php get_header(); ?>

	<div id="content-wrap">

		<div class="container main-sidebar-container">

			<div class="row">

				<div class="wrapper-404 col-md-8 col-md-push-2 aligncenter">

					<h1 class="entry-title display-2">
						<?php echo wp_kses( __( 'We\'re Sorry. <br /> This Page Cannot Be Found', 'applique' ), array( 'br' => array() ) ); ?>
					</h1>

					<p class="content-404">
						<?php esc_html_e( 'The page you are looking for is not here. It may have been deleted, or the address might have been miss-typed. You can use the navigation bar above, or&#58;', 'applique' ); ?>
					</p>

					<?php echo sprintf( '<a href="%1$s" class="button outline">%2$s</a>', esc_url( home_url( '/' ) ), esc_html__( 'Go Back To Homepage', 'applique' ) ); ?>

				</div>

			</div>

		</div>

		<?php echo df_social_account(); ?>
		<?php echo df_miscellaneous();	?>

	</div>

<?php get_footer(); ?>