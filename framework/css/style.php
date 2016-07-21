<?php
	global $oi_options;
	/* Convert hexdec color string to rgb(a) string */

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default;

	//Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}
?>

/*
*	=================================================================================================================================================
*	GENERATED CSS FILE
*	=================================================================================================================================================
*/



h1, h2, h3, h4, h5, h6:not(.oi_blog_legend_descr) {
	font-family: '<?php echo $oi_options['oi_typo_headers']['font-family']; ?>' !important;

}


.colored { color:<?php echo $oi_options['oi_accent_color'] ?>}
.oi_after_logo .header_menu > li > a:hover { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_after_logo .header_menu > li.current-menu-item > a { background:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_after_logo .header_menu > li.current-menu-parent > a { background:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_after_logo .header_menu > li > .my_drop > ul >li >a:hover {background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_after_logo .header_menu > li > .my_drop > ul >li.current_page_item a { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_smalldev_categories_list > li >a:hover { background:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_smalldev_categories_list > li.current-cat >a { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_rigth_menu_place_top_member_area .oi_form_submit {background:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_rigth_menu_place_bottom input[type="submit"]:hover { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_after_logo_btn_holder a.btn { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_post_sticky_meta_smalldev h3 a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_blog_post_date {color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_blog_post_title a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_pg .page-numbers:hover { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.page-numbers.current { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_archive_posts_counts {background:<?php echo $oi_options['oi_accent_color'] ?>;}
#wp-calendar a { color:<?php echo $oi_options['oi_accent_color'] ?>}
#wp-calendar td#prev a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_post_content h6 {color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_post_content_content a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_single_post_meta .oi_views_count { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.fn a, .oi_commente_holder h4 a { color:<?php echo $oi_options['oi_accent_color'] ?>}
.btn.oi_form_submit { background:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_page_post_slider_inner_content_title a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_page_title_url:hover { color:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_smalldev_categories_list > li >ul> li> a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_head_holder .fa:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
#wp-calendar caption { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.tagcloud a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_tweet a:hover { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_tweet_time > a.twitter_time {color:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_ticket_commentlist .comment-author  .fn{ color:<?php echo $oi_options['oi_accent_color'] ?>; }
.oi_ticket_commentlist .comment-body .reply .comment-reply-link { color:<?php echo $oi_options['oi_accent_color'] ?>;}
.oi_ticket_commentlist > li > .comment-body .reply .comment-reply-link { color:<?php echo $oi_options['oi_accent_color'] ?>; }





.oi_post_sticky_meta {
	background:<?php echo hex2rgba($oi_options['oi_accent_color'], 0.8) ?>;
}
.oi_popular_widget_views { background:<?php echo hex2rgba($oi_options['oi_accent_color'], 0.8) ?>;}

.oi_tringle {border-left: 30px solid <?php echo hex2rgba($oi_options['oi_accent_color'], 0.8) ?>;}

@media (min-width: 0px) and (max-width: 767px) {
    .header_menu > li > .my_drop >ul >li >a:hover { color:<?php echo $oi_options['oi_accent_color'] ?> !important;}
    .header_menu > li > .my_drop >ul >li.current-menu-item >a { color:<?php echo $oi_options['oi_accent_color'] ?> !important;}
}

.oi_logo_place { background:<?php echo $oi_options['oi_logo_area_bg']?>}
.oi_logo_inner_description {color:<?php echo $oi_options['oi_logo_area_tagline']?>}
.oi_after_logo, .oi_after_logo .header_menu > li > .my_drop > ul >li >a{ background:<?php echo $oi_options['oi_menu_area_bg']?>}
.header_menu > li > .my_drop > ul >li >a, .oi_after_logo .header_menu > li:first-child > a, .oi_after_logo .header_menu > li > .my_drop > ul > li {border-color: <?php echo $oi_options['oi_menu_area_border']?>;}
.oi_after_logo .header_menu > li > a, .oi_after_logo .header_menu > li > .my_drop > ul >li >a {color:<?php echo $oi_options['oi_menu_area_color']?>}
.oi_after_logo_search {background: <?php echo $oi_options['oi_after_logo_search_bg']?>}

.oi_categories_place {background: <?php echo $oi_options['oi_categories_place_bg']?>; border-color:<?php echo $oi_options['oi_categories_place_border']?>;}
.oi_categories_place h6 {color: <?php echo $oi_options['oi_categories_place_color']?>; border-color:  <?php echo $oi_options['oi_categories_place_color_border']?>}
.oi_categories_list {border-color:<?php echo $oi_options['oi_categories_list_border']?>}
.oi_categories_list > li > a, .oi_categories_list > li > ul > li > a {color: <?php echo $oi_options['oi_categories_list_color']?>;}
.oi_categories_list > li > a:hover, .oi_categories_list > li > ul > li > a:hover {color: <?php echo $oi_options['oi_categories_list_color_hover']?>;}

.oi_rigth_menu_place {background-color: <?php echo $oi_options['oi_rigth_menu_place_bg']?>; border-color:<?php echo $oi_options['oi_rigth_menu_place_border']?>;}
.oi_rigth_menu_place_bottom {color: <?php echo $oi_options['oi_rigth_menu_place_color']?>; border-color:<?php echo $oi_options['oi_rigth_menu_place_border']?>}
.oi_rigth_menu_place_top {background:<?php echo $oi_options['oi_rigth_menu_place_top_bg']?> }
.oi_rigth_menu_place_top a {color: <?php echo $oi_options['oi_log_reg_color']?>}
.oi_rigth_menu_place_top a.oi_login { border-color:<?php echo $oi_options['oi_log_reg_border_sep']?>}
