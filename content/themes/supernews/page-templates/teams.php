<?php
/**
 * Template Name: Teams template
 */
get_header(); ?>

	<div id="primary" class="content-area column">
		<div id="content" class="content-loop" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> <?php hybrid_attr( 'post' ); ?>>
					
					<?php
						// Check if the required plugin active.
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
						if ( is_plugin_active( 'theme-junkie-team-content/tj-team-content.php' ) ) : 
					?>

						<?php the_title( '<h1 class="page-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>

						<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'supernews' ),
									'after'  => '</div>',
								) );
							?>

							<?php $args = apply_filters( 'supernews_team_query', array( 'post_type' => 'member', 'posts_per_page' => -1 ) ); ?>
							<?php $teams = new WP_Query( $args ); ?>

							<?php if ( $teams->have_posts() ) : ?>

								<h3>Contributors</h3>

								<div class="team-members">
									<ul class="members">
										<?php while ( $teams->have_posts() ) : $teams->the_post(); ?>
											<li class="member">
												<div class="member-photo">
													<img src="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_avatar', true ) ); ?>" alt="<?php the_title(); ?>">
													<ul class="member-social clearfix">
														<li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_twitter_url', true ) ); ?>"><i class="fa fa-twitter"></i></a></li>
														<li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_facebook_url', true ) ); ?>"><i class="fa fa-facebook"></i></a></li>
														<li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_googleplus_url', true ) ); ?>"><i class="fa fa-google-plus"></i></a></li>
														<li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_linkedin_url', true ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
														<li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_pinterest_url', true ) ); ?>"><i class="fa fa-pinterest"></i></a></li>
														<li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'tj_member_dribbble_url', true ) ); ?>"><i class="fa fa-dribbble"></i></a></li>
													</ul>
												</div>
												<div class="member-content">
													<h3 class="member-name"><?php the_title(); ?></h3>
													<p class="member-position"><?php echo esc_attr( get_post_meta( get_the_ID(), 'tj_member_position', true ) ); ?></p>
													<div class="member-desc"><?php the_content(); ?></div>
												</div>
											</li>
										<?php endwhile; ?>
									</ul>
								</div>

							</div><!-- .entry-content -->

						<?php endif; wp_reset_postdata(); ?>

					<?php else : ?>

						<div class="entry-content">
							<p><?php printf( __( 'Please install %1$sTheme Junkie Team Content%2$s plugin to use this page template.', 'supernews' ), '<a href="http://wordpress.org/plugins/theme-junkie-team-content/" target="_blank">', '</a>' ); ?></p>
						</div><!-- .entry-content -->

					<?php endif; ?>

				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>