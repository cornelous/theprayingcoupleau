<?php get_header(); ?>

	<?php $layout = of_get_option( 'supernews_author_layout', 'standard' ); ?>

	<div id="primary" class="content-area column">
		<div id="content" class="content-loop category-box <?php echo esc_attr( supernews_archive_page_classes() ); ?>" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<div class="author-bio clearfix" <?php hybrid_attr( 'entry-author' ) ?>>
				<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'supernews_author_bio_avatar_size', 90 ), '', strip_tags( get_the_author() ) ); ?>
				<div class="description">
					<h3 class="author-title name">
						<span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span>
					</h3>
					<p class="bio" itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
				</div>
				<?php
					$url      = get_the_author_meta( 'url' );
					$twitter  = get_the_author_meta( 'twitter' );
					$facebook = get_the_author_meta( 'facebook' );
					$gplus    = get_the_author_meta( 'gplus' );
					$linkedin = get_the_author_meta( 'linkedin' );
				?>
				<ul class="social-profiles">
					<?php if ( $url ) { ?>
						<li><a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e( 'Author Website', 'supernews' ); ?>"><i class="fa fa-home"></i></a></li>
					<?php } ?>
					<?php if ( $twitter ) { ?>
						<li><a href="<?php echo esc_url( $twitter ); ?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<?php } ?>
					<?php if ( $facebook ) { ?>
						<li><a href="<?php echo esc_url( $facebook ); ?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<?php } ?>
					<?php if ( $gplus ) { ?>
						<li><a href="<?php echo esc_url( $gplus ); ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
					<?php } ?>
					<?php if ( $linkedin ) { ?>
						<li><a href="<?php echo esc_url( $linkedin ); ?>" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
					<?php } ?>
				</ul>
			</div><!-- .author-bio -->

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
