<?php
/**
 * Start Theme Options
 * -----------------------------------------------------------------------------
 */

// Setting dev mode to true allows you to view the class settings/info in the panel.
// Default: true
$args['dev_mode'] = false;

// Set the class for the dev mode tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['dev_mode_icon_class'] = 'icon-large';

// Set a custom option name. Don't forget to replace spaces with underscores!
$args['opt_name'] = 'oi_options';

// Setting system info to true allows you to view info useful for debugging.
// Default: false
//$args['system_info'] = true;

$theme = wp_get_theme();

$args['display_name'] = $theme->get('Name');
//$args['database'] = "theme_mods_expanded";
$args['display_version'] = $theme->get('Version');

// If you want to use Google Webfonts, you MUST define the api key.
$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
// Default: 'standard'
//$args['admin_stylesheet'] = 'standard';

// Set the class for the import/export tab icon.
// This is ignored unless $args['icon_type'] = 'iconfont'
// Default: null
$args['import_icon_class'] = 'icon-large';

/**
 * Set default icon class for all sections and tabs
 * @since 3.0.9
 */
$args['default_icon_class'] = 'icon-large';


// Set a custom menu icon.
//$args['menu_icon'] = '';

// Set a custom title for the options page.
// Default: Options
$args['menu_title'] = __('Theme Options', "orangeidea");

// Set a custom page title for the options page.
// Default: Options
$args['page_title'] = __('Theme Options', "orangeidea");

// Set a custom page slug for options page (wp-admin/themes.php?page=***).
// Default: redux_options
$args['page_slug'] = 'redux_options';

$args['default_show'] = true;
$args['default_mark'] = '*';


// Add HTML before the form.
if (!isset($args['global_variable']) || $args['global_variable'] !== false ) {
	if (!empty($args['global_variable'])) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace("-", "_", $args['opt_name']);
	}
	$args['intro_text'] = sprintf( __('<p>Welcome to the <strong>Mister BLOGGER</strong>! Fully Responsive Magazine Theme!</p>', "orangeidea" ), $v );
} else {
	$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', "orangeidea");
}

$sections = array();              

//Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';

/*$sample_patterns_path = get_template_directory_uri() . '/img/bg/';
$sample_patterns_url = get_template_directory_uri() . '/img/bg/';*/

$ct_bg_type = array( "none" => "None" , "upload" => "Upload" , "predefined" => "Predefined" );
$ct_bg_repeat = array( "repeat" => "repeat" , "repeat-x" => "repeat-x", "repeat-y" => "repeat-y", "no-repeat" => "no-repeat" );
$ct_bg_position = array( "top left" => "top left", "top center" => "top center", "top right" => "top right", "center left" => "center left", "center center" => "center center", "center right" => "center right", "bottom left" => "bottom left", "bottom center" => "bottom center", "bottom right" => "bottom right");
$ct_type_animation = array( "fade" => "Fade", "scale_up" => "Scale Up", "scale_down" => "Scale Down", "slide_top" => "Slide Top", "slide_bottom" => "Slide Bottom", "slide_right" => "Slide Right", "slide_left" => "Slide Left" );
$type_of_pagination = array( "standard" => "Standard", "numeric" => "Numeric", "load_more" => "Load More button" );
$type_of_pagination_cat = array( "standard" => "Standard", "numeric" => "Numeric" );

$theme_bg_type = array ( "uploaded" => "Uploaded", "predefined" => "Predefined" , "color" => "Color" );
$theme_bg_attachment = array ( "scroll" => "Scroll" , "fixed" => "Fixed" );
$theme_bg_position = array ( "left" => "Left" , "right" => "Right", "centered" => "Centered" , "full_screen" => "Full Screen" );
$theme_bg_color = array ( "bg_image" => "Background Image", "color" => "Color", "upload" => "Upload" );

$blog_sidebar_position = array ( "Right Sidebar" => "Right Sidebar", "Left Sidebar" => "Left Sidebar");
$sl_port_style = array ( "Random Thumbnails" => "Random Thumbnails", "Standard Thumbnails" => "Standard Thumbnails");



$sample_patterns = array();

if ( is_dir( $sample_patterns_path ) ) :
	
  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
  	$sample_patterns = array();

    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
      	$name = explode(".", $sample_patterns_file);
      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
      }
    }
  endif;
endif;



