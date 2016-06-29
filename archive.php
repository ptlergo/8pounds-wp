<?php get_header();
global $more;
$more = 0;
?>

<div class="oi_archive_cat">
    <div class="oi_archive_cat_inner">
    
    <?php
    $cat_id = get_query_var('cat');
    $cat_data = get_option("category_$cat_id");
    echo '<div class="oi_cat_overlay"><h1 class="oi_legend_cat">'.get_cat_name($cat_id).'</h1><h4 class="oi_cat_descr">'.category_description( $cat_id ).'</h4></div>';
    echo '<div class="oi_archive_posts_counts">'.wp_get_cat_postcount($cat_id).' Posts</div>';

    ?>
    </div>
</div>
<div class="oi_posts_holder oi_archive" id="posts_holder">
	<?php if ( !is_archive() ) { ?>
	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts('paged='.$paged.'&cat='.$cat); ?>		
    <?php } ?> 
    <?php if (!(have_posts())) { ?><h3 class="page_title">There are no posts</h3><?php }  ?>   
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


<div class="oi_big_sidebar_bottom visible-lg">
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