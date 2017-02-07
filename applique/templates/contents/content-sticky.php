<?php
/**
 * `dahz_attr( 'post' )` are function to print attribute and microdata in article element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_post`.
 */ ?>

<div <?php dahz_attr( 'post' ); ?>>

	<?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>

		<?php do_action( 'df_featured_media' ); ?>

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

		<?php echo df_blog_tags(); ?>

		<?php echo df_affiliate(); ?>

		<?php do_action( 'df_post_bottom' ); ?>

	<?php else : // If not viewing a single post. ?>

		<div class="row">

			<?php do_action( 'df_featured_media' ); ?>

			<div class="sticky-content col-md-6">

				<?php echo df_title_post(); ?>

				<?php
				/**
				 * `dahz_attr( 'entry-summary' )` are function to print attribute and microdata in post summary.
				 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_summary`.
				 */ ?>
				<div <?php dahz_attr( 'entry-summary' ); ?>>
					<?php the_excerpt(); ?>
				</div>

				<?php do_action( 'df_post_bottom' ); ?>

			</div>

		</div>

	<?php endif; // End single post check. ?>

	<div class="clear"></div>

</div>