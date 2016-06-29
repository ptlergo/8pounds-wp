<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: OrangeIdea Social Counter Widget
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your popular posts
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com

 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','oi_social_counter_widget'); 

function oi_social_counter_widget() {
		register_widget("OI_Social_Counter");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class OI_Social_Counter extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function OI_Social_Counter(){
		
		/* Widget settings. */	
		$widget_ops = array(	'classname'		=> 'oi-social-counter-widget',
								'description'	=> __( 'Social Counter Widget' , 'orangeidea' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'oi-social-counter-widget'
							);
		
		/* Create the widget. */
		$this->WP_Widget( 'oi-social-counter-widget', __( 'OrangeIdea: Social Counter' , 'orangeidea' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$twitter_ID = $instance['twitter_ID'];
		$facebook_ID = $instance['facebook_ID'];
		$youtube_ID = $instance['youtube_ID'];

		$show_twitter = isset($instance['show_twitter']) ? 'true' : 'false';
		$show_facebook = isset($instance['show_facebook']) ? 'true' : 'false';
		$show_youtube = isset($instance['show_youtube']) ? 'true' : 'false';
		$background_title = '#fff';

		// Before widget (defined by theme functions file)
	echo $before_widget;
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;
		?>
	
		<?php	
		
		/* ============ FACEBOOK ============ */

			if( !empty( $facebook_ID ) ) {

				$fans = get_transient('social_subscribers_counter_facebook');
			
				if( false === $fans ) {
			
					$urlFacebook = (array)wp_remote_get("http://graph.facebook.com/" . $facebook_ID );
					$facebookAccount = json_decode($urlFacebook['body']);
					$fans = $facebookAccount->likes;
					
					if( $fans != 0 ) {
						set_transient('social_subscribers_counter_facebook', $fans, 3600);
					}	
				}	
			}

		/* ============ YOUTUBE ============ */

			if( !empty( $youtube_ID ) ) {

				$yt_subscribers = get_transient('social_subscribers_counter_youtube');

				if( false === $yt_subscribers ) {

					$youtube = ct_yt_count($youtube_ID);
					$yt_subscribers = $youtube['yt_count'];

					if( $yt_subscribers != 0 ) {
						set_transient('social_subscribers_counter_youtube', $yt_subscribers, 3600);
					}	
				}	
			}

		/* ============ TWITTER ============ */

		ob_start();
		
		if( !empty( $twitter_ID ) and ($show_twitter == 'true') ) { 

			$followers = get_transient('social_subscribers_counter_twitter_ct');

			if( false === $followers ) {	
			
				require_once("TwitterAPIExchange.php");

				/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
				$oauth_access_token = '344004206-vU8uRhlnqcViLaOsItyzxAC4Aet4cS7udWHrYNQI';
				$oauth_access_token_secret = 'hkK49cE3rpNpLDbUY2jyN734y9TYTbFSIc6r60ks';
				$consumer_key = '1TdGgApROyqd3o2cedbqA';
				$consumer_secret = '5XHJ8dAzyTKdR35BlyE4aBc10kmoSfXHlrQvC4j2hHI';

				$settings = array(
    				'oauth_access_token' => $oauth_access_token,
    				'oauth_access_token_secret' => $oauth_access_token_secret,
    				'consumer_key' => $consumer_key,
    				'consumer_secret' => $consumer_secret
				);

				if( ( empty($consumer_key) || empty($consumer_secret) || empty($oauth_access_token) || empty($oauth_access_token_secret) ) ) {
					echo '<span class="counters_info" style="font-size: 12px;">' . __('Please fill all Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)','orangeidea') . '</span>' . $after_widget;
					return;
				}

				/** Perform a GET request and echo the response **/
				/** Note: Set the GET field BEFORE calling buildOauth(); **/
				$url = 'https://api.twitter.com/1.1/users/show.json';
				$getfield = '?screen_name=' . $twitter_ID;
				$requestMethod = 'GET';
				$twitter = new TwitterAPIExchange($settings);
				$response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

				$followers_decode = json_decode($response);
				$followers = $followers_decode->followers_count;

				if ( $followers != 0 ) {
					set_transient('social_subscribers_counter_twitter_ct', $followers, 3600);
				}	
			} //false
		}
		?>

		<ul class="list-unstyled oi_social_counters_ul">
			<?php if ( $show_facebook == 'true') : $facebook_english_format = number_format($fans); ?>
				<li class="facebook-social">
		  			<a class="facebook-social_f" target="_blank" href="https://www.facebook.com/<?php echo $facebook_ID ?>"> <span class="fa fa-facebook"></span></a>
		  			<span class="oi_counter_countent" title="<?php _e('Fans','orangeidea'); ?>"><?php echo  $facebook_english_format; ?></span>
                    <span class="oi_counter_countent_desc"><?php _e('Fans','orangeidea'); ?></span>
				</li>
			<?php endif; ?>

			<?php if ( $show_twitter == 'true') : $twitter_english_format = number_format($followers); ?>
				<li class="twitter-social">
		  			<a class="facebook-social_t" target="_blank" href="http://twitter.com/<?php echo $twitter_ID ?>"><span class="fa fa-twitter"></span></a>
		  			<span class="oi_counter_countent" title="<?php _e('Followers','orangeidea'); ?>"><?php echo $twitter_english_format; ?></span>
                    <span class="oi_counter_countent_desc"><?php _e('Followers','orangeidea'); ?></span>
				</li>
			<?php endif; ?>

			<?php if ( $show_youtube == 'true') : $youtube_english_format = number_format($yt_subscribers); ?>
				<li class="youtube-social">
		  			<a class="facebook-social_y" target="_blank" href="http://www.youtube.com/user/<?php echo $youtube_ID ?>"><span class="fa fa-youtube"></span></a>
		  			<span class="oi_counter_countent" title="<?php _e('Subscribers','orangeidea'); ?>"><?php echo $youtube_english_format; ?></span>
                    <span class="oi_counter_countent_desc"><?php _e('Subscribers','orangeidea'); ?></span>
				</li>
			<?php endif; ?>
		</ul>

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END SOCIAL COUNTER WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['twitter_ID'] = $new_instance['twitter_ID'];
		$instance['facebook_ID'] = $new_instance['facebook_ID'];
		$instance['youtube_ID'] = $new_instance['youtube_ID'];
		$instance['show_twitter'] = $new_instance['show_twitter'];
		$instance['show_facebook'] = $new_instance['show_facebook'];
		$instance['show_youtube'] = $new_instance['show_youtube'];

		$instance['background_title'] = strip_tags($new_instance['background_title']);
		
		delete_transient('social_subscribers_counter_twitter_ct');
		delete_transient('social_subscribers_counter_facebook');
		delete_transient('social_subscribers_counter_youtube');

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'				=> '', 
							'twitter_ID'		=> 'envato' , 
							'facebook_ID'		=> 'themeforest', 
							'youtube_ID'		=> 'Envato',
							'show_twitter'		=> 'on',
							'show_facebook'		=> 'on',
							'show_youtube'		=> 'on',
							'show_rss'			=> 'off',
						);
			
		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = esc_attr($instance['background_title']); ?>


		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'orangeidea' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_ID'); ?>"><?php _e( 'Twitter ID:' , 'orangeidea' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_ID'); ?>" name="<?php echo $this->get_field_name('twitter_ID'); ?>" value="<?php echo $instance['twitter_ID']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('facebook_ID'); ?>"><?php _e( 'Facebook ID:' , 'orangeidea' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_ID'); ?>" name="<?php echo $this->get_field_name('facebook_ID'); ?>" value="<?php echo $instance['facebook_ID']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('youtube_ID'); ?>"><?php _e( 'YouTube ID:' , 'orangeidea' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('youtube_ID'); ?>" name="<?php echo $this->get_field_name('youtube_ID'); ?>" value="<?php echo $instance['youtube_ID']; ?>" />
		</p>



		<p style="display:block; margin-bottom:5px;">
			<label for="Show counters" style="display:block;"><?php _e( 'Show counters:' , 'orangeidea' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_twitter'], 'on'); ?> id="<?php echo $this->get_field_id('show_twitter'); ?>" name="<?php echo $this->get_field_name('show_twitter'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_twitter'); ?>"><?php _e( 'Twitter' , 'orangeidea' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_facebook'], 'on'); ?> id="<?php echo $this->get_field_id('show_facebook'); ?>" name="<?php echo $this->get_field_name('show_facebook'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_facebook'); ?>"><?php _e( 'Facebook' , 'orangeidea' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_youtube'], 'on'); ?> id="<?php echo $this->get_field_id('show_youtube'); ?>" name="<?php echo $this->get_field_name('show_youtube'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_youtube'); ?>"><?php _e( 'Youtube' , 'orangeidea' ); ?></label>
		</p>


		<?php

	}
}
?>