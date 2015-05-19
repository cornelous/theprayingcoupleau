<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get">
	<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'supernews' ); ?>">
	<button type="submit" name="submit" id="searchsubmit"><?php _e( 'Search', 'supernews' ); ?></button>
</form>