<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since  1.0.0
 * @param  array $args Configuration arguments.
 * @return array
 */
function supernews_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'supernews_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function supernews_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c', 'narrow-2' ) ) ) {
		$classes[] = 'layout-narrow';
	}

	return $classes;
}
add_filter( 'body_class', 'supernews_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function supernews_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'supernews_post_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function supernews_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'supernews' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'supernews_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function supernews_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'supernews_render_title' );
endif;

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @since  1.0.0
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function supernews_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'supernews_setup_author' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function supernews_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'supernews_excerpt_more' );

/**
 * Override the default options.php location.
 *
 * @since  1.0.0
 */
function supernews_location_override() {
	return array( 'admin/options/options.php' );
}
add_filter( 'options_framework_location', 'supernews_location_override' );

/**
 * Change the theme options text.
 *
 * @since  1.0.0
 * @param  array $menu
 */
function supernews_theme_options_text( $menu ) {
	$menu['page_title'] = '';
	$menu['menu_title'] = __( 'Theme Settings', 'supernews' );

	return $menu;
}
add_filter( 'optionsframework_menu', 'supernews_theme_options_text' );

/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 * @return string
 */
function supernews_feed_url( $output, $feed ) {

	// Get the custom rss feed url.
	$url = of_get_option( 'supernews_feedburner_url' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( !empty( $url ) ) {
		$output = esc_url( $url );
	}

	return $output;
}
add_filter( 'feed_link', 'supernews_feed_url', 10, 2 );

/**
 * Move textarea comment field to the top.
 *
 * @since  1.0.0
 */
function supernews_move_textarea( $input = array () ) {
	static $textarea = '';
 
	if ( 'comment_form_defaults' === current_filter() ) {
		$textarea = $input['comment_field'];
		$input['comment_field'] = '';	
		return $input;
	}
	if ( is_singular( 'post' ) || is_page() ) {
		print $textarea;
	}
}
add_action( 'comment_form_defaults', 'supernews_move_textarea' );
add_action( 'comment_form_top', 'supernews_move_textarea' );

/**
 * Custom comment form fields.
 *
 * @since  1.0.0
 * @param  array $fields
 * @return array
 */
function supernews_comment_form_fields( $fields, $args = array() ) {

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html5     = 'html5' === $args['format'];

	$fields['author'] = '<p class="comment-form-author">' . '<label for="author"><i class="fa fa-user"></i> ' . __( 'Name', 'supernews' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input class="txt" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields['email'] = '<p class="comment-form-email"><label for="email"><i class="fa fa-envelope"></i> ' . __( 'Email', 'supernews' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input class="txt" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields['url'] = '<p class="comment-form-url"><label for="url"><i class="fa fa-link"></i> ' . __( 'Website', 'supernews' ) . '</label> ' . '<input class="txt" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	return $fields;

}
add_filter( 'comment_form_default_fields', 'supernews_comment_form_fields' );

/**
 * Add custom attribute 'itempro="image"' to the post thumbnail.
 *
 * @since  1.0.0
 * @param  array  $attr
 * @return array
 */
function supernews_img_attr( $attr ) {
    $attr['itemprop'] = 'image';
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'supernews_img_attr', 10, 2 );

/**
 * Remove theme-layouts meta box on attachment and bbPress post type.
 * 
 * @since 1.0.0
 */
function supernews_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );
	remove_post_type_support( 'forum', 'theme-layouts' );
	remove_post_type_support( 'topic', 'theme-layouts' );
	remove_post_type_support( 'reply', 'theme-layouts' );
}
add_action( 'init', 'supernews_remove_theme_layout_metabox', 11 );

/**
 * Add post type 'post' support for page sidebars plugin.
 * 
 * @since  1.0.0
 */
function supernews_page_sidebar_plugin() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'simple-page-sidebars/simple-page-sidebars.php' ) ) {
		add_post_type_support( 'post', 'simple-page-sidebars' );
	}
}
add_action( 'init', 'supernews_page_sidebar_plugin' );

/**
 * Filter the posts on category page.
 * Split the featured posts and the standard posts.
 * 
 * @since  1.0.0
 */
function supernews_category_posts_filter( $query ) {

	$tag = of_get_option( 'supernews_featured_tag' );

	if ( $tag !== '' ) {

		if ( ! is_admin() && $query->is_main_query() ) {
			if ( $query->is_category() ) {
				$query->set( 'tag__not_in', $tag );
			}
		}

	}

}
add_action( 'pre_get_posts', 'supernews_category_posts_filter' );

/**
 * Register custom contact info fields.
 *
 * @since  1.0.0
 * @param  array $contactmethods
 * @return array
 */
function supernews_contact_info_fields( $contactmethods ) {
	$contactmethods['twitter']   = __( 'Twitter URL', 'supernews' );
	$contactmethods['facebook']  = __( 'Facebook URL', 'supernews' );
	$contactmethods['gplus']     = __( 'Google Plus URL', 'supernews' );
	$contactmethods['linkedin']  = __( 'LinkedIn URL', 'supernews' );

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'supernews_contact_info_fields' );