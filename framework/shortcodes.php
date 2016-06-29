<?php	 		 		 		 		 		 	


add_shortcode('posts_slider', 'theme_blog_i');

function theme_blog_i( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'show_posts' => '5',
			'header' => 'My blog title',
			'cat' => ''
    ), $atts));
	
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	$output = theme_blog_loop_i($show_posts, $header, $cat);
	return $output;

}

function theme_blog_loop_i($show_posts, $header, $cat)
{
	echo '<h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> '.$header.'</h3><div class="oi_page_post_slider"><ul class="slides">'."\n";
	 // Loop
	$args = array( 
		'post_type' => 'post',
		'posts_per_page' => 20,
		'meta_query' => array(
		'relation' => 'OR',
			array(
				'key' => 'oi_featured',
				'value' => 'Yes',
				'compare' => 'LIKE'
			)
	)
	);
	$query = new WP_Query( $args );
	$loop_count = 0;
	while ($query->have_posts()) { $query->the_post();
			
		$post_id = get_the_id();
		$default_url= get_template_directory_uri();
		$format = get_post_format();
		echo '<li  ';
		post_class('');
		echo ' id="post-'.$post_id.'">'."\n";
		echo ' <div>'."\n";
        echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
		get_template_part('framework/post-format/format-slider',$format);
		echo '</div>'."\n";
        echo '</div>'."\n";
		echo '</li>'."\n";
	}
	echo '</ul></div>'."\n";
	wp_reset_postdata();
}





add_shortcode('recent_posts', 'theme_blog_ii');

function theme_blog_ii( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'show_posts' => '4',
			'header' => '',
			'cat' => ''
    ), $atts));
	
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	if( $header !=''){
		$output = '<h3 class="io_widget_title_single" style="padding-top:0px;"><span class="fa fa-angle-down"></span> '.$header.'</h3>'.theme_blog_loop_ii($show_posts, $header, $cat);
	}else{
		$output = theme_blog_loop_ii($show_posts, $header, $cat);
		}
	return $output;

}

function theme_blog_loop_ii($show_posts, $header, $cat)
{
	echo '<div class="oi_page_recent_posts">'."\n";
	$query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => $show_posts, 'order' => 'DESC'));
	$loop_count = 0;
	ob_start();
	while ($query->have_posts()) { $query->the_post();
			
		$post_id = get_the_id();
		$default_url= get_template_directory_uri();
		$format = get_post_format();
		echo '<div  ';
		post_class('');
		echo ' id="post-'.$post_id.'">'."\n";
		echo ' <div>'."\n";
        echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
		get_template_part('framework/post-format/format-recent',$format);
		echo '</div>'."\n";
        echo '</div>'."\n";
		echo '</div>'."\n";
	}
	echo '</div>'."\n";
	wp_reset_postdata();
	return ob_get_clean();

}






















add_shortcode('recent_category', 'theme_blog_iii');

function theme_blog_iii( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'show_posts' => '5',
			'header' => 'My blog title',
			'cat' => 'html-coding'
    ), $atts));
	
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	
	$output = '<h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> Recent from <a class="oi_page_title_url" href="'.get_category_link(get_category_by_slug($cat)->cat_ID).'">'.get_category_by_slug($cat)->name.'</a></h3>
		<div class="oi_recent_category">
			'.theme_blog_loop_iii($show_posts, $header, $cat).'
		</div>';
	return $output;

}

function theme_blog_loop_iii($show_posts, $header, $cat)
{
			ob_start();

	echo '<div class="oi_recent_category_left">';
		echo '<div class="oi_page_recent_posts">'."\n";
		$query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => 1, 'order' => 'DESC'));
		$loop_count = 0;
		while ($query->have_posts()) { $query->the_post();
				
			$post_id = get_the_id();
			$default_url= get_template_directory_uri();
			$format = get_post_format();
			echo '<div  ';
			post_class('');
			echo ' <div>'."\n";
			echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
			get_template_part('framework/post-format/format-cat',$format);
			echo '</div>'."\n";
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
	echo '</div>'."\n";
	
 	echo '<div class="oi_recent_category_rigth">';
	echo '<ul class="oi_page_recent_posts list-unstyled">'."\n";
	$new_query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => $show_posts, 'order' => 'DESC','offset'=>1));
	$loop_count = 0;
	while ($new_query->have_posts()) { $new_query->the_post();
			
		$post_id = get_the_id();
		$default_url= get_template_directory_uri();
		$format = get_post_format();
		echo '<li  ';
		post_class('');
		echo ' id="post-'.$post_id.'">'."\n";
        echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
		get_template_part('framework/post-format/format-recent-no-thumb',$format);
        echo '</div>'."\n";
		echo '</li>'."\n";
	}
	echo '</ul>'."\n";
	echo '</div><div class="clearfix"></div>'."\n";
	
	
	$lp = ob_get_clean();
	return $lp;

}




