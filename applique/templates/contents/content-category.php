<?php
/**
 * `dahz_attr( 'post' )` are function to print attribute and microdata in article element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_post`.
 */ ?>
<div <?php dahz_attr( 'post' ); ?>>

	<?php
	/**
	 * `dahz_attr( 'entry-title' )` are function to print attribute and microdata in post title.
	 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_title`.
	 */ ?>
	<h3 <?php dahz_attr( 'entry-title' ); ?>>
		<?php the_title( '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" rel="bookmark">', '</a>', true ); ?>
	</h3>

	<?php
	/**
	 * `dahz_attr( 'entry-summary' )` are function to print attribute and microdata in post summary.
	 * This function locate in `libraries/attr.php` under function named `dahz_attr_entry_summary`.
	 */ ?>
	<div <?php dahz_attr( 'entry-summary' ); ?>>

		<?php the_excerpt(); ?>

	</div>

</div>