<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>

<div class="row">
    <div class="col-md-12">
    	<div class="row">
        	<div class="col-md-2 col-md-push-5 col-sm-2 col-sm-push-5">
                <div class="oi_testimonial_item_holder">
					<img class="img-circle" src="<?php echo $large_image_url[0]; ?>" alt="" />
                </div>
            </div>
            <div class="col-md-12 col-sm-12 text-center">
            	<h4 class="oi_textimponial_author"><?php the_time('d F Y') ?>,&nbsp;&nbsp; By  <?php the_title(); ?></h4>
                <h6 class="oi_textimponial_author_small"><?php echo get_post_meta($post->ID, 'testimonials-descr', true); ?></h6>
            </div>
            <div class="col-md-8 col-md-push-2 col-sm-8 col-sm-push-2 text-center">
				<div class="oi_textimponial_text">
				<?php the_content(); ?>
                </div>
            </div>
        </div>
	</div>
</div>
