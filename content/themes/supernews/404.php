<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<h1 class="page-title"><?php _e( '404 - Page Not found', 'supernews' ); ?></h1>

				<div class="entry-content">
					<p><?php _e( 'We\'re sorry, but we can\'t find the page you were looking for. It\'s probably some thing we\'ve done wrong but now we know about it and we\'ll try to fix it.', 'supernews' ); ?></p>
					<ul>
						<li><a href="javascript: history.go(-1);"><?php _e( 'Go to Previous Page', 'supernews' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Go to Homepage', 'supernews' ); ?></a></li>
					</ul>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>