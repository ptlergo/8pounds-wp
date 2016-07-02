<?php
/**
 * Transfer functions and definitions
 *
 * @package Transfer
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) $content_width = 1000; /* pixels */

/* Makes theme available for translation. */
load_theme_textdomain( 'orangeidea', get_template_directory() . '/theme-options/ReduxCore/languages' );

/**
 * Include Framework. (Theme options)
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/theme-options/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/theme-options/ReduxCore/framework.php' );
}

if ( !isset( $ct_options ) && file_exists( dirname( __FILE__ ) . '/theme-options/options.php' ) ) {
	require_once( dirname( __FILE__ ) . '/theme-options/options.php' );
};


/* ------------------------------------------------------------------------ */
/* Disable WordPress Admin Bar for all users but admins.  */
/* ------------------------------------------------------------------------ */

add_action('after_setup_theme', 'oi_remove_admin_bar');

function oi_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}




/* ------------------------------------------------------------------------ */
/* Theme Stylesheets */
/* ------------------------------------------------------------------------ */

function oi_theme_styles_basic()
{
	/* Enqueue Stylesheets */
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' ); // Main Stylesheet
	wp_enqueue_style( 'oi_bxslider_css', get_template_directory_uri() . '/framework/css/jquery.bxslider.css', array(), '1', 'all' );
	wp_enqueue_style( 'flex-slider', get_template_directory_uri() . '/framework/FlexSlider/flexslider.css', array(), '1', 'all' );
	wp_enqueue_style( 'oi_prettyPhoto_css', get_template_directory_uri() . '/framework/css/prettyPhoto.css', array(), '1', 'all' );
}
add_action( 'wp_enqueue_scripts', 'oi_theme_styles_basic', 1 );




/* ------------------------------------------------------------------------ */
/* Loading Theme Scripts */
/* ------------------------------------------------------------------------ */
add_action('wp_enqueue_scripts', 'oi_load_scripts');
if ( !function_exists( 'oi_load_scripts' ) ) {
	function oi_load_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('oi_bootstrap', get_template_directory_uri().'/framework/bootstrap/bootstrap.min.js', false, null , true);
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false');
		wp_enqueue_script('oi_g_map', get_template_directory_uri().'/framework/js/gmap3.min.js', false, null , true);
		wp_enqueue_script('oi_bxslider', get_template_directory_uri().'/framework/js/jquery.bxslider.min.js', false, null , true);

		wp_enqueue_script('oi_prettyPhoto', get_template_directory_uri().'/framework/js/jquery.prettyPhoto.js', false, null , true);

		wp_enqueue_script('oi_flic', get_template_directory_uri().'/framework/js/jflickrfeed.min.js', false, null , true);
		wp_enqueue_script('oi_waitforimages', get_template_directory_uri().'/framework/js/jquery.waitforimages.js', false, null , true);
		wp_enqueue_script('oi_isotope', get_template_directory_uri().'/framework/js/jquery.isotope.min.js', false, null , true);
		wp_enqueue_script('oi_modernizr', get_template_directory_uri().'/framework/js/modernizr.custom.js', false, null , true);
		wp_enqueue_script('oi_dump', get_template_directory_uri().'/framework/js/dump.js', false, null , true);
		wp_enqueue_script('oi_flexslider', get_template_directory_uri().'/framework/FlexSlider/jquery.flexslider-min.js', false, null , true);
		wp_enqueue_script('oi_sticky-kit', get_template_directory_uri().'/framework/js/sticky-kit.min.js', false, null , true);
		wp_enqueue_script('oi_viewportchecker', get_template_directory_uri().'/framework/js/viewportchecker.js', false, null , true);

		wp_enqueue_script('oi_custom', get_template_directory_uri().'/framework/js/custom.js', false, null , true);

		global $oi_options;
		$oi_theme = array(
				'theme_url' => get_template_directory_uri(),
				'sticky_sidebars' => $oi_options['sticky_sb'],
				'css_animation' => $oi_options['css_animation'],
			);
    	wp_localize_script( 'oi_custom', 'oi_theme', $oi_theme );
	}
}

function add_scripts() {
};
add_action('wp_enqueue_scripts', 'add_scripts');



