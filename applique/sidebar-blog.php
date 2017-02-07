<?php // if ( is_active_sidebar( 'blog-first' ) || is_active_sidebar( 'blog-second' ) || is_active_sidebar( 'blog-third' ) ) : ?>

	<div id="blog-widget" class="blog-widget-area container">

		<div class="row">

			<div class="blog-widget-area-wrap col-md-4">
				<?php dynamic_sidebar( 'blog-first' ); ?>
			</div>

			<div class="blog-widget-area-wrap col-md-4">
				<?php dynamic_sidebar( 'blog-second' ); ?>
			</div>

			<div class="blog-widget-area-wrap col-md-4">
				<?php dynamic_sidebar( 'blog-third' ); ?>
			</div>

		</div>

	</div>

<?php // endif; ?>