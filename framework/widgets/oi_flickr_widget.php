<?php	 		 	
/*
-----------------------------------------------------------------------------------

 	Plugin Name: Flickr Widget For Sidebar/Footer
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your projects from flickr.com
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'OrangeIdea_load_flickr_widgets');

function OrangeIdea_load_flickr_widgets()
{
	register_widget('OrangeIdea_Flickr_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class OrangeIdea_Flickr_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function OrangeIdea_Flickr_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'OrangeIdea_flickr_widget', 'description' => __( 'OrangeIdea: Flickr Widget', 'orangeidea' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'OrangeIdea_flickr_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'OrangeIdea_flickr_widget', 'OrangeIdea: Flickr Widget ', $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$user_id = $instance['user_id'];
	$background = '';

	// Before widget (defined by theme functions file)
	echo $before_widget;
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>

<script type="text/javascript">
/***************************************************
					Flickr
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {
	
	$('#cbox').jflickrfeed({
		limit: <?php echo $instance['num_images']; ?>,
		qstrings: {
			id: "<?php echo $instance['user_id']; ?>"
		},
		itemTemplate: '<div class="oi_flickr_item">'+
						'<a rel="prettyPhoto[flickr]" href="{{image_b}}" title="{{title}}">' +
							'<img class="img-responsive" src="{{image_m}}"/>' +
						'</a>' +
					  '</div>'
	}, function(data) {
		$('#cbox a').prettyPhoto({opacity:0.80,default_width:200,default_height:344,hideflash:false,modal:false,social_tools:false});
	});


});
});
</script>		

			<div id="cbox"></div>
            <div class="clearfix"></div>

	
	<?php	 		 	

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['user_id'] = stripslashes( $new_instance['user_id']);
	$instance['num_images'] = stripslashes( $new_instance['num_images']);	
	$instance['background'] = strip_tags($new_instance['background']);

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Flickr' , 'orangeidea' ) , 'user_id' => '52617155@N08', 'num_images' => '9' );
	
	$instance = wp_parse_args( (array) $instance, $defaults );
	$background = esc_attr($instance['background']); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	
	<!-- User ID From Flickr: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('User ID:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_id'] ), ENT_QUOTES)); ?>" />
	</p>

	<!-- Number of Images: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'num_images' ); ?>"><?php _e('The Number of Displayed Images:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'num_images' ); ?>" name="<?php echo $this->get_field_name( 'num_images' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['num_images'] ), ENT_QUOTES)); ?>" />
	</p>

	<?php	 		 	
	}
}
?>