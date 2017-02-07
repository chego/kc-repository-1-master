<?php
/**
 * `dahz_attr( 'post' )` are function to print attribute and microdata in article element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_post`.
 */ ?>
<div class="no-results not-found aligncenter" role="article">

	<h1 class="entry-title display-2"><?php esc_html_e( 'Nothing Found', 'applique' ); ?></h1>

	<div class="content">
		<p>
			<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'applique' ); ?>
		</p>

		<?php get_search_form(); ?>
	</div>

</div>