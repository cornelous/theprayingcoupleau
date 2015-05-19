		<?php supernews_latest_videos(); // Get the latest video post format. ?>
		
	</main><!-- #content -->

	<footer id="footer" class="container clearfix" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>

		<div class="footer-column footer-column-1">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>

		<div class="footer-column footer-column-2">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>

		<div class="footer-column footer-column-3">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>

		<div class="footer-column footer-column-4">
			<?php dynamic_sidebar( 'footer-4' ); ?>
		</div>

		<div id="site-bottom" class="container clearfix">

			<?php get_template_part( 'menu', 'footer' ); // Loads the menu-footer.php template. ?>

			<div class="copyright"><?php echo stripslashes( of_get_option( 'supernews_footer_text', of_get_default( 'supernews_footer_text' ) ) ); ?></div><!-- .copyright -->

		</div>
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