/* ------------------------------------------------------------------------ */
/* Theme Menus */
/* ------------------------------------------------------------------------ */

function oi_menu() {
  register_nav_menus(
    array(
      'main_menu' => 'Main Navigation',
      'secondary_menu' => 'Footer Navigation',
    )
  );
}
add_action( 'init', 'oi_menu' );

/* Custom menu Walker */
class OI_Walker extends Walker_Nav_Menu
	{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='my_drop'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . ' menu-item-'. $item->ID . '"';

		$output .= $indent . '<li id="menu-item-id-'. $item->ID . '"' . $value . $class_names .' >';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .' data-description="' . $item->description . '">';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';

		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/*=======================================
	Register Sidebar UNLIMITED
=======================================*/
if ( function_exists('register_sidebar') ){

	register_sidebar(array(
		'name' => 'Blog Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="io_widget_title"><span class="colored">// </span>',
        'after_title' => '</h6>'
    ));



	register_sidebar(array(
		'name' => 'Big Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<div class="clearfix"></div><h3 class="io_widget_title_single">',
        'after_title' => '</h3>'

    ));

	register_sidebar(array(
		'name' => 'Big Sidebar Bottom',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<div class="clearfix"></div><h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> ',
        'after_title' => '</h3>'

    ));

	register_sidebar(array(
		'name' => 'Small Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<div class="clearfix"></div><h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> ',
        'after_title' => '</h3>'

    ));


	register_sidebar(array(
		'name' => 'Page Small Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<div class="clearfix"></div><h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> ',
        'after_title' => '</h3>'

    ));



}

add_filter('widget_text', 'do_shortcode');

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );

