<?php
/**
 * Custom filter, hooks and functions to support WooCommerce
 * 
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

global $woo_options;

// Indicate that this theme support WooCommerce.
add_theme_support( 'woocommerce' );

// Remove WooCommerce default styles.
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumbs.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove rating on product page.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * Archive layout.
 *
 * @since  1.0.0
 */
function supernews_woo_layout( $layout ) {

	$option = of_get_option( 'supernews_woo_archive_layout', 'fullwidth' );

	if ( is_shop() ) {
		if ( 'fullwidth' === $option ) {
			$layout = '1c';
		} elseif ( 'sidebar' === $option ) {
			$layout = 'narrow';
		}
	}

	return $layout;

}
add_filter( 'theme_mod_theme_layout', 'supernews_woo_layout', 15 );

/**
 * WooCommerce page layout.
 *
 * @since  1.0.0
 */
function supernews_woo_pages_layout( $theme_layout ) {

	if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {

		$layout = get_post_layout( get_queried_object_id() );
		$args   = theme_layouts_get_args();

		// Set the default product page to fullwidth layout.
		$args['default'] = '1c';
		$theme_layout    = $args['default'];

		if ( 'default' !== $layout ) {
			$theme_layout = $layout;
		}

	}

	return $theme_layout;

}
add_filter( 'theme_mod_theme_layout', 'supernews_woo_pages_layout', 15 );

/**
 * Define image sizes on theme activation.
 *
 * @since  1.0.0
 */
function storepro_woocommerce_image_sizes() {

	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

		$catalog = array(
			'width'  => '236',
			'height' => '236',
			'crop'   => 1
		);

		$single = array(
			'width'  => '514',
			'height' => '514',
			'crop'   => 1
		);

		$thumbnail = array(
			'width'  => '127',
			'height' => '127',
			'crop'   => 1
		);

		// Product thumbnail size.
		update_option( 'shop_catalog_image_size', $catalog );

		// Single product image size.
		update_option( 'shop_single_image_size', $single );

		// Image gallery thumbnail size.
		update_option( 'shop_thumbnail_image_size', $thumbnail );

	}

}
add_action( 'init', 'storepro_woocommerce_image_sizes', 1 );