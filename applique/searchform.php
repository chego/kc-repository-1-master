<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'applique' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search ...', 'applique' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for :', 'applique' ); ?>">
	</label>
	<button type="submit" class="fa fa-search submit btn-text" name="submit" value="Search"></button>
</form>