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
 <div class="oi_popular_widget_post_holder">
         	<div class="oi_popular_widget_post_image">
            	<?php if ($large_image_url[0] !='') {?>
				<a class="oi_image_link" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo $large_image_url[0]; ?>"></a>
                <?php }else{?>
                <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/framework/css/img/oi_format_standard_w.png">
				<?php };?>
            </div>
            <div class="oi_popular_widget_post_content">
            	<div class="oi_date_d colored"><?php the_time('d F') ?> <span class="oi_year"><?php the_time('Y') ?></span></div>
                <div class="oi_post_cat">
					<?php echo substr($slug, '0', '-2');?>
                </div>
            	<h5 class="oi_blog_post_title"><strong><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></strong></h5>
                <div class="oi_popular_widget_post_description"><?php echo get_post_meta(get_the_ID(), 'post-descr', true); ?></div>
            </div>
         <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>