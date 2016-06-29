<?php global $oi_options;?>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="oi_footer">
	<div class="oi_footer_left">
    	<?php echo $oi_options['footer_left'];?>
    </div>
    <div class="oi_footer_right">
    	<?php
		if ( has_nav_menu( 'secondary_menu' ) ){
			wp_nav_menu(array(
				'echo' => true,
				'container' => '',
				'theme_location' => 'secondary_menu',
				'menu_class' => 'list-unstyled footer_menu',
			));
			} else { echo 'Appearance -> Menus -> Create your menu -> Choose it in "Theme Location" block  as  Footer Navigation';}
		?>

    </div>
</div>
</body>
<?php wp_footer(); ?>
</html>