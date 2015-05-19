<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'supernews-grid-2', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
	<?php endif; ?>

	<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<span class="entry-date updated"><time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() )?></time></span>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="entry-comment"><?php comments_popup_link( __( '0 Comment', 'supernews' ), __( '1 Comment', 'supernews' ), __( '% Comments', 'supernews' ) ); ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php echo wp_trim_words( get_the_excerpt(), 24 ); ?>
	</div><!-- .entry-content -->

	<div class="more-link">
	    <a href="<?php the_permalink(); ?>"><?php _e( 'Read the rest of this entry', 'supernews' ); ?></a>
	</div><!-- .more-link -->   
	
</article><!-- #post-## -->
