<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>

	<div id="secondary-bar" class="clearfix">
				
		<a id="secondary-mobile-menu" href="#"><i class="fa fa-bars"></i> <?php _e( 'Secondary Menu', 'supernews' ); ?></a>

		<nav id="secondary-nav" role="navigation">

			<?php wp_nav_menu(
				array(
					'theme_location' => 'secondary',
					'container'      => '',
					'menu_id'        => 'secondary-menu',
					'menu_class'     => 'sf-menu',
					'walker'         => new SuperNews_Custom_Nav_Walker
				)
			); ?>

		</nav><!-- #secondary-nav -->

		<div class="header-search">

			<i class="fa fa-search"></i>
			<i class="fa fa-times"></i>

			<div class="search-form">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get">
					<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'supernews' ); ?>">
					<button type="submit" name="submit" id="searchsubmit"><?php _e( 'Search', 'supernews' ); ?></button>
				</form>
			</div><!-- .search-form -->		  

		</div><!-- .header-search -->

	</div><!-- #secondary-bar -->

<?php endif; // End check for menu. ?>