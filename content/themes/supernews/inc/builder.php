<?php
/**
 * Page builder custom functions.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Setup the mobile width number for the page buidler.
 *
 * @since  1.0.0
 * @param  array $settings
 * @return array
 */
function supernews_mobile_width_page_builder( $settings ) {
	$settings['mobile-width'] = 760;
	return $settings;
}
add_filter( 'siteorigin_panels_settings_defaults', 'supernews_mobile_width_page_builder', 5 );

/**
 * Custom widgets for page builder.
 * 
 * @since  1.0.0
 */
function supernews_builder_init() {

	// Register ad builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/ads.php';
	register_widget( 'SuperNews_Ads_Builder' );

	// Register slider builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/slider.php';
	register_widget( 'SuperNews_Slider_Builder' );

	// Register headlines builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/headlines.php';
	register_widget( 'SuperNews_Headlines_Builder' );

	// Register posts list builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/posts-varian-1.php';
	register_widget( 'SuperNews_Posts_Varian1_Builder' );

	// Register posts list builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/posts-varian-2.php';
	register_widget( 'SuperNews_Posts_Varian2_Builder' );

	// Register posts list builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/posts-varian-3.php';
	register_widget( 'SuperNews_Posts_Varian3_Builder' );

	// Register posts list builder.
	require trailingslashit( get_template_directory() ) . 'inc/builder/posts-varian-4.php';
	register_widget( 'SuperNews_Posts_Varian4_Builder' );

}
add_action( 'widgets_init', 'supernews_builder_init' );

/**
 * Prebuilt builder.
 *
 * @since  1.0.0
 */
function supernews_prebuilt_builder( $layouts ) {

	$layouts['default-home'] = array(
		'name'        => __( 'Prebuilt Home Page', 'supernews' ),
		'description' => __( 'Default home page builder.', 'supernews' ),
		'widgets'     => array(
			0 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Headlines_Builder',
					'id'    => '1',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			1 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Slider_Builder',
					'id'    => '2',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			2 => array(
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian1_Builder',
					'id'    => '3',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			3 => array(
				'ad_code' => '',
				'info'    => array(
					'class' => 'SuperNews_Ads_Builder',
					'id'    => '4',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			4 => array(
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian2_Builder',
					'id'    => '5',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			5 => array(
				'ad_code' => '',
				'info'    => array(
					'class' => 'SuperNews_Ads_Builder',
					'id'    => '6',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			6 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian3_Builder',
					'id'    => '7',
					'grid'  => '1',
					'cell'  => '0',
				),
			),
			7 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian3_Builder',
					'id'    => '8',
					'grid'  => '1',
					'cell'  => '1',
				),
			),
			8 => array(
				'ad_code' => '',
				'info'    => array(
					'class' => 'SuperNews_Ads_Builder',
					'id'    => '9',
					'grid'  => '2',
					'cell'  => '0',
				),
			),
			9 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian4_Builder',
					'id'    => '10',
					'grid'  => '3',
					'cell'  => '0',
				),
			),
			10 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian4_Builder',
					'id'    => '11',
					'grid'  => '3',
					'cell'  => '1',
				),
			),
			11 => array(
				'num'  => 5,
				'cat'  => 1,
				'info' => array(
					'class' => 'SuperNews_Posts_Varian4_Builder',
					'id'    => '12',
					'grid'  => '3',
					'cell'  => '2',
				),
			),
		),
		'grids' => array(
			0 => array(
				'cells' => '1',
				'style' => '',
			),
			1 => array(
				'cells' => '2',
				'style' => '',
			),
			2 => array(
				'cells' => '1',
				'style' => '',
			),
			3 => array(
				'cells' => '3',
				'style' => '',
			),
		),
		'grid_cells' => array(
			0 => array(
				'weight' => '1',
				'grid'   => '0',
			),
			1 => array(
				'weight' => '0.5',
				'grid'   => '1',
			),
			2 => array(
				'weight' => '0.5',
				'grid'   => '1',
			),
			3 => array(
				'weight' => '1',
				'grid'   => '2',
			),
			4 => array(
				'weight' => '0.3333333333333333',
				'grid'   => '3',
			),
			5 => array(
				'weight' => '0.3333333333333333',
				'grid'   => '3',
			),
			6 => array(
				'weight' => '0.3333333333333333',
				'grid'   => '3',
			),
		),
	);

	return $layouts;

}
add_filter( 'siteorigin_panels_prebuilt_layouts', 'supernews_prebuilt_builder' );