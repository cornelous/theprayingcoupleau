<?php
/**
 * Tabbed widget.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class SuperNews_Tabs_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-supernews-tabs widget_tabs posts-thumbnail-widget',
			'description' => __( 'Display popular posts, recent posts, recent comments and tags in tabs.', 'supernews' )
		);

		// Create the widget.
		$this->WP_Widget(
			'supernews-tabs',                  // $this->id_base
			__( '&raquo; Tabs', 'supernews' ), // $this->name
			$widget_options                    // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;
		?>
		
		<ul class="tabs-nav">
			<li class="active"><a href="#tab1" title="<?php esc_attr_e( 'Popular', 'supernews' ); ?>"><i class="fa fa-star"></i></a></li>
			<li><a href="#tab2" title="<?php esc_attr_e( 'Latest', 'supernews' ); ?>"><i class="fa fa-clock-o"></i></a></li>
			<li><a href="#tab3" title="<?php esc_attr_e( 'Comments', 'supernews' ); ?>"><i class="fa fa-comments"></i></a></li>        
			<li><a href="#tab4" title="<?php esc_attr_e( 'Tags', 'supernews' ); ?>"><i class="fa fa-tags"></i></a></li>
		</ul>

		<div class="tabs-container">
			<div class="tab-content" id="tab1">
				<?php echo supernews_popular_posts( (int) $instance['popular_num'] ); ?>
			</div>

			<div class="tab-content" id="tab2">
				<?php echo supernews_latest_posts( (int) $instance['recent_num'] ); ?>
			</div>

			<div class="tab-content" id="tab3">
				<?php $comments = get_comments( array( 'number' => (int) $instance['comments_num'], 'status' => 'approve', 'post_status' => 'publish' ) ); ?>
				<?php if ( $comments ) : ?>
					<ul>
						<?php foreach( $comments as $comment ) : ?>
							<li class="clearfix">
								<a href="<?php echo get_comment_link( $comment->comment_ID ) ?>"><span class="entry-thumbnail"><?php echo get_avatar( $comment->comment_author_email, '63' ); ?></span></a>
								<a href="<?php echo get_comment_link( $comment->comment_ID ) ?>"><strong><?php echo $comment->comment_author; ?></strong><span><?php echo wp_html_excerpt( $comment->comment_content, '80' ); ?></span></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="tab-content" id="tab4">
				<?php wp_tag_cloud(); ?>
			</div>
		</div>

		<?php
		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['popular_num']  = absint( $new_instance['popular_num'] );
		$instance['recent_num']   = absint( $new_instance['recent_num'] );
		$instance['comments_num'] = absint( $new_instance['comments_num'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'popular_num'  => 5,
			'recent_num'   => 5,
			'comments_num' => 5
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'popular_num' ); ?>">
				<?php _e( 'Number of Popular Posts', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'popular_num' ); ?>" name="<?php echo $this->get_field_name( 'popular_num' ); ?>" value="<?php echo absint( $instance['popular_num'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'recent_num' ); ?>">
				<?php _e( 'Number of Recent Posts', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'recent_num' ); ?>" name="<?php echo $this->get_field_name( 'recent_num' ); ?>" value="<?php echo absint( $instance['recent_num'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'comments_num' ); ?>">
				<?php _e( 'Number of Recent Comments', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'comments_num' ); ?>" name="<?php echo $this->get_field_name( 'comments_num' ); ?>" value="<?php echo esc_attr( $instance['comments_num'] ); ?>" />
		</p>

	<?php

	}

}

/**
 * Popular Posts by comment
 *
 * @since 1.0.0
 */
function supernews_popular_posts( $number = 5 ) {

	// Posts query arguments.
	$args = array(
		'posts_per_page' => $number,
		'orderby'        => 'comment_count',
		'post_type'      => 'post'
	);

	// The post query
	$popular = get_posts( $args );

	global $post;

	if ( $popular ) {
		$html = '<ul>';

			foreach ( $popular as $post ) :
				setup_postdata( $post );

				$html .= '<li class="clearfix">';
					$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'supernews-widget-thumb', array( 'class' => 'entry-thumb', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
					$html .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a></h2>';
					$html .= '<div class="entry-meta">' . get_the_date() . '</div>';
				$html .= '</li>';

			endforeach;

		$html .= '</ul>';
	}

	// Reset the query.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		return $html;
	}

}

/**
 * Recent Posts
 *
 * @since 1.0.0
 */
function supernews_latest_posts( $number = 5 ) {

	// Posts query arguments.
	$args = array(
		'posts_per_page' => $number,
		'post_type'      => 'post',
	);

	// The post query
	$recent = get_posts( $args );

	global $post;

	if ( $recent ) {
		$html = '<ul>';

			foreach ( $recent as $post ) :
				setup_postdata( $post );

				$html .= '<li class="clearfix">';
					$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'supernews-widget-thumb', array( 'class' => 'entry-thumb', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
					$html .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a></h2>';
					$html .= '<div class="entry-meta">' . get_the_date() . '</div>';
				$html .= '</li>';

			endforeach;

		$html .= '</ul>';
	}

	// Reset the query.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		return $html;
	}

}