<?php get_header(); ?>
	
	<?php 
		$category = get_category( get_query_var( 'cat' ), false );
		$layout = get_tax_meta( $category->term_id, 'supernews_cat_layout', false );
		if ( empty( $layout ) ) {
			$layout = 'standard';
		}
	?>

	<div id="primary" class="content-area column">

		<?php get_template_part( 'content', 'featured' ); ?>

		<?php if ( of_get_option( 'supernews_archive_ads' ) ) : ?>
			<div class="header-ad">
				<?php echo stripslashes( of_get_option( 'supernews_archive_ads' ) ); ?>
			</div>
		<?php endif; ?>

		<div id="content" class="content-loop category-box <?php echo esc_attr( supernews_archive_page_classes() ); ?>" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<h3 class="section-title"><strong><?php single_cat_title( __( 'Category: ', 'supernews' ) ); ?></strong></h3>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php if ( 'standard' === $layout ) : ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php elseif ( 'classic' === $layout ) : ?>
					<?php get_template_part( 'content', 'classic' ); ?>
				<?php elseif ( 'grid_1' === $layout ) : ?>
					<?php get_template_part( 'content', 'grid-1' ); ?>
				<?php elseif ( 'grid_2' === $layout ) : ?>
					<?php get_template_part( 'content', 'grid-2' ); ?>
				<?php endif; ?>

			<?php endwhile; ?>

			<div class="clearfix"></div>

			<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