// additional image sizes
add_image_size( 'squre-for-widgets', 400, 400, true );
add_image_size( 'post-squre', 600, 600, true );
add_image_size( 'post-wide', 1024, 768, true );
add_image_size( 'post-super-wide', 1024, 400, true );
add_image_size( 'post-large', 1240, 700, true );


}


    /* ------------------------------------------------------------------------ */
	/* Automatic Plugin Activation */
	require_once('framework/plugin-activation.php');

	add_action('tgmpa_register', 'goodchoice_register_required_plugins');
	function goodchoice_register_required_plugins() {
		$plugins = array(

			array(
				'name'     				=> 'Visual Composer', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/framework/plugins/js_composer.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Slider Revolution', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),

			array(
				'name'     				=> 'CF-Post-Formats', // The plugin name
				'slug'     				=> 'cf-post-formats', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/framework/plugins/cf-post-formats.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
		);

		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'goodchoice-framework';

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa($plugins, $config);

	}



/* ------------------------------------------------------------------------ */
/* Shortcodes.  */
/* ------------------------------------------------------------------------ */
include ('framework/shortcodes.php');
include("framework/widgets/twitter/oi_twitter_widget.php");
include("framework/widgets/oi_flickr_widget.php");
include("framework/widgets/oi_recent_posts_comments.php");
include("framework/widgets/oi_popular_posts.php");
include("framework/widgets/oi_social_counter_widget.php");
include("framework/widgets/oi_instagram_widget.php");


/*-----------------------------------------------------------------------------------*/
/* Set an option for a cURL transfer
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_curl_subscribers_text_counter' ) ) {
     function ct_curl_subscribers_text_counter( $xml_url ) {
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_URL, $xml_url);
          $data = curl_exec($ch);
          curl_close($ch);
          return $data;
     }
}


/*-----------------------------------------------------------------------------------*/
/* Youtube counter
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_yt_count' ) ) {
     function ct_yt_count( $username ) {
          try {
               @$xmlData = @ct_curl_subscribers_text_counter('http://gdata.youtube.com/feeds/api/users/' . strtolower($username));
               @$xmlData = str_replace('yt:', 'yt', $xmlData);
               @$xml = new SimpleXMLElement($xmlData);
               @$ytCount['yt_count'] = ( string ) $xml->ytstatistics['subscriberCount'];
               @$ytCount['page_url'] = "http://www.youtube.com/user/".$username;
          } catch (Exception $e) {
               $ytCount['yt_count'] = 0;
               $ytCount['page_url'] = "http://www.youtube.com";
          }
          return($ytCount);
     }
}

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
										 $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
										 return $connection;
									   }
									   function convert_links($status,$targetBlank=true,$linkMaxLen=250){

									   // the target
										$target=$targetBlank ? " target=\"_blank\" " : "";

									   // convert link to url
										$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
								]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);

									   // convert @ to follow
										$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

									   // convert # to search
										$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

									   // return the status
										return $status;
									  }
									  function relative_time($a) {
									   //get current timestampt
									   $b = strtotime("now");
									   //get timestamp when tweet created
									   $c = strtotime($a);
									   //get difference
									   $d = $b - $c;
									   //calculate different time values
									   $minute = 60;
									   $hour = $minute * 60;
									   $day = $hour * 24;
									   $week = $day * 7;

									   if(is_numeric($d) && $d > 0) {
										//if less then 3 seconds
										if($d < 3) return "right now";
										//if less then minute
										if($d < $minute) return floor($d) . " seconds ago";
										//if less then 2 minutes
										if($d < $minute * 2) return "about 1 minute ago";
										//if less then hour
										if($d < $hour) return floor($d / $minute) . " minutes ago";
										//if less then 2 hours
										if($d < $hour * 2) return "about 1 hour ago";
										//if less then day
										if($d < $day) return floor($d / $hour) . " hours ago";
										//if more then day, but less then 2 days
										if($d > $day && $d < $day * 2) return "yesterday";
										//if less then year
										if($d < $day * 365) return floor($d / $day) . " days ago";
										//else return more than a year
										return "over a year ago";
									   }
									  }
/*-----------------------------------------------------------------------------------*/
/* Twitter counter
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_twitter_count' ) ) {
     function ct_twitter_count( $twitter_id ) {
          try {
               @$url = "https://api.twitter.com/1/users/show.json?screen_name=".$twitter_id;
               @$reply = json_decode(@ct_curl_subscribers_text_counter($url));
               @$twitter['followers_count'] = $reply->followers_count;
          } catch (Exception $e) {
               $twitter['followers_count'] = '0';
          }
          return $twitter;
     }
}



/* ------------------------------------------------------------------------ */
/* Post Formats  */
/* ------------------------------------------------------------------------ */

add_theme_support( 'post-formats',      // post formats
		array(
			'image',    //image
			'quote',   // a quick quote
			'video',   // video
			'audio',   // audio
			'gallery',   // audio
		)
);


add_filter('get_avatar','change_avatar_css');

function change_avatar_css($class) {
$class = str_replace("class='avatar", "class='avatar img-circle oi_avatar ", $class) ;
return $class;
}





/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */
add_action('admin_init', 'extra_fields', 1);
function extra_fields() {
	add_meta_box( 'extra_fields', 'Additional Description', 'extra_fields_for_blog', 'post', 'normal', 'high'  );
	add_meta_box( 'extra_fields', 'Additional Description', 'extra_fields_for_testimonials', 'testimonials', 'normal', 'high'  );
	add_meta_box( 'extra_fields', 'Additional settings', 'extra_fields_for_portfolio', 'portfolio', 'normal', 'high'  );
	add_meta_box( 'extra_fields', 'Additional settings', 'extra_fields_for_pages', 'page', 'normal', 'high'  );

}
@the_post_thumbnail();
@wp_link_pages( $args );
@comments_template( $file, $separate_comments );
@add_theme_support( 'automatic-feed-links' );
@add_theme_support( 'custom-header', $args );
@add_theme_support( 'custom-background', $args );



//Extra Field for Pages
function extra_fields_for_pages( $post ){
?>
    <h4>You can use any sidebar, just choose it</h4>
    <?php global $wp_registered_sidebars;
  	?>
    <select name="extra[sidebarss]">
    <?php foreach ($wp_registered_sidebars as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'sidebarss', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
	<?php } ?>
    </select>
    <br>
<?php }



//Extra Field for Portfolio
function extra_fields_for_portfolio( $post ){
	?>
	<h4>Small Description</h4>
    <textarea rows="10" style="width:300px;" type="text" name="extra[port-descr]" value="<?php echo get_post_meta($post->ID, 'port-descr', true); ?>" ><?php echo get_post_meta($post->ID, 'port-descr', true); ?></textarea>
    <h4>Thumbnail</h4>
    <select name="extra[oi_th]">
    <?php $oi_thumb_array = array(
		'1' => 'portfolio-squre',
		'2' => 'portfolio-squrex2',
		'3' => 'portfolio-wide',
		'4' => 'portfolio-long'
		);?>
    <?php foreach ($oi_thumb_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_th', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
	<?php } ?>
    </select>

    <h4>Hover BG color</h4>
    <input type="text" name="extra[port-bg]" value="<?php echo get_post_meta($post->ID, 'port-bg', true); ?>" />
    <h4>Hover TEXT color</h4>
    <input type="text" name="extra[port-text-color]" value="<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>" />

    <h4>You can upload up to 5 additional images (Optional. For slider)</h4>
    <div>
    <p>
		<label for="upload_image">Image 1: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image]" value="<?php echo get_post_meta($post->ID, 'image', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<p>
		<label for="upload_image">Image 2: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image2]" value="<?php echo get_post_meta($post->ID, 'image2', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />

	<p>
		<label for="upload_image">Image 3: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image3]" value="<?php echo get_post_meta($post->ID, 'image3', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
    <p>
		<label for="upload_image">Image 4: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image4]" value="<?php echo get_post_meta($post->ID, 'image4', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
    <p>
		<label for="upload_image">Image 5: </label>
		<input id="upload_image" type="text" style="width:70%;"name="extra[image5]" value="<?php echo get_post_meta($post->ID, 'image5', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
    </div>

<?php };



//Extra Field for Blog
function extra_fields_for_blog( $post ){
	?>

<h4>Show post as fetured?</h4>
 <select name="extra[oi_featured]">
    <?php $oi_featured_array = array(
		'1' => 'No',
		'2' => 'Yes',
		);?>
    <?php foreach ($oi_featured_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_featured', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
	<?php } ?>
    </select>

<h4>Small Description</h4>
<textarea rows="10" style="width:300px;" type="text" name="extra[post-descr]" value="<?php echo get_post_meta($post->ID, 'post-descr', true); ?>" ><?php echo get_post_meta($post->ID, 'post-descr', true); ?></textarea>


<h4>You can upload up to 5 additional images (Optional. For Gallery)</h4>
    <div>
    <p>
		<label for="upload_image">Image 1: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image]" value="<?php echo get_post_meta($post->ID, 'image', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<p>
		<label for="upload_image">Image 2: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image2]" value="<?php echo get_post_meta($post->ID, 'image2', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />

	<p>
		<label for="upload_image">Image 3: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image3]" value="<?php echo get_post_meta($post->ID, 'image3', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
    <p>
		<label for="upload_image">Image 4: </label>
		<input id="upload_image" type="text" style="width:70%;" name="extra[image4]" value="<?php echo get_post_meta($post->ID, 'image4', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
    <p>
		<label for="upload_image">Image 5: </label>
		<input id="upload_image" type="text" style="width:70%;"name="extra[image5]" value="<?php echo get_post_meta($post->ID, 'image5', true); ?>" />
		<input class="upload_image_button" type="button" value="Upload" /><br/>

	</p>
    </div>
<?php };




//Save Extra Fields
add_action('save_post', 'extra_fields_update', 0);


function extra_fields_update( $post_id ){

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false;
	if( !isset($_POST['extra']) ) return false;


	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) )	delete_post_meta($post_id, $key);
		update_post_meta($post_id, $key, $value);
	}
	return $post_id;
}


