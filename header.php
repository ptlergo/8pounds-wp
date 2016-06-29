<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <title><?php wp_title('| ',true,'right'); bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>" />  
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php global $oi_options;?>
    <link rel="shortcut icon" href="<?php  echo stripslashes($oi_options['oi_header_favicon']['url'])?>">
    <?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
<div class="oi_head_holder">
	<div class="oi_smalldev_holder hidden-lg">
		<?php 
		//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)
		
		$orderby      = 'name'; 
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no
		$title        = '';
		
		$args = array(
		  'orderby'      => $orderby,
		  'show_count'   => $show_count,
		  'pad_counts'   => $pad_counts,
		  'hierarchical' => $hierarchical,
		  'title_li'     => $title
		);
		?>
		<div class="visible-xs oi_show_mobile_menu"><?php _e('Categories', "orangeidea"); ?><span class="fa fa-bars"></span></div>
        <ul  class="oi_smalldev_categories_list">
        <?php wp_list_categories( $args ); ?>
        </ul>
    </div>
    <div class="clearfix hidden-lg"></div>
	<div class="oi_logo_place">
    	<div class="oi_logo">
        	<div class="oi_logo_inner_holder">
        		<a href="<?php echo home_url(); ?>"><img src="<?php echo $oi_options['oi_logo_upload']['url']?>" alt=""></a>
                <div class="oi_logo_inner_description">
                <?php bloginfo('description'); ?><br>
                <span class="fa fa-th-large oi_main_menu_opener visible-xs"></span>
                </div>
            </div>
        </div>
        <div class="oi_after_logo hidden-sm">
        	<div class="oi_after_logo_search">
            <form role="search" action="<?php echo site_url('/'); ?>" method="get">
            	<input name="s" placeholder="Type Something And Hit Enter">
                <input type="hidden" name="post_type" value="post">
            </form>
            </div>
        	<span class="fa fa-search-plus hidden-xs"></span>
            
        	<div class="clearfix"></div>
			<?php	 		 		 		 		 		 	
			if ( has_nav_menu( 'main_menu' ) ){
			$walker = new OI_Walker;
				wp_nav_menu(array(
					'echo' => true,
					'container' => '',
					'theme_location' => 'main_menu',
					'menu_class' => 'header_menu',
					'walker' => $walker
				));
				} else { echo '<div class="header_menu" style="padding:20px 0;"><strong>Set up your menu</strong><br> Appearance -> Menus -> Create your menu -> Choose it in "Theme Location" block</div>';}
			?>
            <div class="clearfix"></div>
            <!--
            <div class="oi_after_logo_input_holder">
            	<span class="fa fa-search"></span><input type="text" value="" placeholder="Type something" id="search">
            </div>
            <div class="oi_after_logo_btn_holder">
            	<a class="btn" href="#">Search</a>
            </div>
            -->
        </div>
    </div>
    <div class="oi_categories_place">
    	<?php
		$args = array(
		  'orderby' => 'name',
		  'parent' => 0
		  );
		$categories = get_categories( $args );
		?>
        <h6><?php _e('Categories', "orangeidea"); ?></h6>
        
               <?php 
		//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)
		
		$orderby      = 'name'; 
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no
		$title        = '';
		
		$args = array(
		  'orderby'      => $orderby,
		  'show_count'   => $show_count,
		  'pad_counts'   => $pad_counts,
		  'hierarchical' => $hierarchical,
		  'title_li'     => $title
		);
		?>

        <ul  class="oi_categories_list">
        <?php wp_list_categories( $args ); ?>
        </ul>
    </div>
    <div class="oi_rigth_menu_place">
    	<div class="oi_rigth_menu_place_top">
			<?php if (!$user_ID) {?>
        	<a class="oi_login oi_member" href="#"><span class="fa fa-sign-in"></span> <?php _e('Log In', "orangeidea"); ?></a><a class="oi_registration oi_member" href="#"><span class="fa fa-user"></span> <?php _e('Register', "orangeidea"); ?></a>    
    		<?php }else{
					$current_user = wp_get_current_user();
					$roles = $current_user->roles;
					$role = array_shift($roles);
					$oi_username = $current_user->user_login;
					$oi_userid = $current_user->ID;
					?>
                    <div class="oi_welcome_area">
                    <span class="oi_welcome_area_welcome"><?php _e("Welcome" , "orangeidea"); ?></span>
                    <?php
					
					echo $oi_username;
					echo get_avatar( $oi_userid, 20 );
					?>
                    <a class="oi_logout" href="<?php echo wp_logout_url( home_url() ); ?>"><span class="oi_menu_shop_icon_text"><?php _e('LOG OUT', "orangeidea"); ?></span></a>
					</div>
				<?php }?>
            <!-- Login -->
            <div class="oi_rigth_menu_place_top_member_area oi_login">
            	<a class="oi_close close_login" href="#"><span class="fa fa-times"></span> <?php _e('Close', "orangeidea"); ?></a>
            	<form name="oi_login_form" id="oi_login_form" action="<?php echo home_url(); ?>/wp-login.php" method="post">
                <div class="row">
                	<div class="col-md-6 col-sm-6">
                    	<input type="text" value="" name="log" id="user_login" class="input" placeholder="<?php _e('Login', "orangeidea"); ?>" >
                    </div>
                    <div class="col-md-6 col-sm-6">
                    	<input type="password" name="pwd" id="user_pass3" class="input" value="" placeholder="<?php _e('Password', "orangeidea"); ?>">
                        <input type="hidden" name="absurl" value="<?php echo get_home_path()?>">
                    </div>
                    <div class="col-md-9 text-left">
                        <div class="oi_errors">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-rigth">
                    	<button class="oi_form_submit oi_login_submit" type="submit" name="wp-submit" id="wp-submit"><?php _e('Log In', "orangeidea"); ?></button>
                    </div>
                    
                </div>
                </form>
            </div>
            <!-- Register -->
            <div class="oi_rigth_menu_place_top_member_area oi_register">
            	<a class="oi_close close_register" href="#"><span class="fa fa-times"></span> <?php _e('Close', "orangeidea"); ?></a>
            	<form name="oi_register_form" id="oi_register_form" method="post">
                <div class="row">
                	<div class="col-md-6 col-sm-6">
                    	<input type="text" value="" name="username" id="user_name" class="input" placeholder="<?php _e('User Name', "orangeidea"); ?>" >
                    </div>
                    <div class="col-md-6 col-sm-6">
                    	<input type="email" name="email" id="user_email" class="input" value="" placeholder="<?php _e('E-mail', "orangeidea"); ?>">
                    </div>
                    <br><br>
                    <div class="col-md-6 col-sm-6">
                    	<input type="password" name="pass" id="user_pass" class="input" value="" placeholder="<?php _e('Password', "orangeidea"); ?>">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input type="password" name="pass2" id="user_pass2" class="input" value="" placeholder="<?php _e('Re-enter your password', "orangeidea"); ?>">
                        <input type="hidden" name="absurl" value="<?php echo get_home_path()?>">
                    </div>
                    <div class="col-md-9 col-sm-9 text-left">
                        <div class="oi_errors">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-rigth">
                    	<button class="oi_form_submit oi_register_submit" type="submit" name="wp-submit_register" id="wp-submit_register"><?php _e('Register', "orangeidea"); ?></button>
                    </div>
                    
                </div>
                </form>
            </div>
            
            
        </div>
        <div class="oi_rigth_menu_place_bottom">
            <div class="clearfix"></div>
				<?php echo  do_shortcode($oi_options['top_right'])?>
            <div class="oi_rigth_menu_place_bottom_social">
				<?php _e('We are in Social', "orangeidea"); ?>
            </div>
            <div class="oi_soc_icons">
                <?php if ($oi_options['footer_social_tw'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_tw']) ?>" title="Twitter" target="_blank"><div class="menu_icon_t"></div></a><?php }; ?>
                <?php if ($oi_options['footer_social_fb'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_fb']) ?>" title="Facebook" target="_blank"><div class="menu_icon_facebook"></div></a><?php }; ?>
                <?php if ($oi_options['footer_social_go'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_go']) ?>" title="Google+" target="_blank"><div class="menu_icon_google"></div></a><?php }; ?>
                <?php if ($oi_options['footer_social_pi'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_pi']) ?>" title="Pinterest" target="_blank"><div class="menu_icon_pi"></div></a><?php }; ?>
                <?php if ($oi_options['footer_social_li'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_li']) ?>" title="LinkedIn" target="_blank"><div class="menu_icon_in"></div></a><?php }; ?>
                <?php if ($oi_options['footer_social_dr'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_dr']) ?>" title="Dribbble" target="_blank"><div class="menu_icon_dribbble"></div></a><?php }; ?>
                <?php if ($oi_options['footer_social_yt'] != "") {?><a href="<?php echo stripslashes($oi_options['footer_social_yt']) ?>" title="YouTube" target="_blank"><div class="menu_icon_youtube"></div></a><?php }; ?>
            </div>
    	</div>
    </div>
</div>
<div  class="clearfix"></div>

<div class="oi_after_logo visible-sm">
        <div class="oi_after_logo_search">
        <form role="search" action="<?php echo site_url('/'); ?>" method="get">
            <input name="s" placeholder="Type Something And Hit Enter">
            <input type="hidden" name="post_type" value="post">
        </form>
        </div>
        <span class="fa fa-search-plus"></span>
        <div class="clearfix"></div>
        <?php	 		 		 		 		 		 	
        if ( has_nav_menu( 'main_menu' ) ){
        $walker = new OI_Walker;
            wp_nav_menu(array(
                'echo' => true,
                'container' => '',
                'theme_location' => 'main_menu',
                'menu_class' => 'header_menu',
                'walker' => $walker
            ));
            } else { echo '<div class="alert alert-info" style="margin-top:-20px; margin-bottom:0px;"><strong>Set up your menu</strong><br> Appearance -> Menus -> Create your menu -> Choose it in "Theme Location" block</div>';}
        ?>
        <div class="clearfix"></div>

    </div>