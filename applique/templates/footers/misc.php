<?php /* Floating Search */ ?>
<div class="df-floating-search">
	<div class="search-container-close"></div>
	<div class="container df-floating-search-form">
		<form class="df-floating-search-form-wrap col-md-8 col-md-push-2" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="label-text">
				<input type="search" class="df-floating-search-form-input" placeholder="<?php esc_attr_e( 'What are you looking for', 'applique' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'applique' ); ?>">
			</label>
			<div class="df-floating-search-close"><i class="ion-ios-close-empty"></i></div>
		</form>
	</div>
</div>

<?php /* Floating Subscription */ ?>

<?php if ( get_theme_mod( 'df_subscription', '[mc4wp_form id=&quot;65&quot;]' ) != '' ) : ?>
	<div class="df-floating-subscription">

		<div class="container-close"></div>

		<div class="container">

			<div class="row">

				<div class="wrapper col-md-8 col-md-push-2">

					<div class="row flex-box">

						<?php if ( get_theme_mod( 'df_subs_img', get_template_directory_uri() . '/assets/images/subscribe.jpg' ) != '' ) : ?>
							<div class="col-left col-md-5">
								<div class="wrap">
									<img src="<?php echo esc_url( get_theme_mod( 'df_subs_img', get_template_directory_uri() . '/assets/images/subscribe.jpg' ) ); ?>" alt="" />
								</div>
							</div>
						<?php endif; ?>

						<div class="col-right col-md-7">
							<div class="wrap">
								<?php echo do_shortcode( get_theme_mod( 'df_subscription', '[mc4wp_form id=&quot;65&quot;]' ) ); ?>
							</div>
						</div>

					</div>

					<div class="df-floating-close"><i class="ion-ios-close-empty"></i></div>

				</div>

			</div>

		</div>

	</div>
<?php endif; ?>