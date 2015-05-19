<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 728; /* pixels */
}

if ( ! function_exists( 'supernews_content_width' ) ) :
/**
 * Set new content width if user uses 1 column layout.
 *
 * @since  1.0.0
 */
function supernews_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 1270;
	}
}
endif;
add_action( 'template_redirect', 'supernews_content_width' );

if ( ! function_exists( 'supernews_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function supernews_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'supernews', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'supernews-blog', 728, 410, true );
	add_image_size( 'supernews-classic', 200, 200, true );
	add_image_size( 'supernews-grid-1', 344, 193, true );
	add_image_size( 'supernews-grid-2', 90, 90, true );
	add_image_size( 'supernews-featured-big', 400, 225, true );
	add_image_size( 'supernews-featured-small', 180, 100, true );
	add_image_size( 'supernews-widget-thumb', 64, 64, true );
	add_image_size( 'supernews-widget-thumb-big', 300, 150, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'supernews' ),
			'secondary' => __( 'Secondary Menu' , 'supernews' ),
			'footer'    => __( 'Footer Menu' , 'supernews' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'video', 'audio',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'supernews_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts', 
		array(
			'1c'       => __( '1 Column Wide (Full Width)', 'supernews' ),
			'narrow'   => __( '2 Columns: Content / Sidebar', 'supernews' ),
			'narrow-2' => __( '2 Columns: Sidebar / Content', 'supernews' ),
			'3c'       => __( '3 Columns: Side 1 / Content / Side 2', 'supernews' ),
			'css'      => __( '3 Columns: Content / Side 1 / Side 2', 'supernews' ),
			'css-2'    => __( '3 Columns: Content / Side 2 / Side 1', 'supernews' ),
		),
		array( 'customize' => true, 'default' => 'narrow' ) 
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	/* Breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

}
endif; // supernews_theme_setup
add_action( 'after_setup_theme', 'supernews_theme_setup' );

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function supernews_widgets_init() {

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads.php';
	register_widget( 'SuperNews_Ads_Widget' );

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads125.php';
	register_widget( 'SuperNews_Ads125_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-feedburner.php';
	register_widget( 'SuperNews_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
	register_widget( 'SuperNews_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-popular.php';
	register_widget( 'SuperNews_Popular_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-random.php';
	register_widget( 'SuperNews_Random_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-video.php';
	register_widget( 'SuperNews_Video_Widget' );

	// Register tabs widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-tabs.php';
	register_widget( 'SuperNews_Tabs_Widget' );

	// Register social counter widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-counter.php';
	register_widget( 'SuperNews_Counter_Widget' );

	// Register social counter widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-twitter.php';
	register_widget( 'SuperNews_Twitter_Widget' );
	
}
add_action( 'widgets_init', 'supernews_widgets_init' );

/**
 * Registers widget areas.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function supernews_sidebar_init() {

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'supernews' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><strong>',
			'after_title'   => '</strong></h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Secondary Sidebar', 'supernews' ),
			'id'            => 'secondary',
			'description'   => __( 'Mini sidebar, ussualy on the left.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><strong>',
			'after_title'   => '</strong></h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'supernews' ),
			'id'            => 'footer-1',
			'description'   => __( 'The footer sidebar 1st column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'supernews' ),
			'id'            => 'footer-2',
			'description'   => __( 'The footer sidebar 2nd column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'supernews' ),
			'id'            => 'footer-3',
			'description'   => __( 'The footer sidebar 3rd column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'supernews' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar 4th column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	
}
add_action( 'widgets_init', 'supernews_sidebar_init' );

/**
 * Get the [gallery] shortcode from the post content and display it on index page. It require
 * gallery ids [gallery ids=1,2,3,4] to display it as thumbnail slideshow. If no ids exist it
 * just display it as standard [gallery] markup.
 *
 * If no [gallery] shortcode found in the post content, get the attached images to the post and 
 * display it as slideshow.
 * 
 * @since  1.0.0
 * @uses   get_post_gallery() to get the gallery in the post content.
 * @uses   wp_get_attachment_image() to get the HTML image.
 * @uses   get_children() to get the attached images if no [gallery] found in the post content.
 * @return string
 */
function supernews_get_format_gallery() {
	global $post;

	// Set up a default, empty $html variable.
	$html = '';

	// Check the [gallery] shortcode in post content.
	$gallery = get_post_gallery( $post->ID, false );

	// Check if the [gallery] exist.
	if ( $gallery ) {

		// Check if the gallery ids exist.
		if ( isset( $gallery['ids'] ) ) {

			// Get the gallery ids and convert it into array.
			$ids = explode( ',', $gallery['ids'] );

			// Display the gallery in a cool slideshow on index page.
			$html = '<div id="carousel-0" class="jcarousel">';
				$html .= '<ul>';
					foreach( $ids as $id ) {
						$html .= '<li>';
						$html .= wp_get_attachment_image( $id, 'supernews-blog', false, array( 'class' => 'entry-thumbnail' ) );
						$html .= '</li>';
					}
				$html .= '</ul>';
			$html .= '</div>';

		} else {

			// If gallery ids not exist, display the standard gallery markup.
			$html = get_post_gallery( $post->ID );

		}

	// If no [gallery] in post content, get attached images to the post.
	} else {

		// Set up default arguments.
		$defaults = array( 
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post->ID,
			'post_mime_type' => 'image',
			'numberposts'    => -1
		);

		// Retrieves attachments from the post.
		$attachments = get_children( apply_filters( 'satu_gallery_format_args', $defaults ) );

		// Check if attachments exist.
		if ( $attachments ) {

			// Display the attachment images in a cool slideshow on index page.
			$html = '<div id="carousel-0" class="jcarousel">';
				$html .= '<ul>';
					foreach ( $attachments as $attachment ) {
						$html .= '<li>';
						$html .= wp_get_attachment_image( $attachment->ID, 'supernews-blog', false, array( 'class' => 'entry-thumbnail' ) );
						$html .= '</li>';
					}
				$html .= '</ul>';
			$html .= '</div>';

		}

	}

	$html .= '<p class="jcarousel-pagination-0"></p>';
	$html .= '<a href="#" class="jcarousel-control-prev"><i class="fa fa-chevron-left"></i></a>';
	$html .= '<a href="#" class="jcarousel-control-next"><i class="fa fa-chevron-right"></i></a>';

	// Return the gallery images.
	return $html;

}

/**
 * Custom archive page layout classes.
 *
 * @since  1.0.0
 */
function supernews_archive_page_classes() {

	// Get the default layout.
	if ( is_category() ) {
		$category = get_category( get_query_var( 'cat' ), false );
		$layout = get_tax_meta( $category->term_id, 'supernews_cat_layout', true );
		if ( empty( $layout ) ) {
			$layout = 'standard';
		}
	} elseif ( is_tag() ) {
		$layout = of_get_option( 'supernews_tag_layout', 'standard' );
	} elseif ( is_author() ) {
		$layout = of_get_option( 'supernews_author_layout', 'standard' );
	} elseif ( is_search() ) {
		$layout = of_get_option( 'supernews_search_layout', 'standard' );
	} else {
		$layout = of_get_option( 'supernews_archive_layout', 'standard' );
	}

	// Set up empty variable.
	$class = '';

	if ( 'standard' === $layout ) {
		$class = 'blog-list';
	} elseif ( 'classic' === $layout ) {
		$class = 'list';
	} elseif ( 'grid_1' === $layout ) {
		$class = 'grid grid1';
	} elseif ( 'grid_2' === $layout ) {
		$class = 'grid grid2';
	}

	// Allow dev to filter the class.
	return apply_filters( 'supernews_archive_page_classes', $class );

}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/breadcrumb-trail.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/hybrid-media-grabber.php';

/**
 * Load Options Framework core.
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'admin/options/' );
require trailingslashit( get_template_directory() ) . 'admin/options/options.php';
require trailingslashit( get_template_directory() ) . 'admin/options/options-framework.php';
require trailingslashit( get_template_directory() ) . 'admin/options/options-functions.php';

/**
 * Mega menus walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/megamenus/init.php';
require trailingslashit( get_template_directory() ) . 'inc/megamenus/class-primary-nav-walker.php';

/**
 * Load taxonomy framework.
 */
require trailingslashit( get_template_directory() ) . 'admin/taxonomy/Tax-meta-class.php';
require trailingslashit( get_template_directory() ) . 'admin/taxonomy/tax-meta.php';

/**
 * Load page builder widgets.
 */
require trailingslashit( get_template_directory() ) . 'inc/builder.php';

/**
 * Load woocommerce custom functions.
 */
if ( class_exists( 'WooCommerce' ) ) { 
	require trailingslashit( get_template_directory() ) . 'inc/theme-woocommerce.php';
}