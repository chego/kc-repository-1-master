<?php
$arch_lst = get_theme_mod( 'df_arch_layout', 'fit_2_col' );
/**
 * `dahz_attr( 'post' )` are function to print attribute and microdata in article element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_post`.
 */ ?>

<?php if ( is_page() ) : ?>

	<div <?php dahz_attr( 'post' ); ?>>

		<?php if ( has_post_thumbnail() ): ?>

			<div class="featured-media">

				<?php the_post_thumbnail( 'full' ); ?>

			</div>

		<?php endif; ?>

		<?php
		/**
		 * `dahz_attr( 'entry-content' )` are function to print attribute and microdata in post content.
		 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_content`.
		 */ ?>
		<div <?php dahz_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>

		</div>

		<div class="clear"></div>

		<?php echo df_affiliate(); ?>

		<?php do_action( 'df_post_bottom' ); ?>

		<div class="clear"></div>

	</div>

<?php elseif ( is_search() ) : ?>

	<div <?php dahz_attr( 'post' ); ?>>

	<div class="df-inner-posts">
			<?php if ( $arch_lst == 'list' ) : ?>
				<div class="row">
			<?php endif; ?>

				<?php if ( $arch_lst == 'standard' ) : ?>
					<?php echo df_title_page(); ?>
				<?php endif; ?>

				<?php do_action( 'df_featured_media' ); ?>

				<?php if ( $arch_lst == 'list' ) :
					$arch_lst = ( get_theme_mod( 'df_arch_layout', 'fit_2_col' ) == 'list' ); // Archive Layout
					$col 	  = ' col-md-6';
					if ( !is_sticky() && get_theme_mod( 'disable_sidebar_archive', 1 ) == 1 && is_search() && $arch_lst ) :
			            $col = ' col-md-8';
			        endif; ?>

					<div class="list-content<?php echo esc_attr( $col ); ?>">
				<?php elseif ( $arch_lst == 'fit_2_col' || $arch_lst == 'fit_3_col' ) : ?>
					<div class="grid-wrapper">
				<?php endif; ?>

					<?php if ( $arch_lst == 'list' || $arch_lst == 'fit_2_col' || $arch_lst == 'fit_3_col' ) : ?>
						<?php echo df_title_page(); ?>
					<?php endif; ?>

					<?php
					/**
					 * `dahz_attr( 'entry-content' )` are function to print attribute and microdata in post summary.
					 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_summary`.
					 */ ?>
					<div <?php dahz_attr( 'entry-summary' ); ?>>

						<?php echo df_summary_type(); ?>

						<?php wp_link_pages(); ?>

					</div>

				<?php if ( $arch_lst == 'list' || $arch_lst == 'fit_2_col' || $arch_lst == 'fit_3_col' ) : ?>
					</div>
				<?php endif; ?>

			<?php if ( $arch_lst == 'list' ) : ?>
				</div>

			<?php endif; ?>

			<div class="clear"></div>

			<?php if ( $arch_lst == 'standard' ) : ?>
				<?php echo df_affiliate(); ?>
			<?php endif; ?>

			<?php do_action( 'df_post_bottom' ); ?>

			<div class="clear"></div>
		</div>
	</div>

<?php endif; ?>