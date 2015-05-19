<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'supernews_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function supernews_posted_on() {
?>
	<span class="entry-author author vcard" <?php hybrid_attr( 'entry-author' ) ?>><i class="fa fa-user"></i> <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="url"><small itemprop="name"><?php echo esc_html( get_the_author() ); ?></small></a></span>
	
	<span class="entry-date"><i class="fa fa-clock-o"></i> <time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() )?></time></span>

	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="entry-comment"><i class="fa fa-comments"></i> <?php comments_popup_link( __( '0 Comment', 'supernews' ), __( '1 Comment', 'supernews' ), __( '% Comments', 'supernews' ) ); ?></span>
	<?php endif; ?>

	<?php
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) : 
	?>
		<span class="entry-tags" <?php hybrid_attr( 'entry-terms', 'post_tag' ); ?>><i class="fa fa-tags"></i> <?php echo $tag_list; ?></span>
	<?php endif; ?>

<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function supernews_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'supernews_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'supernews_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so supernews_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so supernews_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in supernews_categorized_blog.
 *
 * @since 1.0.0
 */
function supernews_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'supernews_categories' );
}
add_action( 'edit_category', 'supernews_category_transient_flusher' );
add_action( 'save_post',     'supernews_category_transient_flusher' );

if ( ! function_exists( 'supernews_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 * 
 * @since  1.0.0
 */
function supernews_site_branding() {

	$logo = of_get_option( 'supernews_logo' );

	// Check if logo available, then display it.
	if ( $logo ) :
		echo '<div id="logo" itemscope itemtype="http://schema.org/Brand">' . "\n";
			echo '<a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home">' . "\n";
				echo '<img itemprop="logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<div id="logo"><h1 class="site-title" ' . hybrid_get_attr( 'site-title' ) . '><a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home"><span itemprop="headline">' . esc_attr( get_bloginfo( 'name' ) ) . '</span></a></h1></div>';
	endif;

}
endif;

if ( ! function_exists( 'supernews_post_author' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function supernews_post_author() {

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Bail if user don't want to display the author info via theme settings.
	if ( ! of_get_option( 'supernews_post_author', '1' ) ) {
		return;
	}
?>

	<div class="author-bio clearfix" <?php hybrid_attr( 'entry-author' ) ?>>
		<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'supernews_author_bio_avatar_size', 64 ), '', strip_tags( get_the_author() ) ); ?>
		<div class="description">
			<h3 class="author-title name">
				<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></a>
			</h3>
			<p class="bio" itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
		</div>
	</div><!-- .author-bio -->

<?php
}
endif;

if ( ! function_exists( 'supernews_social_share' ) ) :
/**
 * Social share.
 *
 * @since  1.0.0
 */
function supernews_social_share() {
	global $post;

	// Bail if user don't want to display the share buttons via theme settings.
	if ( ! of_get_option( 'supernews_post_share', '1' ) ) {
		return;
	}
?>
	<div class="entry-share clearfix">
		<h3><?php _e( 'Share This Post', 'supernews' ); ?></h3>
		<ul>
			<li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-twitter"></i></a></li>
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-facebook"></i></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-google-plus"></i></a></li>
			<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&title=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><i class="fa fa-linkedin"></i></a></li>
			<li><a href="mailto:"><i class="fa fa-envelope-o"></i></a></li>
			<li><a href="javascript:window.print()"><i class="fa fa-print"></i></a></li>
		</ul>
	</div>
<?php
}
endif;

if ( ! function_exists( 'supernews_newsletter_form' ) ) :
/**
 * Newsletter form.
 *
 * @since  1.0.0
 */
function supernews_newsletter_form() {
	$form = of_get_option( 'supernews_newsletter' );

	if ( $form ) {
		echo '<div class="newsletter-form">';
			echo '<h3>' . __( 'Get the <strong>latest news</strong> in your inbox, free!', 'supernews' ) . '</h3>';
			echo stripslashes( $form );
		echo '</div>';
	}

}
endif;

if ( ! function_exists( 'supernews_related_posts' ) ) :
/**
 * Related posts.
 *
 * @since  1.0.0
 */
function supernews_related_posts() {
	global $post;

	// Bail if user don't want to display the author info via theme settings.
	if ( ! of_get_option( 'supernews_related_posts', '1' ) ) {
		return;
	}

	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}
	
	// Posts query arguments.
	$query = array(
		'post__not_in' => array( $post->ID ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 4,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'supernews_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : ?>

		<div class="related-posts">
			<h3><?php _e( 'You might also like:', 'supernews' ); ?></h3>
			<ul class="clearfix">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'supernews-featured-small', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
							<?php endif; ?>
							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	
	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'supernews_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function supernews_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">
			<p <?php hybrid_attr( 'comment-content' ); ?>><?php _e( 'Pingback:', 'supernews' ); ?> <span <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php comment_author_link(); ?></span></span> <?php edit_comment_link( __( '(Edit)', 'supernews' ), '<span class="edit-link">', '</span>' ); ?></p>
		</article>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">

			<?php echo get_avatar( $comment, apply_filters( 'supernews_comment_avatar_size', 52 ) ); ?>

			<div class="comment-head">
				<span class="name" <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php echo get_comment_author_link(); ?></span></span>
				<?php
					printf( '<span class="date"><a href="%1$s" ' . hybrid_get_attr( 'comment-permalink' ) . '><time datetime="%2$s" ' . hybrid_get_attr( 'comment-published' ) . '>%3$s</time></a> %4$s</span>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'supernews' ), get_comment_date(), get_comment_time() ),
						sprintf( __( '%1$s&middot; Edit%2$s', 'supernews' ), '<a href="' . get_edit_comment_link() . '" title="' . esc_attr__( 'Edit Comment', 'supernews' ) . '">', '</a>' )
					);
				?>
			</div><!-- comment-head -->
			
			<div class="comment-content comment-entry comment" <?php hybrid_attr( 'comment-content' ); ?>>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'supernews' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'supernews' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span><!-- .reply -->
			</div><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'supernews_latest_videos' ) ) :
/**
 * Get the latest video post format.
 *
 * @since 1.0.0
 */
function supernews_latest_videos() {
	global $post;

	$enable = of_get_option( 'supernews_latest_video', '1' ); // Enable disable area.
	$title  = of_get_option( 'supernews_latest_video_title', 'Must See Videos' );

	// Bail if disable by user.
	if ( ! $enable ) {
		return;
	}

	// Return early if on singular post.
	if ( ! is_front_page() ) {
		return;
	}

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-video' )
			)
		),
	);

	// The post query
	$video = new WP_Query( $args );

	// Check if the post(s) exist.
	if ( $video ) : ?>

		<section id="carousel-1" class="carousel-loop container clearfix">
			
			<h3 class="section-title">
				<a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>"><?php echo strip_tags( $title ); ?></a>
			</h3>

			<div class="jcarousel">
				<ul>
					<?php while ( $video->have_posts() ) : $video->the_post(); ?>
						<li>
							<article class="hentry post">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="video-thumbnail" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'supernews-grid-1', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
										<div class="video-icon"><i class="fa fa-play"></i></div>
									</a>
								<?php endif; ?>
								<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="entry-meta">
									<span class="entry-date updated">
										<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() )?></time>
									</span>
								</div>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>

			<a href="#" class="jcarousel-control-prev"><i class="fa fa-angle-left"></i></a>
			<a href="#" class="jcarousel-control-next"><i class="fa fa-angle-right"></i></a>

		</section>

	<?php 
	endif; // End check.

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;