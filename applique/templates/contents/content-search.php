<?php
/* Define several variables used in conditional. */
$arch_std = get_theme_mod( 'df_arch_layout', 'fit_2_col' ); // Blog Layout ?>

<?php if ( get_post_type() == 'post' ) : ?>

	<?php if ( $arch_std == 'standard' ) : ?>

		<?php get_template_part( 'templates/contents/content', 'standard' ); ?>

	<?php elseif ( $arch_std == 'list' ) : ?>

		<?php get_template_part( 'templates/contents/content', 'list' ); ?>

	<?php elseif ( $arch_std != 'list' || $arch_std != 'standard' ) : ?>

		<?php get_template_part( 'templates/contents/content' ); ?>

	<?php endif; ?>

<?php elseif ( get_post_type() == 'page' ) : ?>

	<?php get_template_part( 'templates/contents/content', 'page' ); ?>

<?php endif ?>