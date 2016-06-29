<?php 
$layout = get_post_meta($post->ID, 'posts_layout', 1);
$oi_img1 = wp_get_attachment_image_src( get_post_meta($post->ID, 'image', true), 'post-squre');
$oi_img2 = wp_get_attachment_image_src( get_post_meta($post->ID, 'image2', true), 'post-squre');
$oi_img3 = wp_get_attachment_image_src( get_post_meta($post->ID, 'image3', true), 'post-squre');


if ($layout == 'Wide'){
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-wide'); 
	}else{
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-squre'); 
	}
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

<div class="clearfix"></div>
<div class="oi_blog_post_meta">
    <div class="oi_blog_post_date">
        <div class="oi_date_d colored"><?php the_time('d F') ?> <span class="oi_year"><?php the_time('Y') ?></span></div>
        <div class="oi_post_cat">
            <?php echo substr($slug, '0', '-2');?>
        </div>
    </div>
    <h5 class="oi_blog_post_title"><strong><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></strong></h5>
    <div class="oi_post_descr_preview">
    	<?php echo get_post_meta($post->ID, 'post-descr', true); ?>
    </div>
</div>
<div class="oi_post_meta_data_holder">
    <a class="oi_image_link" href="<?php echo the_permalink(); ?>">
    <div class="flexslider oi_flex_loading oi_vc_gal">
        <ul class="slides">
            <?php  	 if (get_post_meta($post->ID, 'image', true)) { ?>
            <li><img class="img-responsive" src="<?php echo $oi_img1[0]; ?>" alt="" /></li>
            <?php  	 } ?>
            <?php  	 if (get_post_meta($post->ID, 'image2', true)) { ?>
            <li><img class="img-responsive" src="<?php echo $oi_img2[0]; ?>" alt="" /></li>
            <?php  	 } ?>
            <?php  	 if (get_post_meta($post->ID, 'image3', true)) { ?>
            <li><img class="img-responsive" src="<?php echo $oi_img3[0]; ?>" alt="" /></li>
            <?php  	 } ?>
        </ul>
    </div>
    </a>
    <div class="oi_post_tringle"></div>
</div>
<div class="clearfix"></div>
