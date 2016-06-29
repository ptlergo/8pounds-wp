<?php // Template Name: White Page ?>
<?php get_header();?>
    <div id="page_holder" class="oi_page_holder oi_page_white" data-sticky_parent>
    	<div class="oi_page">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	        <?php the_content(); ?>
        <?php endwhile;  ?> 
        <?php endif; ?>
        </div>
    </div>
<div class="oi_big_sidebar_bottom visible-lg" data-sticky_colum>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Big Sidebar Bottom"))  ?>                
</div>

<div class="oi_small_dev_sidebar_holder hidden-lg">
<div class="oi_small_sidebar_bottom_small_dev">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Small Sidebar"))  ?>                
</div>
<div class="oi_big_sidebar_bottom_small_dev">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Big Sidebar Bottom"))  ?>                
</div>
</div>
<?php get_footer(); ?>