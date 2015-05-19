<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page 
 * and be saved in the database.
 *
 * @since  1.0.0
 * @access public
 */
function optionsframework_options() {

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	$tags[''] = __( 'All Tags', 'supernews' );
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}

	$options = array();

	$options[] = array(
		'name' => __( 'General', 'supernews' ),
		'type' => 'heading'
	);

	$options['supernews_logo'] = array(
		'name' => __( 'Logo', 'supernews' ),
		'desc' => __( 'Upload your custom logo, it will automatically replace the Site Title', 'supernews' ),
		'id'   => 'supernews_logo',
		'type' => 'upload'
	);

	$options['supernews_logo_retina'] = array(
		'name' => __( 'Retina Logo', 'supernews' ),
		'desc' => __( 'Upload your retina version of your logo. eg: logo@2x.png', 'supernews' ),
		'id'   => 'supernews_logo_retina',
		'type' => 'upload'
	);

	$options['supernews_favicon'] = array(
		'name' => __( 'Favicon', 'supernews' ),
		'desc' => __( 'Your custom favicon. 32x32px recommended.', 'supernews' ),
		'id'   => 'supernews_favicon',
		'type' => 'upload'
	);

	$options['supernews_mobile_icon'] = array(
		'name' => __( 'Mobile Icon', 'supernews' ),
		'desc' => __( '144x144 recommended in PNG format. This icon will be used when users add your website as a shortcut on mobile devices like iPhone, iPad, Android etc.', 'supernews' ),
		'id'   => 'supernews_mobile_icon',
		'type' => 'upload'
	);

	$options[] = array(
		'name'  => __( 'FeedBurner URL', 'supernews' ),
		'desc'  => __( 'Enter your full FeedBurner URL. If you wish to use FeedBurner over the standard WordPress feed.', 'supernews' ),
		'id'    => 'supernews_feedburner_url',
		'placeholder' => 'http://feeds.feedburner.com/ThemeJunkie',
		'type'  => 'text'
	);

	$options['supernews_footer_text'] = array(
		'name' => __( 'Footer Text', 'supernews' ),
		'desc' => __( 'Customize the footer text.', 'supernews' ),
		'id'   => 'supernews_footer_text',
		'std'  => '&copy; Copyright ' . date( 'Y' ) . ' <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> &middot; Designed by <a href="http://www.theme-junkie.com/">Theme Junkie</a>',
		'type' => 'editor'
	);

	$options[] = array(
		'name' => __( 'Archive', 'supernews' ),
		'type' => 'heading'
	);

	$options['supernews_archive_layout'] = array(
		'name'   => __( 'Archive Page Layout', 'supernews' ),
		'desc'   => sprintf( __( 'Choose the archive %1$s(post format, date, month, year)%2$s page layout.', 'supernews' ), '<strong>', '</strong>' ),
		'id'     => 'supernews_archive_layout',
		'std'    => 'standard',
		'type'   => 'select',
		'options' => array(
			'standard' => __( 'Standard', 'supernews' ),
			'classic'  => __( 'Classic', 'supernews' ),
			'grid_1'   => __( 'Grid Version 1', 'supernews' ),
			'grid_2'   => __( 'Grid Version 2', 'supernews' ),
		)
	);

	$options['supernews_tag_layout'] = array(
		'name'   => __( 'Tag Page Layout', 'supernews' ),
		'desc'   => __( 'Choose the tag page layout.', 'supernews' ),
		'id'     => 'supernews_tag_layout',
		'std'    => 'standard',
		'type'   => 'select',
		'options' => array(
			'standard' => __( 'Standard', 'supernews' ),
			'classic'  => __( 'Classic', 'supernews' ),
			'grid_1'   => __( 'Grid Version 1', 'supernews' ),
			'grid_2'   => __( 'Grid Version 2', 'supernews' ),
		)
	);

	$options['supernews_author_layout'] = array(
		'name'   => __( 'Author Page Layout', 'supernews' ),
		'desc'   => __( 'Choose the author page layout.', 'supernews' ),
		'id'     => 'supernews_author_layout',
		'std'    => 'standard',
		'type'   => 'select',
		'options' => array(
			'standard' => __( 'Standard', 'supernews' ),
			'classic'  => __( 'Classic', 'supernews' ),
			'grid_1'   => __( 'Grid Version 1', 'supernews' ),
			'grid_2'   => __( 'Grid Version 2', 'supernews' ),
		)
	);

	$options['supernews_search_layout'] = array(
		'name'   => __( 'Search Page Layout', 'supernews' ),
		'desc'   => __( 'Choose the search page layout.', 'supernews' ),
		'id'     => 'supernews_search_layout',
		'std'    => 'standard',
		'type'   => 'select',
		'options' => array(
			'standard' => __( 'Standard', 'supernews' ),
			'classic'  => __( 'Classic', 'supernews' ),
			'grid_1'   => __( 'Grid Version 1', 'supernews' ),
			'grid_2'   => __( 'Grid Version 2', 'supernews' ),
		)
	);

	$options[] = array(
		'name' => __( 'Single Post', 'supernews' ),
		'type' => 'heading'
	);

	$options['supernews_post_author'] = array(
		'name' => __( 'Display author info ', 'supernews' ),
		'desc' => __( 'Enable the author biographical info.', 'supernews' ),
		'id'   => 'supernews_post_author',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options['supernews_post_share'] = array(
		'name' => __( 'Display post share', 'supernews' ),
		'desc' => __( 'Enable the post share.', 'supernews' ),
		'id'   => 'supernews_post_share',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options['supernews_related_posts'] = array(
		'name' => __( 'Display related posts', 'supernews' ),
		'desc' => __( 'Enable the related posts.', 'supernews' ),
		'id'   => 'supernews_related_posts',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options['supernews_newsletter'] = array(
		'name' => __( 'Newsletter Form', 'supernews' ),
		'desc' => __( 'If you want to display a newsletter form on single post. Please add the form here.', 'supernews' ),
		'id'   => 'supernews_newsletter',
		'type' => 'textarea'
	);

	$options['supernews_ad_single_before'] = array(
		'name' => __( 'Before Content Advertisement', 'supernews' ),
		'desc' => __( 'Your ad will appear on single post before content.', 'supernews' ),
		'id'   => 'supernews_ad_single_before',
		'type' => 'textarea'
	);

	$options['supernews_ad_single_after'] = array(
		'name' => __( 'After Content Advertisement', 'supernews' ),
		'desc' => __( 'Your ad will appear on single post after content.', 'supernews' ),
		'id'   => 'supernews_ad_single_after',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Video', 'supernews' ),
		'type' => 'heading'
	);

	$options['supernews_latest_video'] = array(
		'name' => __( 'Display latest videos', 'supernews' ),
		'desc' => __( 'Enable the latest video post format on home page.', 'supernews' ),
		'id'   => 'supernews_latest_video',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options['supernews_latest_video_title'] = array(
		'name' => __( 'Title', 'supernews' ),
		'desc' => __( 'The title of the list of latest video.', 'supernews' ),
		'id'   => 'supernews_latest_video_title',
		'std'  => __( 'Must See Videos', 'supernews' ),
		'type' => 'text'
	);

	if ( class_exists( 'WooCommerce' ) ) { 

		$options[] = array(
			'name' => __( 'Shop', 'supernews' ),
			'type' => 'heading'
		);

		$options['supernews_woo_archive_layout'] = array(
			'name' => __( 'Shop Layouts', 'supernews' ),
			'desc' => __( 'Choose the layout for WooCommerce archive page.', 'supernews' ),
			'id'   => 'supernews_woo_archive_layout',
			'type' => 'radio',
			'std'  => 'fullwidth',
			'options' => array(
				'fullwidth' => __( 'Full Width', 'supernews' ),
				'sidebar'   => __( 'With Sidebar', 'supernews' )
			)
		);

	}

	$options[] = array(
		'name' => __( 'Advertisement', 'supernews' ),
		'type' => 'heading'
	);

	$options['supernews_header_ads'] = array(
		'name' => __( 'Header Advertisement', 'supernews' ),
		'desc' => __( 'The ad will appear at the top of your site. Recommended size 728x90', 'supernews' ),
		'id'   => 'supernews_header_ads',
		'type' => 'textarea'
	);

	$options['supernews_archive_ads'] = array(
		'name' => __( 'Archive Advertisement', 'supernews' ),
		'desc' => __( 'The ad will appear on archive page. Recommended size 728x90 - THEME SHARED ON W P L O C K E R .C O M', 'supernews' ),
		'id'   => 'supernews_archive_ads',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Custom Code', 'supernews' ),
		'type' => 'heading'
	);

	$options['supernews_script_head'] = array(
		'name' => __( 'Header code', 'supernews' ),
		'desc' => __( 'If you need to add custom scripts to your header (meta tag verification, google fonts url), you should enter them in the box. They will be added before &lt;/head&gt; tag', 'supernews' ),
		'id'   => 'supernews_script_head',
		'type' => 'textarea'
	);

	$options['supernews_script_footer'] = array(
		'name' => __( 'Footer code', 'supernews' ),
		'desc' => __( 'If you need to add custom scripts to your footer (like google analytic script), you should enter them in the box. They will be added before &lt;/body&gt; tag', 'supernews' ),
		'id'   => 'supernews_script_footer',
		'type' => 'textarea'
	);

	/* Return the theme settings data. */
	return $options;
}