<?php
/**
 * Template Name: Block template
 */
get_header(); ?>

	<div id="primary" class="content-area column">
		<div id="content" class="content-loop" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

					<div class="entry-builder">
						<?php the_content(); ?>
					</div>

				</div>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>