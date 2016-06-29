<?php  global $smof_data; ?>
<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); ?>

<?php
$catt = get_the_terms( $post->ID, 'category' );
if (isset($catt) && ($catt!='')){
	$slugg = '';
	$slug = '';
	foreach($catt  as $vallue=>$key){
		$slugg .= strtolower($key->slug) . " ";
		$slug  .= ''.$key->name.'  ';
	}

};
?>
<?php
	setPostViews(get_the_ID());
?>

<div class="oi_single_post_meta">
	<?php the_time('d F') ?><br><span class="oi_year"><?php the_time('Y') ?>
    <hr>
	<?php echo substr($slug, '0', '-2');?>
    <hr>
    <?php echo getPostViews(get_the_ID());?>
</div>
<div class="oi_single_post_images">
		<div>
		<?php echo get_post_meta($post->ID, '_format_video_embed', true); ?>
        </div>
    <div class="oi_single_post_title">
    	<h1><?php the_title(); ?></h1>
        <div class="hidden-lg oi_small_dev_singlepost_meta">
            <strong><?php the_time('d F') ?> <span class="oi_year"><?php the_time('Y') ?></strong>
            <span class="colored"><?php echo getPostViews(get_the_ID());?></span>
        </div>
    	<div class="oi_single_post_conent" >
		<?php the_content(); ?>
            <div class="clearfix"></div>
        <hr>
        <div class="single_post_bottom_sidebar_holder">
			<?php comments_template(); ?>
        </div>
        </div>
    </div>
</div>
