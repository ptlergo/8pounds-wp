<!-- Event post format -->
<!-- EDIT: Patrick Funom 07/26/16 -->
<?php  global $smof_data; ?>
<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>

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


<div class="oi_single_post_standard">
  	<div class="event-img-container">
  		<img class="img-responsive" src="<?php echo $large_image_url[0]; ?>">
		</div>
		<div class="oi_single_post_title">
    	<div class="hidden-lg oi_small_dev_singlepost_meta">
            <strong><?php the_time('d F') ?> <span class="oi_year"><?php the_time('Y') ?></strong>
            <span class="colored"><?php echo getPostViews(get_the_ID());?></span>
        </div>
        <h1><?php the_title(); ?></h1>

    	<div class="oi_single_post_conent">
		<?php the_content(); ?>
		<?php $posttags = get_the_tags(); if ($posttags){ ?>
        <hr>
        <div class="oi_tags">
        <?php the_tags('');}; ?>
        </div>
        <hr>
        <div class="single_post_bottom_sidebar_holder">
			<?php comments_template(); ?>
        </div>
        </div>
    </div>
</div>
