<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); ?>

<?php
$layout = get_post_meta($post->ID, 'posts_layout', 1);
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
<div class="oi_post_meta_data_holder">
<?php if ($large_image_url[0] !='') {?>
    <a class="oi_image_link" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo $large_image_url[0]; ?>" /></a>
<?php }else { echo get_post_meta($post->ID, '_format_video_embed', true); }; ?>
    <div class="oi_post_tringle"></div>
</div>
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
<div class="clearfix"></div>
