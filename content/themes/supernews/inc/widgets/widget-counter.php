<?php
/**
 * Social Counter widget.
 *
 * @package    SuperNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class SuperNews_Counter_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-supernews-counter widget_social',
			'description' => __( 'Type manually your social followers counter.', 'supernews' ),
		);

		// Create the widget.
		$this->WP_Widget(
			'supernews-counter',                         // $this->id_base
			__( '&raquo; Social Counter', 'supernews' ), // $this->name
			$widget_options                              // $this->widget_options
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

			echo '<ul>';

				if ( $instance['twitter'] ) {
					echo '<li><a href="' . esc_url( $instance['twitter'] ) . '" title="Twitter"><i class="fa fa-twitter"></i><span><strong>' . (int) $instance['twitter_num'] . '</strong></span><span>' . __( 'Followers', 'supernews' ) . '</span></a></li>';
				}

				if ( $instance['facebook'] ) {
					echo '<li><a href="' . esc_url( $instance['facebook'] ) . '" title="Facebook"><i class="fa fa-facebook"></i><span><strong>' . (int) $instance['facebook_num'] . '</strong></span><span>' . __( 'Fans', 'supernews' ) . '</span></a></li>';
				}

				if ( $instance['gplus'] ) {
					echo '<li><a href="' . esc_url( $instance['gplus'] ) . '" title="GooglePlus"><i class="fa fa-google-plus"></i><span><strong>' . (int) $instance['gplus_num'] . '</strong></span><span>' . __( 'In Circle', 'supernews' ) . '</span></a></li>';
				}

				if ( $instance['rss'] ) {
					echo '<li><a href="' . esc_url( $instance['rss'] ) . '" title="RSS"><i class="fa fa-rss"></i><span><strong>' . (int) $instance['rss_num'] . '</strong></span><span>' . __( 'Subscriber', 'supernews' ) . '</span></a></li>';
				}

			echo '</ul>';

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

		$instance['twitter']      = esc_url( $new_instance['twitter'] );
		$instance['twitter_num']  = (int) $new_instance['twitter_num'];
		$instance['facebook']     = esc_url( $new_instance['facebook'] );
		$instance['facebook_num'] = (int) $new_instance['facebook_num'];
		$instance['gplus']        = esc_url( $new_instance['gplus'] );
		$instance['gplus_num']    = (int) $new_instance['gplus_num'];
		$instance['rss']          = esc_url( $new_instance['rss'] );
		$instance['rss_num']      = (int) $new_instance['rss_num'];

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
			'twitter'      => '',
			'twitter_num'  => '',
			'facebook'     => '',
			'facebook_num' => '',
			'gplus'        => '',
			'gplus_num'    => '',
			'rss'          => '',
			'rss_num'      => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
				<?php _e( 'Twitter URL', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_num' ); ?>">
				<?php _e( 'Twitter Followers Number', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter_num' ); ?>" name="<?php echo $this->get_field_name( 'twitter_num' ); ?>" value="<?php echo (int) $instance['twitter_num']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
				<?php _e( 'Facebook Fans URL', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_num' ); ?>">
				<?php _e( 'Facebook Fans Number', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook_num' ); ?>" name="<?php echo $this->get_field_name( 'facebook_num' ); ?>" value="<?php echo (int) $instance['facebook_num']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">
				<?php _e( 'Google Plus URL', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo esc_url( $instance['gplus'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'gplus_num' ); ?>">
				<?php _e( 'Google Plus Followers Number', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'gplus_num' ); ?>" name="<?php echo $this->get_field_name( 'gplus_num' ); ?>" value="<?php echo (int) $instance['gplus_num']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>">
				<?php _e( 'RSS URL', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo esc_url( $instance['rss'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss_num' ); ?>">
				<?php _e( 'RSS Subscriber Number', 'supernews' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'rss_num' ); ?>" name="<?php echo $this->get_field_name( 'rss_num' ); ?>" value="<?php echo (int) $instance['rss_num']; ?>" />
		</p>

	<?php

	}

}