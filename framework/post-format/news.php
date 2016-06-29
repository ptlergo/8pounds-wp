<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>


<div class="row">
	<div class="col-md-2 col-sm-3">
    	<div class="oi_news_date text-center">
        	<?php the_time('d') ?><br>
            <?php the_time('F') ?>
        </div>
    </div>
    <div class="col-md-10 col-sm-9">
    	<h4 class="oi_news_title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h4>
        <?php $content = get_the_content();
		$content = strip_tags($content);
		echo substr($content, 0, 180);?> ...
    </div>
</div>
