<?php 
/*
Default Post Template
*/
get_header(); ?>
<?php if (!(have_posts())) { ?><h3 class="page_title">There are no posts</h3><?php }  ?>   
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div data-sticky_parent <?php post_class('oi_single_post'); ?> id="post-<?php the_ID(); ?>">
		<?php $format = get_post_format(); get_template_part( 'framework/post-format/single', $format );   ?>
		
    </div>

<?php endwhile; endif; ?>
<div class="oi_big_sidebar_bottom visible-lg" data-sticky_column>
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