<?php get_header(); ?>

	<div id="primary" class="content-area column">
		<div id="content" class="content-loop" role="main" <?php hybrid_attr( 'content' ); ?>>

			<?php woocommerce_content(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
