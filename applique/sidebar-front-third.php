<div id="front-content-three" class="front-content column-2 widget-area row">

	<?php for ( $i = 1; $i < 3; $i++ ) : ?>

		<div class="col-md-6">

			<?php dynamic_sidebar( 'front-third-' . $i ); ?>

		</div>

	<?php endfor; ?>

</div>