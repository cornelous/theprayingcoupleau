<?php
/**
 * SuperNews Theme Customizer.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Load textarea control for the customizer.
 *
 * @since  1.0.0
 */
function supernews_textarea_customize_control() {
	require trailingslashit( get_template_directory() ) . 'inc/classes/customize-control-textarea.php';
}
add_action( 'customize_register', 'supernews_textarea_customize_control', 1 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function supernews_customize_preview_js() {
	wp_enqueue_script( 'supernews_customizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'supernews_customize_preview_js' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function supernews_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	// Get the theme settings value.
	$options = optionsframework_options();

	// ==== Logo Setting ==== //
	$wp_customize->add_section(
		'supernews_logo_section',
		array(
			'title'       => esc_html__( 'Logo', 'supernews' ),
			'description' => __( 'If you use logo, the title and tagline will be replaced with the logo you uploaded.', 'supernews' ),
			'priority'    => 25,
		)
	);

		$wp_customize->add_setting(
			'supernews[supernews_logo]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'supernews_logo_control',
				array(
					'label'    => $options['supernews_logo']['name'],
					'section'  => 'supernews_logo_section',
					'settings' => 'supernews[supernews_logo]'
				)
			) );

		$wp_customize->add_setting(
			'supernews[supernews_logo_retina]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'supernews_logo_retina_control',
				array(
					'label'    => $options['supernews_logo_retina']['name'],
					'section'  => 'supernews_logo_section',
					'settings' => 'supernews[supernews_logo_retina]'
				)
			) );

	// ==== Favicon Setting ==== //
	$wp_customize->add_section(
		'supernews_favicon_settings',
		array(
			'title'       => esc_html__( 'Favicon', 'supernews' ),
			'description' => $options['supernews_favicon']['desc'],
			'priority'    => 28,
		)
	);

		$wp_customize->add_setting(
			'supernews[supernews_favicon]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'supernews_favicon_control',
				array(
					'label'    => $options['supernews_favicon']['name'],
					'section'  => 'supernews_favicon_settings',
					'settings' => 'supernews[supernews_favicon]'
				)
			) );

		$wp_customize->add_setting(
			'supernews[supernews_mobile_icon]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'supernews_mobile_icon_control',
				array(
					'label'    => $options['supernews_mobile_icon']['name'],
					'section'  => 'supernews_favicon_settings',
					'settings' => 'supernews[supernews_mobile_icon]'
				)
			) );

	// ==== Single Post Setting ==== //
	$wp_customize->add_section(
		'supernews_post_setting',
		array(
			'title'    => esc_html__( 'Single Post', 'supernews' ),
			'priority' => 190,
		)
	);

		$wp_customize->add_setting(
			'supernews[supernews_post_author]',
			array(
				'default'           => $options['supernews_post_author']['std'],
				'type'              => 'option',
				'sanitize_callback' => 'supernews_sanitize_checkbox'
			)
		);

			$wp_customize->add_control(
				'gomedia_post_author_enable',
				array(
					'label'    => $options['supernews_post_author']['name'],
					'type'     => 'checkbox',
					'section'  => 'supernews_post_setting',
					'settings' => 'supernews[supernews_post_author]',
					'priority' => 1
				)
			);

		$wp_customize->add_setting(
			'supernews[supernews_post_share]',
			array(
				'default'           => $options['supernews_post_share']['std'],
				'type'              => 'option',
				'sanitize_callback' => 'supernews_sanitize_checkbox'
			)
		);

			$wp_customize->add_control(
				'gomedia_post_share_enable',
				array(
					'label'    => $options['supernews_post_share']['name'],
					'type'     => 'checkbox',
					'section'  => 'supernews_post_setting',
					'settings' => 'supernews[supernews_post_share]',
					'priority' => 1
				)
			);

		$wp_customize->add_setting(
			'supernews[supernews_related_posts]',
			array(
				'default'           => $options['supernews_related_posts']['std'],
				'type'              => 'option',
				'sanitize_callback' => 'supernews_sanitize_checkbox'
			)
		);

			$wp_customize->add_control(
				'gomedia_related_enable',
				array(
					'label'    => $options['supernews_related_posts']['name'],
					'type'     => 'checkbox',
					'section'  => 'supernews_post_setting',
					'settings' => 'supernews[supernews_related_posts]',
					'priority' => 1
				)
			);

		$wp_customize->add_setting(
			'supernews[supernews_newsletter]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new SuperNews_Customize_Control_Textarea( $wp_customize, 'supernews_newsletter_control',
				array(
					'label'    => $options['supernews_newsletter']['name'],
					'section'  => 'supernews_post_setting',
					'settings' => 'supernews[supernews_newsletter]'
				)
			) );

		$wp_customize->add_setting(
			'supernews[supernews_ad_single_before]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new SuperNews_Customize_Control_Textarea( $wp_customize, 'supernews_ad_before_control',
				array(
					'label'    => $options['supernews_ad_single_before']['name'],
					'section'  => 'supernews_post_setting',
					'settings' => 'supernews[supernews_ad_single_before]'
				)
			) );

		$wp_customize->add_setting(
			'supernews[supernews_ad_single_after]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new SuperNews_Customize_Control_Textarea( $wp_customize, 'supernews_ad_after_control',
				array(
					'label'    => $options['supernews_ad_single_after']['name'],
					'section'  => 'supernews_post_setting',
					'settings' => 'supernews[supernews_ad_single_after]'
				)
			) );

	// ==== Advertisement Setting ==== //
	$wp_customize->add_section(
		'supernews_ad_setting',
		array(
			'title'       => esc_html__( 'Advertisement', 'supernews' ),
			'priority'    => 195,
		)
	);

		$wp_customize->add_setting(
			'supernews[supernews_header_ads]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new SuperNews_Customize_Control_Textarea( $wp_customize, 'supernews_header_ads_control',
				array(
					'label'    => $options['supernews_header_ads']['name'],
					'section'  => 'supernews_ad_setting',
					'settings' => 'supernews[supernews_header_ads]'
				)
			) );

		$wp_customize->add_setting(
			'supernews[supernews_archive_ads]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new SuperNews_Customize_Control_Textarea( $wp_customize, 'supernews_archive_ads_control',
				array(
					'label'    => $options['supernews_archive_ads']['name'],
					'section'  => 'supernews_ad_setting',
					'settings' => 'supernews[supernews_archive_ads]'
				)
			) );

	// ==== Footer Text Setting ==== //
	$wp_customize->add_section(
		'supernews_footer_settings',
		array(
			'title'       => $options['supernews_footer_text']['name'],
			'description' => $options['supernews_footer_text']['desc'],
			'priority'    => 200,
		)
	);

		$wp_customize->add_setting(
			'supernews[supernews_footer_text]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_customizer_textarea'
			)
		);

			$wp_customize->add_control( 
				new SuperNews_Customize_Control_Textarea( $wp_customize, 'supernews_footer_control',
				array(
					'label'    => $options['supernews_footer_text']['name'],
					'section'  => 'supernews_footer_settings',
					'settings' => 'supernews[supernews_footer_text]'
				)
			) );

	// ==== Layout Setting ==== //
	$wp_customize->add_section(
		'supernews_archive_layout_settings',
		array(
			'title'       => esc_html__( 'Layout Archive', 'supernews' ),
			'description' => sprintf( __( 'There are several custom post layout for the archives page %1$s(date, year, author, etc)%2$s. You can set the category post layout on the %3$sedit category page%4$s.', 'supernews' ), '<strong>' , '</strong>', '<a href="' . esc_url( admin_url( 'edit-tags.php?taxonomy=category') ) . '">', '</a>' ),
			'priority'    => 31,
		)
	);

		$wp_customize->add_setting(
			'supernews[supernews_archive_layout]',
			array(
				'default'           => $options['supernews_archive_layout']['std'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_chooser'
			)
		);

			$wp_customize->add_control( 
				'supernews_archive_layout_control', 
				array(
					'label'    => __( 'Archive (format, date, month, year)', 'supernews' ),
					'section'  => 'supernews_archive_layout_settings',
					'settings' => 'supernews[supernews_archive_layout]',
					'type'     => $options['supernews_archive_layout']['type'],
					'choices'  => $options['supernews_archive_layout']['options'],
				) 
			);

		$wp_customize->add_setting(
			'supernews[supernews_tag_layout]',
			array(
				'default'           => $options['supernews_tag_layout']['std'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_chooser'
			)
		);

			$wp_customize->add_control( 
				'supernews_tag_layout_control', 
				array(
					'label'    => __( 'Tag', 'supernews' ),
					'section'  => 'supernews_archive_layout_settings',
					'settings' => 'supernews[supernews_tag_layout]',
					'type'     => $options['supernews_tag_layout']['type'],
					'choices'  => $options['supernews_tag_layout']['options'],
				) 
			);

		$wp_customize->add_setting(
			'supernews[supernews_author_layout]',
			array(
				'default'           => $options['supernews_author_layout']['std'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_chooser'
			)
		);

			$wp_customize->add_control( 
				'supernews_author_layout_control', 
				array(
					'label'    => __( 'Author', 'supernews' ),
					'section'  => 'supernews_archive_layout_settings',
					'settings' => 'supernews[supernews_author_layout]',
					'type'     => $options['supernews_author_layout']['type'],
					'choices'  => $options['supernews_author_layout']['options'],
				) 
			);

		$wp_customize->add_setting(
			'supernews[supernews_search_layout]',
			array(
				'default'           => $options['supernews_search_layout']['std'],
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'supernews_sanitize_chooser'
			)
		);

			$wp_customize->add_control( 
				'supernews_search_layout_control', 
				array(
					'label'    => __( 'Search', 'supernews' ),
					'section'  => 'supernews_archive_layout_settings',
					'settings' => 'supernews[supernews_search_layout]',
					'type'     => $options['supernews_search_layout']['type'],
					'choices'  => $options['supernews_search_layout']['options'],
				) 
			);

}
add_action( 'customize_register', 'supernews_customize_register' );

if ( ! function_exists( 'supernews_sanitize_checkbox' ) ) :
/**
 * Sanitize a checkbox to only allow 0 or 1
 *
 * @since  1.0.0.
 *
 * @param  boolean    $value    The unsanitized value.
 * @return boolean				The sanitized boolean.
 */
function supernews_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
	} else {
		return 0;
	}
}
endif;

if ( ! function_exists( 'supernews_sanitize_chooser' ) ) :
/**
 * Sanitize chooser.
 *
 * @since  1.0.1
 */
function supernews_sanitize_chooser( $input ) {
	global $wp_customize;
 
	$control = $wp_customize->get_control( $setting->id );
 
	if ( array_key_exists( $input, $control->choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}
endif;

if ( ! function_exists( 'supernews_sanitize_customizer_textarea' ) ) :
/**
 * Sanitize chooser.
 *
 * @since  1.0.1
 */
function supernews_sanitize_customizer_textarea( $string ) {
	return stripslashes( $string );
}
endif;