function upload_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/framework/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}



function upload_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'upload_scripts');
add_action('admin_enqueue_scripts', 'upload_styles');



/**
* Custom widgets
**/


add_filter('wp_list_categories', 'add_span_cat_count');
function add_span_cat_count($links) {
$links = str_replace('</a> (', '</a> <span class="oi_cat_count">', $links);
$links = str_replace(')', '</span>', $links);
return $links;
}

add_filter('wp_list_archive', 'add_spann_cat_count');
function add_spann_cat_count($links) {
$links = str_replace('</a> (', '</a> <span class="oi_cat_count">', $links);
$links = str_replace(')', '</span>', $links);
return $links;
}



function tcr_tag_cloud_filter($args = array()) {
    $args['smallest'] = 8;
    $args['largest'] = 14;
    $args['unit'] = 'pt';
    return $args;
}

add_filter('widget_tag_cloud_args', 'tcr_tag_cloud_filter', 90);


//PAGINATION
function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  $a = array();
  if (!$current = get_query_var('paged')) $current = 1;

  if( !empty($wp_query->query_vars['s']) ) {
	   $a['add_args'] = array( 's' => str_replace(" ","+",get_query_var('s')), 'post_type' => get_query_var('post_type'));
  }

  if($wp_rewrite->using_permalinks()){
	$a['base'] = ''. add_query_arg('paged','%#%?#posts_holder');
  }else{
  	$a['base'] = add_query_arg('paged','%#%?#posts_holder');
  }

  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1;
  $a['mid_size'] = '3';
  $a['end_size'] = '1';
  $a['prev_text'] = 'Back';
  $a['next_text'] = 'Next';
  $a['total'] = $wp_query->max_num_pages;

  echo  paginate_links($a);
}


