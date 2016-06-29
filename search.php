<?php get_header();?>
<div id="posts_holder" class="oi_posts_holder" data-sticky_parent>
    <?php if (!(have_posts())) { ?>
    <div class="oi_post" style="padding:30px;">
    	<h2 style="margin-top:0px;"><?php _e("Search Results for:","orangeidea"); ?> <strong class="colored"><?php echo get_search_query();?></strong></h2>
    <div class="alert alert-danger">
        <strong>Nothing was found!</strong> Change a few things up and try submitting again.
    </div>
    </div>
	<?php }else { ?>
    <div class="oi_post" style="padding:30px;">
    	<h2 style="margin-top:0px;"><?php _e("Search Results for:","orangeidea"); ?> <strong class="colored"><?php echo get_search_query();?></strong></h2>
    	<hr>
    </div>
    <?php };?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div <?php post_class('oi_post'); ?> id="post-<?php the_ID(); ?>">
            <div class="blog_item">
                <?php $format = get_post_format(); get_template_part( 'framework/post-format/format', $format );   ?>
            </div>
        </div>
    <?php endwhile;  ?>
	<?php endif; ?>
    <?php if (function_exists('wp_corenavi')) { ?><div class="oi_pg"><?php wp_corenavi(); ?><div class="clearfix"></div></div><?php }?>
</div>

<div class="oi_small_sidebar_bottom visible-lg" data-sticky_column>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Small Sidebar"))  ?>
</div>
<div class="oi_big_sidebar_bottom visible-lg">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Big Sidebar Bottom"))  ?>
</div>


<?php get_footer(); ?>
<?php get_footer(); ?>
