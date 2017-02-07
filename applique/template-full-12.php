<?php
/**
 * Template Name: Fullwidth 12 Columns
 *
 * The Fullwidth 12 Columns Template.
 *
 */
?>

<?php get_header(); ?>

	<div id="content-wrap">

		<div class="main-sidebar-container container">

			<div class="row">

				<div id="df-content" class="df-content col-md-12" role="main" itemprop="mainContentOfPage">

					<?php if ( have_posts() ) : // Check if have post. ?>

						<?php while ( have_posts() ) : the_post(); // Loads the post data. ?>

							<?php get_template_part( 'templates/contents/content', 'page' ); ?>

							<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>

								<?php if ( comments_open() ) : ?>

						 			<?php comments_template( '', true ); // Loads the comments.php template. ?>

								<?php endif; ?>

							<?php endif; // If viewing a single post/page/CPT. ?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'templates/contents/content', 'empty' ); ?>

					<?php endif; ?>

				</div>

			</div>

		</div>

		<?php echo df_social_account(); ?>
		<?php echo df_miscellaneous();	?>

	</div>

<?php get_footer(); ?>