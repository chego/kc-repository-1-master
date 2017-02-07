<?php
$audio    = get_post_meta( get_the_ID(), '_format_audio_embed', true );
$video    = get_post_meta( get_the_ID(), '_format_video_embed', true );
$gallery  = get_post_meta( get_the_ID(), '_format_gallery_images', true );

/**
 * `dahz_attr( 'post' )` are function to print attribute and microdata in article element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_post`.
 */ ?>
<div <?php dahz_attr( 'post' ); ?> >

	<div class="df-post-wrapper">

		<div class="clear"></div>

		<?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>

			<?php if ( get_post_format() == 'audio' && $audio != '' ) : ?>

				<div class="featured-media">
					<?php if ( wp_oembed_get( $audio ) ) : ?>
						<?php echo wp_oembed_get( $audio ); ?>
					<?php else : ?>
						<?php printf( $audio ); ?>
					<?php endif; ?>
				</div>

			<?php elseif ( get_post_format() == 'video' && $video != '' ) : ?>

				<div class="featured-media">
					<?php if ( wp_oembed_get( $video ) ) : ?>
						<?php echo wp_oembed_get( $video ); ?>
					<?php else : ?>
						<?php printf( $video ); ?>
					<?php endif; ?>
				</div>

			<?php elseif ( get_post_format() == 'gallery' && $gallery != '' ) : ?>

				<?php wp_enqueue_script( 'OwlCarousel' ); ?>

				<?php if( $gallery ) : ?>
					<div class="featured-media">
						<div class="df-carousel">
							<?php foreach ( $gallery as $gal ) : ?>

								<?php $the_image   = wp_get_attachment_image_src( $gal, 'full' ); ?>
								<?php $the_caption = get_post_field( 'post_excerpt', $gal ); ?>
								<div class="gal-items">
									<img src="<?php echo esc_url( $the_image[0] ); ?>" <?php if ( $the_caption ) : ?>title="<?php echo esc_attr( $the_caption ); ?>"<?php endif; ?> />
								</div>

							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

			<?php else : ?>

				<?php do_action( 'df_featured_media' ); ?>

			<?php endif; ?>

			<?php
			/**
			 * `dahz_attr( 'entry-content' )` are function to print attribute and microdata in post content.
			 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_content`.
			 */ ?>
			<div <?php dahz_attr( 'entry-content' ); ?>>
				
				<?php echo df_sponsored_textarea(); ?>

				<?php the_content(); ?>

				<?php wp_link_pages(); ?>

			</div>

			<div class="clear"></div>

			<?php echo df_affiliate(); ?>

			<?php echo df_blog_tags(); ?>

		<?php else : // If not viewing a single post. ?>

			<?php do_action( 'df_featured_media' ); ?>

			<?php if ( !is_singular() && get_theme_mod( 'df_skin', 'df-skin-boxed' ) ) : ?>
				<div class="grid-outer">
			<?php endif; ?>

			<div class="grid-wrapper">

				<?php echo df_title_post(); ?>

				<?php
				/**
				 * `dahz_attr( 'entry-summary' )` are function to print attribute and microdata in post summary.
				 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_summary`.
				 */ ?>
				<div <?php dahz_attr( 'entry-summary' ); ?>>

					<?php echo df_summary_type(); ?>

				</div>

			</div>

		<?php endif; // End single post check. ?>

		<div class="clear"></div>

		<?php do_action( 'df_post_bottom' ); ?>

		<div class="clear"></div>

		<?php if ( !is_singular() && get_theme_mod( 'df_skin', 'df-skin-boxed' ) ) : ?>
			</div>
		<?php endif; ?>

	</div>

</div>