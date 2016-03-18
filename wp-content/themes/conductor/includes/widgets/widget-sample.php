<?php
/**
 * widget.sample
 *
 * This defines the Sample widget.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

add_action( 'widgets_init', 'widget_sample_widget' );

if ( ! function_exists( 'widget_sample_widget' ) ) :
	function widget_sample_widget() {
		register_widget( 'widget_sample_widget' );
	}
endif;

class widget_sample_widget extends WP_Widget {
	
	function widget_sample_widget() {
		$widget_ops = array( 'classname' => 'widget-sample', 'description' => 'Displays a sample widget.' );
		$control_ops = array( 'width' => 300, 'height' => 650, 'id_base' => 'widget-sample' );
		$this->WP_Widget( 'widget-sample', 'Sample Widget', $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>Fill out the below fields to configure the Sample widget.</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'value1' ); ?>">Value 1:</label><br />
			<input id="<?php echo $this->get_field_id( 'value1' ); ?>" style="width: 250px;" name="<?php echo $this->get_field_name( 'value1' ); ?>" value="<?php echo $instance['value1']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'value2' ); ?>">Value 2:</label><br />
			<input id="<?php echo $this->get_field_id( 'value2' ); ?>" style="width: 250px;" name="<?php echo $this->get_field_name( 'value2' ); ?>" value="<?php echo $instance['value2']; ?>" class="widefat" />
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['value1'] = $new_instance['value1'];
		$instance['value2'] = $new_instance['value2'];
		return $instance;
	}


	function widget( $args, $instance ) {
		extract( $args );

		$value1 = $instance['value1'];
		$value2 = $instance['value2'];

		echo $before_widget; ?>

		<p>Hello.</p>
		
		<?php echo $after_widget;
	}

}
?>