/*=======================================
	Add WP Breadcrumbs
=======================================*/



function oi_breadcrumbs(){
	/* === OPTIONS === */
    $text['home']     = __( 'Home', 'orangeidea' ); // text for the 'Home' link
    $text['category'] = __( 'Archive by Category "%s"', 'orangeidea' ); // text for a category page
    $text['search']   = __( 'Search Results for "%s" Query', 'orangeidea' ); // text for a search results page
    $text['tag']      = __( 'Posts Tagged "%s"', 'orangeidea' ); // text for a tag page
    $text['author']   = __( 'Articles Posted by %s', 'orangeidea' ); // text for an author page
    $text['404']      = __( 'Error 404', 'orangeidea' ); // text for the 404 page

    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter      = ' &nbsp;&nbsp;›&nbsp;&nbsp;'; // delimiter between crumbs
    $before         = '<span class="current">'; // tag before the current crumb
    $after          = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $home_link    = home_url('/');
    $link_before  = '<span typeof="v:Breadcrumb">';
    $link_after   = '</span>';
    $link_attr    = ' rel="v:url" property="v:title"';
    $link         = $link_before . '<a class="colored" ' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $parent_id    = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {

        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a class="colored" href="' . $home_link . '">' . $text['home'] . '</a></div>';

    } else {

        echo '<div class="breadcrumbs">';
        if ($show_home_link == 1) {
            echo '<a class="colored" href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }

        if ( is_category() ) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a  class="colored"', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a  class="colored"' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a class="colored"', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif ( is_page() && !$parent_id ) {
            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $parent_id ) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }

        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page','orangeidea') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</div><!-- .breadcrumbs -->';

    }


}
function crumbs_tax($term_id, $tax, $sep){
	$termlink = array();
	while( (int)$term_id ){
		$term2 = get_term( $term_id, $tax );
		$termlink[] = '<a class="subpage_block" href="'. get_term_link( (int)$term2->term_id, $term2->taxonomy ) .'">'. $term2->name .'</a>'. $sep;
		$term_id = (int)$term2->parent;
	}
	$termlinks = array_reverse($termlink);
	return implode('', $termlinks);
}





function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return '<span class="oi_views_count">'.$count.'</span> Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}



function wp_get_cat_postcount($id) {
    $cat = get_category($id);
    $count = (int) $cat->count;
    $taxonomy = 'category';
    $args = array(
      'child_of' => $id,
    );
    $tax_terms = get_terms($taxonomy,$args);
    foreach ($tax_terms as $tax_term) {
        $count +=$tax_term->count;
    }
    return $count;
}



function my_login_logo() {
global $oi_options; ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php	echo stripslashes($oi_options['oi_logo_upload']['url']) ?>);
			background-size:auto;
			height:60px;
			width:100%;
		}
    </style>
<?php	 		 		 		 		 		 	 }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// replace names of category
function rename_post_formats($translation, $text, $context, $domain) {
    $names = array(
        'Audio'  => 'Single/Mixtape',
				'Standard' => 'Event',
				'Quote' => 'Featured',
				'Image' => '-',
				'Gallery' => '-'
    );
    if ($context == 'Post format') {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter('gettext_with_context', 'rename_post_formats', 10, 4);

?>
