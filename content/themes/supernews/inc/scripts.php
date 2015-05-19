<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function supernews_enqueue() {

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'supernews-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'supernews-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'supernews-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'supernews-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// If child theme is active, load the stylesheet.
		if ( is_child_theme() ) {
			wp_enqueue_style( 'supernews-child-style', get_stylesheet_uri() );
		}

		// Load custom js plugins.
		wp_enqueue_script( 'supernews-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/supernews.min.js', array( 'jquery' ), null, true );

	}

	// Load responsive stylesheet
	wp_enqueue_style( 'supernews-responsive', trailingslashit( get_template_directory_uri() ) . 'assets/css/responsive.css' );

	// Load skin stylesheet
	wp_enqueue_style( 'supernews-colors', trailingslashit( get_template_directory_uri() ) . 'assets/css/colors/default.css' );

	// Load retina.js.
	wp_enqueue_script( 'supernews-retina-js', trailingslashit( get_template_directory_uri() ) . 'assets/js/retina.js', array( 'jquery' ), null, true );

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'supernews_enqueue' );

/**
 * Loads HTML5 Shiv & Respond js file.
 * 
 * @since  1.0.0
 */
function supernews_special_scripts() {
?>
<!--[if lte IE 9]>
<script src="<?php echo trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.js'; ?>"></script>
<![endif]-->
<?php
}
add_action( 'wp_head', 'supernews_special_scripts', 15 );

/**
 * js / no-js script.
 *
 * @since  1.0.0
 */
function supernews_no_js_script() {
?>
<script>document.documentElement.className = 'js';</script>
<?php
}
add_action( 'wp_footer', 'supernews_no_js_script' );