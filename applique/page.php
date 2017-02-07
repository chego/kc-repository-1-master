<?php get_header(); ?>

	<div id="content-wrap">

		<div class="container main-sidebar-container">

			<div class="row">

				<?php
				/**
				 * `dahz_attr( 'content' )` are function to print attribute and microdata in main content element.
				 * This function locate in `libraries/attr.php` under function named `dahz_attr_content`.
				 */ ?>
				<div <?php dahz_attr( 'content' ); ?>>

					<?php if ( have_posts() ) : // Check if have post. ?>

						<?php while ( have_posts() ) : the_post(); // Loads the post data. ?>

							<?php get_template_part( 'templates/contents/content', 'page' ); ?>

							<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>

								<?php if ( comments_open() || get_comments_number() ) : ?>

						 			<?php comments_template( '', true ); // Loads the comments.php template. ?>

								<?php endif; ?>

							<?php endif; // End if viewing a single post/page/CPT. ?>

						<?php endwhile; // End of loads the post data. ?>

					<?php else : ?>

						<?php get_template_part( 'templates/contents/content', 'empty' ); ?>

					<?php endif; ?>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

		<?php echo df_social_account(); ?>
		<?php echo df_miscellaneous();	?>

	</div>

<?php get_footer(); ?>