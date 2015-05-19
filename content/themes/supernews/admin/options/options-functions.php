<?php
/**
 * Custom functions for the theme settings.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Custom helper to display default value from Theme Options
 *
 * @since  1.0.0
 */
function of_get_default( $option ) {
	$defaults = optionsframework_options();
	if ( isset( $defaults[$option]['std'] ) ) {
		return $defaults[$option]['std'];
	}
	return false; // default if no std is set
}

/**
 * Allowed embed, script and meta in textarea.
 *
 * @since  1.0.0
 */
function supernews_change_santiziation() {
	remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
	add_filter( 'of_sanitize_textarea', 'supernews_sanitize_textarea' );
}
add_action( 'admin_init', 'supernews_change_santiziation', 100 );

/**
 * Custom sanitization for textarea
 *
 * @since  1.0.0
 * @param  array  $input
 * @return array
 */
function supernews_sanitize_textarea( $input ) {
	$output = stripslashes( $input );
	return $output;
}

/** 
 * Loads an additional CSS file for the options panel.
 *
 * @since  1.0.0
 */
if ( is_admin() ) {
	$of_page= 'appearance_page_options-framework';
	add_action( "admin_print_styles-$of_page", 'supernews_optionsframework_custom_css', 100 );
}
function supernews_optionsframework_custom_css () {
	wp_enqueue_style( 'supernews-options-framework-css', trailingslashit( get_stylesheet_directory_uri() ) .'admin/options/css/op-custom.css' );
}

/** 
 * This function adds the html that will appear in the sidebar module of the
 * options panel.
 *
 * @since  1.0.0
 */
function supernews_settings_sidebar() { ?>

	<div id="optionsframework-sidebar">
		<div class="metabox-holder">

			<div class="postbox">
				<h3><?php _e( 'Follow Us!', 'supernews' ); ?></h3>
				<div class="inside">
					<span class="tjsocial">
						<a href="https://twitter.com/theme_junkie" class="twitter-follow-button" data-show-count="false">Follow @theme_junkie</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</span>
					<span class="tjsocial">
						<div class="fb-like" data-href="https://www.facebook.com/themejunkies" data-width="50" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
					</span>
				</div>
			</div>

			<div class="postbox">
				<h3><?php _e( 'Useful Links', 'supernews' ); ?></h3>
				<div class="inside">
					<ul class="ul-disc">
						<li><a href="http://docs.theme-junkie.com/supernews/" target="_blank"><?php _e( 'Documentation', 'supernews' ) ?></a></li>
						<li><a href="http://www.theme-junkie.com/forum/" target="_blank"><?php _e( 'Support Forum', 'supernews' ) ?></a></li>
						<li><a href="http://www.theme-junkie.com/affiliates/" target="_blank"><?php _e( 'Affiliate Program', 'supernews' ) ?></a></li>
						<li><a href="http://feeds.feedburner.com/ThemeJunkie" target="_blank"><?php _e( 'Subscribe to Our Blog', 'supernews' ) ?></a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>

<?php }
add_action( 'optionsframework_after', 'supernews_settings_sidebar' );

/**
 * Favicon output.
 *
 * @since 1.0.0
 */
function supernews_favicon_output() {
	$favicon = of_get_option( 'supernews_favicon' );

	if ( !empty( $favicon ) ) {
		echo '<link href="' . esc_url( $favicon ) . '" rel="icon">' . "\n";
	}

}
add_action( 'wp_head', 'supernews_favicon_output', 5 );

/**
 * Mobile Icon output.
 *
 * @since 1.0.0
 */
function supernews_mobile_icon_output() {
	$icon = of_get_option( 'supernews_mobile_icon' );

	if ( !empty( $icon ) ) {
		echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( $icon ) . '">' . "\n";
	}

}
add_action( 'wp_head', 'supernews_mobile_icon_output', 6 );

/**
 * Single post advertisement.
 * Before content.
 *
 * @since  1.0.0
 */
function supernews_single_ad_before( $content ) {
	$ad = of_get_option( 'supernews_ad_single_before' );

	if ( is_single() ) {
		$content = $ad . $content;
	} else {
		$content;
	}

	return $content;

}
add_action( 'the_content', 'supernews_single_ad_before' );

/**
 * Single post advertisement.
 * After content.
 *
 * @since  1.0.0
 */
function supernews_single_ad_after( $content ) {
	$ad = of_get_option( 'supernews_ad_single_after' );

	if ( is_single() ) {
		$content = $content . $ad;
	} else {
		$content;
	}

	return $content;

}
add_action( 'the_content', 'supernews_single_ad_after' );

/**
 * Header Code
 *
 * @since  1.0.0
 */
function supernews_header_code() {
	$header_code = of_get_option( 'supernews_script_head' );

	if ( !empty( $header_code ) ) {
		echo stripslashes( $header_code ) . "\n";
	}

}
add_action( 'wp_head', 'supernews_header_code', 20 );

/**
 * Footer Code
 *
 * @since  1.0.0
 */
function supernews_footer_code() {
	$footer_code = of_get_option( 'supernews_script_footer' );

	if ( !empty( $footer_code ) ) {
		echo stripslashes( $footer_code ) . "\n";
	}

}
add_action( 'wp_footer', 'supernews_footer_code', 20 );