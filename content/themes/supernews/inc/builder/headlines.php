<?php
/**
 * Slider builder.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class SuperNews_Headlines_Builder extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'     => 'builder-supernews-headlines',
			'description'   => __( 'Display posts list as headlines.', 'supernews' ),
			'panels_groups' => array( 'panels' ),
		);

		// Create the widget.
		$this->WP_Widget(
			'supernews-builder-headlines',            // $this->id_base
			__( 'Builder - Headlines', 'supernews' ), // $this->name
			$widget_options                           // $this->widget_options
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

			// Posts query arguments.
			$args = array(
				'posts_per_page' => (int) $instance['num'],
				'post_type'      => 'post',
			);

			// Limit to category based on user selected tag.
			if ( ! empty( $instance['cat'] ) ) {
				$args['cat'] = (int) $instance['cat'];
			}

			// Allow dev to filter the post arguments.
			$query = apply_filters( 'supernews_headlines_builder', $args );

			// The post query.
			$posts = new WP_Query( $query );

			if ( $posts->have_posts() ) : ?>
				<div id="news-ticker" class="clearfix">
					<span class="text"><?php _e( 'Headlines', 'supernews' ); ?></span>
					<ul class="news-list">
						<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
							<li class="news-item">
								<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?><?php printf( __( ' - %s ago', 'supernews' ), human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ) ); ?>
							</li>
						<?php endwhile; ?>
					</ul>
					<span class="headline-nav">
						<a class="headline-prev" href="#"><i class="fa fa-angle-left"></i></a>
						<a class="headline-next" href="#"><i class="fa fa-angle-right"></i></a>
					</span><!-- headline-nav -->
				</div>
			<?php endif;

			// Restore original Post Data.
			wp_reset_postdata();

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
		$instance['num'] = (int)( $new_instance['num'] );
		$instance['cat'] = $new_instance['cat'];

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
			'num' => 5,
			'cat' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>">
				<?php _e( 'Number of posts to show', 'supernews' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="number" step="1" min="-1" value="<?php echo (int)( $instance['num'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Choose Category:', 'supernews' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

	<?php

	}

}