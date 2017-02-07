<?php
/**
 * Template Name: Custom Archive
 *
 * The Archive Template.
 *
 */
$args = array(
	'post_type'			  => 'post',
	'post_status'     	  => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'	  => get_post_meta( get_the_ID(), 'df_custom_archive', true ),
	'paged'				  => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
);

$archive = new WP_Query( $args );
?>

<?php get_header(); ?>

	<div id="content-wrap">

		<div class="main-sidebar-container container">

			<div class="row">

				<?php do_action( 'top_element' ); ?>

				<div id="df-content" class="df-content df-custom-archive" role="main" itemprop="mainContentOfPage">

					<div class="row">

						<?php if ( $archive->have_posts() ) : // Check if have post. ?>

							<?php while ( $archive->have_posts() ) : $archive->the_post(); // Loads the post data. ?>

								<div id="post-<?php the_ID() ?>" <?php post_class( 'col-md-3 custom-archive aligncenter' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" role="article">

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="featured-media"><?php the_post_thumbnail( 'template-archive' ); ?></div>
									<?php else : ?>
										<div class="no-media" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/placeholder.png'; ?>);"></div>
									<?php endif; ?>

									<div class="wrapper">

										<div class="inner">
											<div class="	">
												<div <?php dahz_attr( 'entry-terms', 'category' ) ?>><?php echo df_category( ',' ); ?></div>
											</div>

											<?php the_title( '<h4 class="entry-title" itemprop="headline"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h4>' ); ?>

											<a href="<?php the_permalink( get_the_ID() ); ?>" class="more-link outline small"><?php esc_html_e( 'Read More', 'applique' ); ?></a>

										</div>

									</div>

								</div>

							<?php endwhile; // End of loads the post data. ?>

						<?php else : ?>

							<?php get_template_part( 'templates/contents/content', 'empty' ); ?>

						<?php endif; ?>

					</div>

				</div>

				<?php if ( $archive->max_num_pages > 1 ) : // check if the max number of pages is greater than 1  ?>

					<div class="df-pagination df-pagenav">

						<div class="clear"></div>

						<div class="nav-next">

							<?php echo sprintf( get_next_posts_link( wp_kses( __( 'Older Posts<i class="fa fa-angle-right"></i>', 'applique' ), array( 'i' => array( 'class' => array() ) ) ), $archive->max_num_pages ) ); // display older posts link ?>

						</div>

						<div class="nav-prev">

							<?php echo sprintf( get_previous_posts_link( wp_kses( __( '<i class="fa fa-angle-left"></i>Newer Posts', 'applique' ), array( 'i' => array( 'class' => array() ) ) ) ) ); // display newer posts link ?>

						</div>

					</div>

				<?php endif; ?>

				<?php wp_reset_query(); ?>

			</div>

		</div>

		<?php echo df_social_account(); ?>
		<?php echo df_miscellaneous();	?>

	</div>

<?php get_footer(); ?>