<?php 
$layout = get_post_meta($post->ID, 'posts_layout', 1);
$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-squre'); 
$title = get_the_title();
global $oi_options;
?>

<?php
$catt = get_the_terms( $post->ID, 'category' );
if (isset($catt) && ($catt!='')){
	$slugg = '';
	$slug = ''; 
	foreach($catt  as $vallue=>$key){
		$slugg .= strtolower($key->slug) . " ";
		$slug  .= ''.$key->name.', ';
	}
	
};


?>
<div class="row oi_small_recent">
<?php if ($large_image_url[0] !='') {?>
<div class="col-md-3  oi_for_overflow" ><a class="oi_image_link" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo $large_image_url[0]; ?>"></a></div>
<?php }else{?>
<div class="col-md-3" ><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/framework/css/img/oi_format_standard_w.png"></div>
<?php };?>
<div class="oi_page_post_slider_inner col-md-9">
	<div class="oi_page_post_slider_inner_content">
    	<div class="oi_blog_post_date">
            <div class="oi_date_d colored"><?php the_time('d F') ?> <span class="oi_year"><?php the_time('Y') ?></span></div>
        </div>
        <h5 class="oi_page_post_slider_inner_content_title oi_title_recent_posts"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h5>
    </div>
    <div class="clearfix"></div>
</div>
</div>

