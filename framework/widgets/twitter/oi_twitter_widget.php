<?php	 		 	
/*
-----------------------------------------------------------------------------------

 	Plugin Name: Twitter Widget For Sidebar/Footer
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your most commented post
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'OrangeIdea_load_twitter_widgets');

function OrangeIdea_load_twitter_widgets()
{
	register_widget('OrangeIdea_Twitter_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class OrangeIdea_Twitter_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function OrangeIdea_Twitter_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'OrangeIdea_twitter_widget', 'description' => __( 'OrangeIdea: Twitter', 'orangeidea' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'OrangeIdea_twitter_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'OrangeIdea_twitter_widget', 'OrangeIdea: Twitter ', $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$number_of_posts_to_show = $instance['number_of_posts_to_show'];
	$oi_consumer_key = $instance['oi_consumer_key'];
	$oi_consumer_secret = $instance['oi_consumer_secret'];
	$oi_user_token = $instance['oi_user_token'];
	$oi_user_secret = $instance['oi_user_secret'];
	$oi_account = $instance['oi_account'];
	$oi_account_count = $instance['oi_account_count'];
	
	
	// Before widget (defined by theme functions file)
	

										if(!require_once('twitteroauth.php')){ 
										echo '<strong>Couldn\'t find twitteroauth.php!</strong>';
										return;
									   }
									   
									   $connection = getConnectionWithAccessToken($oi_consumer_key, $oi_consumer_secret, $oi_user_token, $oi_user_secret);
									   $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$oi_account."&count=".$oi_account_count."");
									   if(!empty($tweets->errors)){
										if($tweets->errors[0]->message == 'Invalid or expired token'){
										 echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!';
										}else{
										 echo '<strong>'.$tweets->errors[0]->message.'</strong>';
										}
									   }
									   if(is_array($tweets)){
									   for($i = 0;$i <= count($tweets); $i++){
										if(!empty($tweets[$i])){
										 $tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
										 $tweets_array[$i]['text'] = $tweets[$i]->text;   
										 $tweets_array[$i]['status_id'] = $tweets[$i]->id_str;   
										} 
									   }
									   
									  
									  echo $before_widget;
	// Display the widget title if one was input
		echo $before_title . $title . $after_title; 
									   foreach($tweets_array as $tweet){?>                
										 
										<div class="oi_tweet">
											<div class="oi_tweet_content"><?php echo convert_links($tweet['text'])?></div>
                                            <div class="oi_tweet_time">
                                            	<a class="twitter_time" target="_blank" href="http://twitter.com/<?php echo $oi_account ?>/statuses/<?php echo $tweet['status_id']?>"><?php echo relative_time($tweet['created_at'])?></a>
                                            </div>
										</div>
							 <?php }echo $after_widget; }
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['number_of_posts_to_show'] = stripslashes( $new_instance['number_of_posts_to_show']);

	$instance['oi_consumer_key'] = stripslashes( $new_instance['oi_consumer_key']);
	$instance['oi_consumer_secret'] = stripslashes( $new_instance['oi_consumer_secret']);
	$instance['oi_user_token'] = stripslashes( $new_instance['oi_user_token']);
	$instance['oi_user_secret'] = stripslashes( $new_instance['oi_user_secret']);
	$instance['oi_account'] = stripslashes( $new_instance['oi_account']);
	$instance['oi_account_count'] = stripslashes( $new_instance['oi_account_count']);
	

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

		
	// Set up some default widget settings
	$defaults = array( 
		'title' => __( 'Twitter Widget' , 'orangeidea' ),
		'number_of_posts_to_show' => '3',
		'oi_consumer_key' =>'',
		'oi_consumer_secret' =>'',
		'oi_user_token' =>'',
		'oi_user_secret' =>'',
		'oi_account' =>'Orange_Idea_RU',
		'oi_account_count' =>'3',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

    <p>
		<label for="<?php echo $this->get_field_id( 'oi_consumer_key' ); ?>"><?php _e('Consumer Key:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'oi_consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'oi_consumer_key' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['oi_consumer_key'] ), ENT_QUOTES)); ?>" />
	</p>
    
    <p>
		<label for="<?php echo $this->get_field_id( 'oi_consumer_secret' ); ?>"><?php _e('Consumer Secret:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'oi_consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'oi_consumer_secret' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['oi_consumer_secret'] ), ENT_QUOTES)); ?>" />
	</p>
    
	<p>
		<label for="<?php echo $this->get_field_id( 'oi_user_token' ); ?>"><?php _e('User Token:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'oi_user_token' ); ?>" name="<?php echo $this->get_field_name( 'oi_user_token' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['oi_user_token'] ), ENT_QUOTES)); ?>" />
	</p>
    
    <p>
		<label for="<?php echo $this->get_field_id( 'oi_user_secret' ); ?>"><?php _e('User Secret:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'oi_user_secret' ); ?>" name="<?php echo $this->get_field_name( 'oi_user_secret' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['oi_user_secret'] ), ENT_QUOTES)); ?>" />
	</p>
    
    <p>
		<label for="<?php echo $this->get_field_id( 'oi_account' ); ?>"><?php _e('Twitter Username:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'oi_account' ); ?>" name="<?php echo $this->get_field_name( 'oi_account' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['oi_account'] ), ENT_QUOTES)); ?>" />
	</p>
    
    <p>
		<label for="<?php echo $this->get_field_id( 'oi_account_count' ); ?>"><?php _e('Amount of tweets:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'oi_account_count' ); ?>" name="<?php echo $this->get_field_name( 'oi_account_count' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['oi_account_count'] ), ENT_QUOTES)); ?>" />
	</p>
    
    

	<?php	 		 	
	}
}
?>