<?php
/**
Template Name: Fullwidth Featured Iamge
*/
?>
<?php get_header(); ?>
<div id="content-wrap">
	<div class="main-sidebar-container container">
		<div class="row">
			<div id="df-content" class="df-content col-md-12" role="main" itemprop="mainContentOfPage">
				<?php if ( have_posts() ) : ?>
					<?php 
						while ( have_posts() ) : the_post();
						$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
						$thumbnailSrc = $src[0];
						$featuredCaption = get_field("featured_image_caption");
						
					?>
						<?php if ( '' != get_the_post_thumbnail($post->ID) ) {  ?>
						<div class="featured-media full-image">
							<img src="<?php echo $thumbnailSrc; ?>" alt="<?php the_title();?>">
							<?php if($featuredCaption) { ?>
							<div class="featured-caption">
								<div class="inner">
									<?php echo $featuredCaption; ?>
								</div>
							</div>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="entry-content" itemprop="text" style="padding:0 0 20px 0;">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<?php the_content();?>
								</div>
							</div>
						</div>
						<?php endwhile; wp_reset_postdata();wp_reset_query();rewind_posts(); ?>
					<?php else : ?>
					<?php get_template_part( 'templates/contents/content', 'empty' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php echo df_social_account(); ?>
	<?php echo df_miscellaneous(); ?>
</div>
<?php get_footer(); ?>