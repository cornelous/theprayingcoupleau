<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php supernews_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	
	<?php $audio = hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ); ?>
	<?php if ( $audio ) :  ?>
		<div class="featured-video"><?php echo $audio; ?></div>
	<?php endif; ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<div class="more-link">
	    <a href="<?php the_permalink(); ?>"><?php _e( 'Read the rest of this entry', 'supernews' ); ?></a>
	</div><!-- .more-link -->   
	
</article><!-- #post-## -->