/* Theme Parameters*/

		$bg_images_path = get_stylesheet_directory() . '/framework/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri() . '/framework/images/bg/'; // change this to where you store your bg images

		$ct_theme_patterns = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($ct_theme_patterns); //Sorts the array into a natural order
		                $ct_theme_patterns[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}


$theme_path_images = get_template_directory_uri() . '/framework/images/';






$sections[] = array(
	'title' => __('General Settings', "orangeidea"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-large',
    'icon' => 'el-icon-home',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(

			array(
				'id'=>'oi_header_favicon',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Favicon Upload', "orangeidea"),
				'desc'=> __('Upload your favicon the url', "orangeidea"),
				'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "orangeidea"),
				'default'=>array('url'=> $theme_path_images . 'favicon.ico' ),
			),
			
			
			array(
			'id'=>'oi_logo_upload',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Logo Upload', "orangeidea"),
			'desc'=> __('Upload your logo or paste the url', "orangeidea"),
			'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "orangeidea"),
			'default'=>array('url'=> $theme_path_images . 'mr-blogger.png' ),
			),
			
			
			array(
				'id'       => 'top_slider_area',
				'type'     => 'switch', 
				'title'    => __('Switch on sliders area?', 'orangeidea'),
				'default'  => false,
				'on' => 'Enabled',
				'off' => 'Disabled',
			),
			
			array(
				'id'       => 'sticky_sb',
				'type'     => 'switch', 
				'title'    => __('Enable Sticky sidebars?', 'orangeidea'),
				'default'  => false,
				'on' => 'Enabled',
				'off' => 'Disabled',
			),
			array(
				'id'       => 'css_animation',
				'type'     => 'switch', 
				'title'    => __('Enable CSS animation?', 'orangeidea'),
				'default'  => false,
				'on' => 'Enabled',
				'off' => 'Disabled',
			),
			
			
			
			array(
				'id'       => 'oi_accent_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Main accent color', 'orangeidea'), 
				'subtitle' => __('Pick a color for the theme (default: #ff0000).', 'orangeidea'),
				'default'  => '#ff0000',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_logo_area_bg',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Logo area background color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #ffffff).', 'orangeidea'),
				'default'  => '#ffffff',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_logo_area_tagline',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Tagline color (text after logo)', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #444444).', 'orangeidea'),
				'default'  => '#444444',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_menu_area_bg',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Menu background color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #f1f1f1).', 'orangeidea'),
				'default'  => '#f1f1f1',
				'validate' => 'color',
			),
			
			
			array(
				'id'       => 'oi_menu_area_border',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Menu items border', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #fff).', 'orangeidea'),
				'default'  => '#fff',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_menu_area_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Menu items color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #000).', 'orangeidea'),
				'default'  => '#000',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_after_logo_search_bg',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Search area background', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #f3f3f3).', 'orangeidea'),
				'default'  => '#f3f3f3',
				'validate' => 'color',
			),
			
			
			
			array(
				'id'       => 'oi_categories_place_bg',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories background', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #212227).', 'orangeidea'),
				'default'  => '#212227',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_categories_place_border',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories right border color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #191919).', 'orangeidea'),
				'default'  => '#191919',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_categories_place_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories title color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #fff).', 'orangeidea'),
				'default'  => '#fff',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_categories_place_color_border',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories title border-bottom color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #111).', 'orangeidea'),
				'default'  => '#111',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_categories_list_border',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories list border-top color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #333).', 'orangeidea'),
				'default'  => '#333',
				'validate' => 'color',
			),
			
			
			array(
				'id'       => 'oi_categories_list_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories list text color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #aaa).', 'orangeidea'),
				'default'  => '#aaa',
				'validate' => 'color',
			),
			array(
				'id'       => 'oi_categories_list_color_hover',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Categories list text color on hover', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #fff).', 'orangeidea'),
				'default'  => '#fff',
				'validate' => 'color',
			),
			array(
				'id'       => 'oi_rigth_menu_place_bg',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Right side area background color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #28292e).', 'orangeidea'),
				'default'  => '#28292e',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_rigth_menu_place_border',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Right side area border color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #333).', 'orangeidea'),
				'default'  => '#333',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_rigth_menu_place_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Right side area text color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #fff).', 'orangeidea'),
				'default'  => '#fff',
				'validate' => 'color',
			),
			array(
				'id'       => 'oi_rigth_menu_place_top_bg',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Right side  login/register area background', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #212227).', 'orangeidea'),
				'default'  => '#212227',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_log_reg_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Login/Register text color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #aaa).', 'orangeidea'),
				'default'  => '#aaa',
				'validate' => 'color',
			),
			
			array(
				'id'       => 'oi_log_reg_border_sep',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Login/Register seporator color', 'orangeidea'), 
				'subtitle' => __('Pick a color (default: #111).', 'orangeidea'),
				'default'  => '#111',
				'validate' => 'color',
			),
			
			
			
			
			array(
               'id'               => 'oi_typo_headers',
               'type'               => 'typography', 
               'title'               => __('Titles Font', 'orangeidea'),
               'compiler'          => true, // Use if you want to hook in your own CSS compiler
               'google'          => true, // Disable google fonts. Won't work if you haven't defined your google api key
               'font-backup'     => false, // Select a backup non-google font in addition to a google font
               'font-style'     => false, // Includes font-style and weight. Can use font-style or font-weight to declare
               'font-weight'     => false,
			   'font-size'     => false,
			   'line-height'     => false,
			   'color'     => false,
               'subsets'          =>false, // Only appears if google is true and subsets not set to false
               'text-align'     => false,
               'units'               => 'px', // Defaults to px
               'subtitle'          => __('Specify the title font properties.', 'orangeidea'),
               'default'          => array(
                                             'font-family'     => 'Open Sans',
                                             'google'          => true,
                                             ),
               ),
			   
			   		   array(
				'id'               => 'top_right',
				'type'             => 'editor',
				'title'            => __('Textarea after authorization (i use mailchimp plugin for newslatter susbscribe)', 'orangeidea'), 
				'default'          => 'In demo site i use MailChimp plugin and shortcode -mc4wp_form-, but you can put here anything you want',
				'args'   => array(
					'teeny'            => true,
					'textarea_rows'    => 10
				)
			),

			   
				
					array(
							'id'       => 'footer_social_tw',
							'type'     => 'text',
							'title'    => __('Twitter utl', 'orangeidea'),
							'default'  => '#'
						),
						array(
							'id'       => 'footer_social_fb',
							'type'     => 'text',
							'title'    => __('Facebook url', 'orangeidea'),
							'default'  => '#'
						),
						array(
							'id'       => 'footer_social_go',
							'type'     => 'text',
							'title'    => __('Google + url', 'orangeidea'),
							'default'  => '#'
						),
						array(
							'id'       => 'footer_social_pi',
							'type'     => 'text',
							'title'    => __('Pinterest URL', 'orangeidea'),
							'default'  => '#'
						),
						array(
							'id'       => 'footer_social_li',
							'type'     => 'text',
							'title'    => __('LinkedIN url', 'orangeidea'),
							'default'  => '#'
						),
						array(
							'id'       => 'footer_social_dr',
							'type'     => 'text',
							'title'    => __('Dribbble url', 'orangeidea'),
							'default'  => '#'
						),
						array(
							'id'       => 'footer_social_yt',
							'type'     => 'text',
							'title'    => __('YouTube url', 'orangeidea'),
							'default'  => '#'
						),		  

					   array(
				'id'               => 'footer_left',
				'type'             => 'editor',
				'title'            => __('Textarea for footer rigth side', 'orangeidea'), 
				'default'          => 'Copyright 2014 Mister Blogger - Company. Design by OrangeIdea',
				'args'   => array(
					'teeny'            => true,
					'textarea_rows'    => 10
				)
			),
		
		
		),
	);




















global $ReduxFramework;
if ( !isset( $tabs ) ) $tabs = 0;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

// END Sample Config

function generate_options_css( $newdata ) {
    $smof_data = $newdata;
    $css_dir = get_stylesheet_directory() . '/framework/css/';
    $css_php_dir = get_template_directory() . '/framework/css/';
    ob_start();
    require( $css_php_dir . '/style.php' );
    $css = ob_get_clean();
    global $wp_filesystem;
    WP_Filesystem();
    if ( ! $wp_filesystem->put_contents( $css_dir . '/options.css', $css, 0644 ) ) {
        return true;
    }
}

function oi_theme_css_compiler() {
	global $oi_options;
	generate_options_css( $oi_options );
}
add_action('redux-compiler-oi_options', 'oi_theme_css_compiler');