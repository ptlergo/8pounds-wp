<?php
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
    <?php if(get_post_meta($post->ID, 'post-descr', true)) {
		echo get_post_meta($post->ID, 'post-descr', true); }
		else{ the_content('<div class="oi_read_more"><a class="oi_readmore_btn" href="'. get_permalink($post->ID) . '"><span class="fa fa-chevron-right"></span>&nbsp;&nbsp;'. __(" Read More","orangeidea") .'</a></div>'); } ?>

    </div>
</div>
<?php if ($large_image_url[0] !='') {?>
<div class="oi_post_meta_data_holder">
	<a class="oi_image_link" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo $large_image_url[0]; ?>" alt=""/></a>
    <div class="oi_post_tringle"></div>
</div>
<?php } else {?>
<div class="oi_post_meta_data_holder">
	<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/framework/css/img/oi_format_standard.png" alt="" />
    <div class="oi_post_tringle"></div>
</div>
<?php };?>
<div class="clearfix"></div>
