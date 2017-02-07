<?php if ( get_theme_mod( 'df_ads_foot_img' ) != '' || get_theme_mod( 'df_ads_foot_embed' ) != '' ) : ?>

	<div class="df-ads-section border-top">

		<?php if ( get_theme_mod( 'df_ads_foot_embed' ) != '' ) : ?>

			<?php echo the_widget( 'WP_Widget_Text', array( 'text' => get_theme_mod( 'df_ads_foot_embed' ) ) ); ?>

		<?php else : ?>

			<?php echo the_widget( 'WP_Widget_Text', array(
							'text' => '<a href="' . get_theme_mod( 'df_ads_foot_url' ) . '" target="_blank">
											<img src="' . get_theme_mod( 'df_ads_foot_img' ) . '" alt="DF ADSBanner" />
									   </a>'
					   ) );
			?>

		<?php endif ?>

	</div>

<?php endif ?>