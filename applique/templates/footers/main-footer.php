<?php
/**
 * `dahz_attr( 'footer' )` are function to print attribute and microdata in footer element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_footer`.
 */ ?>
<div <?php dahz_attr( 'footer' ); ?>>

	<?php get_template_part( 'templates/footers/foot-ads' ); ?>

	<?php get_template_part( 'templates/footers/foot-ig' ); ?>

	<div class="df-footer-bottom border-top">

		<div class="container">

			<?php get_template_part( 'templates/footers/foot-logo' ); ?>

			<?php get_template_part( 'templates/menus/foot' ); ?>

			<?php get_template_part( 'templates/footers/copyright' ); ?>

			<?php get_template_part( 'templates/footers/back-top' ); ?>

			<?php get_template_part( 'templates/footers/misc' ); ?>

		</div>

	</div>

</div>