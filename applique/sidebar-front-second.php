<div id="front-content-two" class="front-content column-3 widget-area row">

	<?php for ( $i = 1; $i < 4; $i++ ) : ?>

		<div class="col-md-4">

			<?php dynamic_sidebar( 'front-second-' . $i ); ?>

		</div>

	<?php endfor; ?>

</div>