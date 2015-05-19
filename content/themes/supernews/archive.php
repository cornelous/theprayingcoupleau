<?php get_header(); ?>

	<?php $layout = of_get_option( 'supernews_archive_layout', 'standard' ); ?>

	<section id="primary" class="content-area column">

		<?php if ( of_get_option( 'supernews_archive_ads' ) ) : ?>
			<div class="header-ad">
				<?php echo stripslashes( of_get_option( 'supernews_archive_ads' ) ); ?>
			</div>
		<?php endif; ?>

		<div id="content" class="content-loop category-box <?php echo esc_attr( supernews_archive_page_classes() ); ?>" role="main" <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<h3 class="section-title"><strong>
				<?php
					if ( is_category() ) :
						single_cat_title( __( 'Category: ', 'supernews' ) );

					elseif ( is_tag() ) :
						single_tag_title( __( 'Tags: ', 'supernews' ) );

					elseif ( is_author() ) :
						printf( __( 'Author: %s', 'supernews' ), '<span class="vcard">' . get_the_author() . '</span>' );

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'supernews' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'supernews' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'supernews' ) ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'supernews' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'supernews' ) ) . '</span>' );

					elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
						_e( 'Galleries', 'supernews');

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', 'supernews');

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', 'supernews' );

					elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
						_e( 'Audios', 'supernews' );

					else :
						_e( 'Archives', 'supernews' );

					endif;
				?>
			</strong></h3>

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
	</section><!-- #primary -->

<?php get_sidebar( 'secondary' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>