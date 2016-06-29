<?php get_header();
global $more, $oi_options;
$more = 0;
?>

<?php if($oi_options['top_slider_area'] == true){ ?>
<style>
.oi_small_need_absolute_index {width:20%; position:absolute; top:650px; right:30%; }
.oi_big_sidebar_bottom.oi_need_absolute_index { width:30%;  position:absolute; top:650px; right:0px;}
.admin-bar .oi_small_need_absolute_index {width:20%; position:absolute; top:682px; right:30%; }
.admin-bar .oi_big_sidebar_bottom.oi_need_absolute_index { width:30%;  position:absolute; top:682px; right:0px;}
.admin-bar.archive .oi_big_sidebar_bottom.oi_need_absolute_index { width:30%;  position:absolute; top:282px; right:0px;}

</style>
<?php
    // Loop
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 20,
		'meta_query' => array(
		'relation' => 'OR',
			array(
				'key' => 'oi_featured',
				'value' => 'Yes',
				'compare' => 'LIKE'
			)
	)
	);
	$the_query = new WP_Query( $args );

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


<div class="oi_big_sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Big Sidebar"))  ?>
</div>


<div class="oi_post_sticky_holder oi_flex_loading oi_vc_gal">
    <ul class="slides">
	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
   		<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); ?>
    	 <li>
         <div class="oi_post_sticky" style="background:url('<?php echo $large_image_url[0]?>'); width:100%;">
            <div class="oi_tringle"></div>
            <div class="oi_post_sticky_meta">
                <h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h3>
            	<?php echo get_post_meta(get_the_ID(), 'post-descr', true); ?>
            </div>
            <div class="hidden-lg oi_post_sticky_meta_smalldev">
				<h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h3>
            	<?php echo get_post_meta(get_the_ID(), 'post-descr', true); ?>
            </div>
        </div>
        </li>
	<?php endwhile;  ?>
    <?php endif; ?>

    </ul>
</div>


<?php };?>





<div id="posts_holder" class="oi_posts_holder" data-sticky_parent>
	<?php if ( !is_archive() ) { ?>
	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts('paged='.$paged.'&cat='.$cat); ?>
    <?php } ?>
    <?php if (!(have_posts())) { ?><h3 class="page_title">There are no posts</h3><?php }  ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<?php $layout = get_post_meta($post->ID, 'posts_layout', 1);
		if ($layout == 'Wide'){?>
       	<div <?php post_class('oi_wide_post'); ?> id="post-<?php the_ID(); ?>">
            <div class="blog_item">
                <?php $format = get_post_format(); get_template_part( 'framework/post-format/format', $format );   ?>
            </div>
        </div>
        <?php }else {?>
        <div <?php post_class('oi_post'); ?> id="post-<?php the_ID(); ?>">
            <div class="blog_item">
                <?php $format = get_post_format(); get_template_part( 'framework/post-format/format', $format );   ?>
            </div>
        </div>
        <?php };?>
    <?php endwhile;  ?>
	<?php endif; ?>
    <?php if (function_exists('wp_corenavi')) { ?><div class="oi_pg"><?php wp_corenavi(); ?><div class="clearfix"></div></div><?php }?>
</div>

<div class="oi_small_sidebar_bottom" data-sticky_column>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Small Sidebar"))  ?>
</div>
<div class="oi_big_sidebar_bottom visible-lg">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Big Sidebar Bottom"))  ?>
</div>

<?php get_footer(); ?>
