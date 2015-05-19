<?php if ( has_nav_menu( 'footer' ) ) : // Check if there's a menu assigned to the 'footer' location. ?>

	<nav id="footer-nav" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'container'      => '',
			)
		); ?>

	</nav><!-- #footer-nav -->

<?php endif; // End check for menu. ?>