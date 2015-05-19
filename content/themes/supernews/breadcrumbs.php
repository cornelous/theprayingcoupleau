<div id="breadcrumbs">

	<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>
		<?php breadcrumb_trail(
			array(
				'separator'     => '&rarr;',
				'before'        => '<strong>' . __( 'You Are Here:', 'supernews' ) . '</strong>',
				'show_browse'   => false,
				'show_on_front' => false,
			) 
		); ?>
	<?php endif; // End check for breadcrumb support. ?>

	<span class="post-nav">
		<a href="<?php echo get_previous_posts_link(); ?>" title="<?php esc_attr_e( 'Previous Post', 'supernews' ); ?>"><i class="fa fa-angle-left"></i></a>
		<a href="<?php echo get_next_posts_link(); ?>" class="<?php esc_attr_e( 'Next Post', 'supernews' ); ?>"><i class="fa fa-angle-right"></i></a>
	</span>

</div>