<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
	
	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php supernews_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	
	<?php if ( has_post_format( 'image' ) ) : ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'supernews-blog', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
		<?php endif; ?>
	<?php elseif ( has_post_format( 'video' ) ) : ?>
		<div class="featured-video">
			<?php echo hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ); ?>
		</div>
	<?php elseif ( has_post_format( 'audio' ) ) : ?>
		<div class="featured-video">
			<?php echo hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'supernews' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer clearfix">

		<div class="col-left">
			<?php supernews_post_author(); ?>
		</div><!-- .col-left -->

		<div class="col-right">
			<?php supernews_newsletter_form(); ?>
			<?php supernews_social_share(); ?>
		</div>
		
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
