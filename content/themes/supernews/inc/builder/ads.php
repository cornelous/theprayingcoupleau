<?php
/**
 * Ads builder.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class SuperNews_Ads_Builder extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'     => 'builder-supernews-ad',
			'description'   => __( 'Easily to display any type of ad. Recommended size is 768x90', 'supernews' ),
			'panels_groups' => array( 'panels' ),
		);

		// Create the widget.
		$this->WP_Widget(
			'supernews-builder-ads',                      // $this->id_base
			__( 'Builder - Advertisement', 'supernews' ), // $this->name
			$widget_options                               // $this->widget_options
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

		// Display the ad banner.
		if ( $instance['ad_code'] ) {
			echo '<div class="content-ad">' . stripslashes( $instance['ad_code'] ) . '</div>';
		}

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
		$instance['ad_code'] = stripslashes( $new_instance['ad_code'] );

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
			'ad_code' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code' ); ?>">
				<?php _e( 'Ad Code:', 'supernews' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'ad_code' ); ?>" id="<?php echo $this->get_field_id( 'ad_code' ); ?>" cols="30" rows="6"><?php echo stripslashes( $instance['ad_code'] ); ?></textarea>
		</p>

	<?php

	}

}