add_shortcode('recent_category2', 'theme_blog_iv');

function theme_blog_iv( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'show_posts' => '5',
			'header' => 'My blog title',
			'cat' => 'html-coding'
    ), $atts));
	
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	
	$output = '<h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> Recent from <a class="oi_page_title_url" href="'.get_category_link(get_category_by_slug($cat)->cat_ID).'">'.get_category_by_slug($cat)->name.'</a></h3>
		<div class="oi_recent_category">
			'.theme_blog_loop_iv($show_posts, $header, $cat).'
			<div class="clearfix"></div>
		</div>';
	return $output;

}

function theme_blog_loop_iv($show_posts, $header, $cat)
{
			ob_start();

	echo '<div class="oi_recent_category_left">';
		echo '<div class="oi_page_recent_posts">'."\n";
		$query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => 1, 'order' => 'DESC'));
		$loop_count = 0;
		while ($query->have_posts()) { $query->the_post();
				
			$post_id = get_the_id();
			$default_url= get_template_directory_uri();
			$format = get_post_format();
			echo '<div  ';
			post_class('');
			echo ' <div>'."\n";
			echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
			get_template_part('framework/post-format/format-cat',$format);
			echo '</div>'."\n";
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
	echo '</div>'."\n";
	
 	echo '<div class="oi_recent_category_left">';
		echo '<div class="oi_page_recent_posts">'."\n";
		$query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => 1, 'order' => 'DESC', 'offset' =>1));
		$loop_count = 0;
		while ($query->have_posts()) { $query->the_post();
				
			$post_id = get_the_id();
			$default_url= get_template_directory_uri();
			$format = get_post_format();
			echo '<div  ';
			post_class('');
			echo ' <div>'."\n";
			echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
			get_template_part('framework/post-format/format-cat',$format);
			echo '</div>'."\n";
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
	echo '</div>'."\n";
	
	
	$lp = ob_get_clean();
	return $lp;

}







add_shortcode('recent_posts2', 'theme_blog_vi');

function theme_blog_vi( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'show_posts' => '4',
			'header' => 'My blog title',
			'cat' => ''
    ), $atts));
	
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	$output = theme_blog_loop_vi($show_posts, $header, $cat);
	return $output;

}

function theme_blog_loop_vi($show_posts, $header, $cat)
{
	echo '<div class="oi_page_recent_posts oi_recent_posts2">'."\n";
	$query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => $show_posts, 'order' => 'DESC'));
	$loop_count = 0;
	ob_start();
	while ($query->have_posts()) { $query->the_post();
			
		$post_id = get_the_id();
		$default_url= get_template_directory_uri();
		$format = get_post_format();
		echo '<div  ';
		post_class('');
		echo ' id="post-'.$post_id.'">'."\n";
		echo ' <div>'."\n";
        echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
		get_template_part('framework/post-format/format-recent2',$format);
		echo '</div>'."\n";
        echo '</div>'."\n";
		echo '</div>'."\n";
	}
	echo '</div>'."\n";
	wp_reset_postdata();
	return ob_get_clean();

}



add_shortcode('recent_category3', 'theme_blog_vii');

function theme_blog_vii( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'show_posts' => '2',
			'header' => 'My blog title',
			'cat' => 'html-coding'
    ), $atts));
	
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	
	$output = '<h3 class="io_widget_title_single"><span class="fa fa-angle-down"></span> Recent from <a class="oi_page_title_url" href="'.get_category_link(get_category_by_slug($cat)->cat_ID).'">'.get_category_by_slug($cat)->name.'</a></h3>
		<div class="oi_recent_category">
			'.theme_blog_loop_vii($show_posts, $header, $cat).'
		</div>';
	return $output;

}

function theme_blog_loop_vii($show_posts, $header, $cat)
{
			ob_start();

	echo '<div class="oi_recent_category3_main">';
		echo '<div class="oi_page_recent_posts">'."\n";
		$query =  new WP_Query(array('category_name' => $cat, 'post_type' => 'post', 'showposts' => $show_posts, 'order' => 'DESC'));
		$loop_count = 0;
		while ($query->have_posts()) { $query->the_post();
				
			$post_id = get_the_id();
			$default_url= get_template_directory_uri();
			$format = get_post_format();
			echo '<div  ';
			post_class('');
			echo ' <div>'."\n";
			echo '<div class="oi_blog_item oi_blog_shortcode">'."\n";
			get_template_part('framework/post-format/format-cat3',$format);
			echo '</div>'."\n";
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
	echo '</div>'."\n";
	
	
	$lp = ob_get_clean();
	return $lp;

}


?>