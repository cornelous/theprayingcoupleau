<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured Post', 'supernews' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="sticky-post">
	<?php endif; ?>

	<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php supernews_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'supernews-blog', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
	<?php endif; ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<div class="more-link">
	    <a href="<?php the_permalink(); ?>"><?php _e( 'Read the rest of this entry', 'supernews' ); ?></a>
	</div><!-- .more-link -->

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		</div>
	<?php endif; ?> 
	
</article><!-- #post-## -->
