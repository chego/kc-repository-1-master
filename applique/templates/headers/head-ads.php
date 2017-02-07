<?php if ( get_theme_mod( 'df_ads_head_img' ) != '' || get_theme_mod( 'df_ads_head_embed' ) != '' ) : 

$df_ads_head_embed = get_theme_mod( 'df_ads_head_embed' );
?>

	<div class="df-ads-section border-bottom aligncenter">

		<?php if ( get_theme_mod( 'df_ads_head_embed' ) != '' ) : ?>

			<?php  echo the_widget( 'WP_Widget_Text', array( 'text' => get_theme_mod( 'df_ads_head_embed' ) ) ); ?>

		<?php else : ?>

			<?php echo the_widget( 'WP_Widget_Text', array(
							'text' => '<a href="' . get_theme_mod( 'df_ads_head_url' ) . '" target="_blank">
											<img src="' . get_theme_mod( 'df_ads_head_img' ) . '" alt="DF ADSBanner" />
									   </a>'
					   ) );
			?>

		<?php endif ?>

	</div>

<?php endif ?>