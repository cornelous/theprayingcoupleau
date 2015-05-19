<?php
/**
 * Custom taxonomies custom fields.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( is_admin() ) {

	/* 
	 * Configure your meta box.
	 */
	$config = array(
		'id'             => 'supernews_cat_metabox',
		'title'          => __( 'SuperNews Category Metabox', 'supernews' ),
		'pages'          => array( 'category' ),
		'context'        => 'normal',
		'fields'         => array(),
		'local_images'   => false,
		'use_with_theme' => get_template_directory_uri() . '/admin/taxonomy'
	);

	/*
	 * Initiate your meta box.
	 */
	$my_meta =  new Tax_Meta_Class( $config );

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	$tags[''] = __( 'All Tags', 'supernews' );
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}

	/**
	 * Taxonomy field.
	 */
	$my_meta->addSelect( 'supernews_cat_layout',
		array( 
			'standard' => __( 'Standard', 'supernews' ),
			'classic'  => __( 'Classic', 'supernews' ),
			'grid_1'   => __( 'Grid Version 1', 'supernews' ),
			'grid_2'   => __( 'Grid Version 2', 'supernews' ),
		),
		array( 'name'=> __( 'Category Layout Style', 'supernews' ), 'std' => array( 'standard' ) )
	);

	$my_meta->addSelect( 'supernews_featured_tag',
		$tags,
		array( 'name'=> __( 'Featured Posts Tag', 'supernews' ) )
	);

	$my_meta->addSelect( 'supernews_featured_layout',
		array( 
			'classic' => __( 'Classic', 'supernews' ),
			'slider'  => __( 'Slider', 'supernews' ),
		),
		array( 'name'=> __( 'Featured Posts Style', 'supernews' ), 'std' => array( 'classic' ) )
	);

	/**
	 * Finish.
	 */
	$my_meta->Finish();

}