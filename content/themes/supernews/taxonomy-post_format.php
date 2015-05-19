<?php get_header(); ?>

	<div id="primary" class="content-area column">
		<div id="content" class="content-loop blog-list category-box" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<h3 class="section-title"><strong>
				<?php
					if ( is_tax( 'post_format', 'post-format-gallery' ) ) :
						_e( 'Galleries', 'supernews');

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', 'supernews');

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', 'supernews' );

					endif;
				?>
			</strong></h3>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
