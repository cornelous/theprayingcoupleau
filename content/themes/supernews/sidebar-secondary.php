<?php
// Return early if no widget found.
if ( ! is_active_sidebar( 'secondary' ) ) {
	return;
}

// Return early if user uses 1 column and 2 columns layout.
if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c', 'narrow', 'narrow-2' ) ) ) {
	return;
}
?>

<div class="widget-area sidbear sidebar1 column" role="complementary" aria-label="<?php echo esc_attr_x( 'Secondary Sidebar', 'Sidebar aria label', 'supernews' ); ?>" <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>
	<?php dynamic_sidebar( 'secondary' ); ?>
</div><!-- #secondary -->