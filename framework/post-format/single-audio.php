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
<div class="oi_single_post_images" style="width:100%;">
		<div>
		<?php echo get_post_meta($post->ID, '_format_audio_embed', true); ?>
        </div>
    <div class="oi_single_post_title">
    	<h1><?php the_title(); ?></h1>
        <div class="hidden-lg oi_small_dev_singlepost_meta">
            <strong><?php the_time('d F') ?> <span class="oi_year"><?php the_time('Y') ?></strong>
            <span class="colored"><?php echo getPostViews(get_the_ID());?></span>
        </div>
    	<div class="oi_single_post_conent">
		<?php the_content(); ?>
        <hr>
            <div class="oi_post_share_icons">
                <div class="oi_soc_icons">
                    <a href="https://twitter.com/share?url=<?php the_permalink()?>" title="Twitter" target="_blank"><div class="menu_icon_t"></div></a>
                    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink()?>" title="Facebook" target="_blank"><div class="menu_icon_facebook"></div></a>
                    <a href="https://plus.google.com/share?url=<?php the_permalink()?>" title="Google+" target="_blank"><div class="menu_icon_google"></div></a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink()?>" title="LinkedIn" target="_blank"><div class="menu_icon_in"></div></a>
                </div>
            </div>
            <div class="clearfix"></div>
        <hr>
        <div class="single_post_bottom_sidebar_holder">
			<?php comments_template(); ?>
        </div>
        </div>
    </div>
</div>