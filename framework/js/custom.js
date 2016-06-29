jQuery.noConflict()(function($){
	$('.oi_categories_list a').hover(function() {
		$( this ).toggleClass('oi_hovered');
	});
	$(' .alignnone').addClass('img-responsive');
	$('.alignnone img').addClass('img-responsive');
	$('.blog_item .size-full').addClass('img-responsive');
	$('div.wp-caption').removeAttr('style')
	
	$('.oi_page a').addClass('colored-a');
	$('.oi_posts_holder .blog_item .oi_post_descr_preview a').addClass('colored-a');
	$('.oi_single_post_conent a').addClass('colored-a');
	
	
	var w = $('.oi_categories_place').outerWidth(true);
	$('.oi_post_sticky_meta').css('width', w+'px');
	$( window ).resize(function() {
		var w = $('.oi_categories_place').outerWidth();
		$('.oi_post_sticky_meta').css('width', w+'px');
	});
	$('.oi_tringle').css('left',w);
	
	
	var ml = $('.oi_logo_inner_holder').css('margin-left');
	var logo_holder_width = $('.oi_logo_inner_holder').outerWidth();
	$('.oi_post_sticky_title').css('margin-left',ml)
	$('.oi_page_holder').css('padding-left',ml);
	$('.oi_archive .oi_post_meta_data_holder').css('width',w)
	$('.oi_archive .oi_blog_post_meta').css('width',(Math.floor($('body').outerWidth()/2) - w))
	$( window ).resize(function() {
		var ml = $('.oi_logo_inner_holder').css('margin-left');
		$('.oi_post_sticky_title').css('margin-left',ml)
		$('.oi_archive_cat').css('margin-left',ml)
		$('.oi_archive').css('width',logo_holder_width)
	});
	
	
	
	$(document).ready(function(){
	  $('.oi_rigth_menu_place_top_member_area').hide();
	 
	  $('.oi_after_logo_search').hide();
	});
	
	$( ".fa-search-plus" ).click(function() {
		$( ".oi_after_logo_search" ).slideToggle( "fast" );
		$( ".fa-search-plus" ).toggleClass('fa-search-minus')
	})
	
	$( ".oi_member.oi_login" ).click(function() {
		$( ".oi_rigth_menu_place_top_member_area.oi_login" ).slideToggle( "fast" )
	});
	$( ".oi_close.close_login" ).click(function() {
		$( ".oi_rigth_menu_place_top_member_area.oi_login" ).slideToggle( "fast" )
	});
	
	$( ".oi_registration" ).click(function() {
		$( ".oi_rigth_menu_place_top_member_area.oi_register" ).slideToggle( "fast" )
	});
	$( ".oi_close.close_register" ).click(function() {
		$( ".oi_rigth_menu_place_top_member_area.oi_register" ).slideToggle( "fast" )
	});
	
});

	
jQuery.noConflict()(function($){
	$( ".oi_login_submit" ).click(function(e) {
		var tempurl = oi_theme.theme_url;
		var login = $('#user_login').val()
		var password = $('#user_pass').val()
		var input_data = $("#oi_login_form").serialize();
			$.ajax({
				type: "POST",
				url: tempurl+"/framework/oi_login.php",
				data: input_data,
				success: function(result){
					if(result.oi_error != ""){
						$(".oi_errors").html(result.oi_error);
					}else { location.reload();}
				}
			});
			return false;  
		e.preventDefault();
	}); 
});


jQuery.noConflict()(function($){
	$( ".oi_register_submit" ).click(function(e) {
		var tempurl = oi_theme.theme_url;
		var input_data = $("#oi_register_form").serialize();
			$.ajax({
				type: "POST",
				url: tempurl+"/framework/oi_register.php",
				data: input_data,
				success: function(result){
					if(result.oi_error != ""){
						$(".oi_errors").html(result.oi_error);
					}else { location.reload();}
				}
			});
			return false;  
		e.preventDefault();
	}); 
});

	


jQuery.noConflict()(function($){
	var mr = $('.oi_logo_inner_holder').css('margin-left')
	$('.oi_single_post_meta').css('width',mr)
	var mw = $('.oi_single_post').outerWidth();
	$('.oi_single_post_images').css('margin-left',mr);
	$('.oi_single_post_standard').css('margin-left',mr);
	$('.oi_commente_holder').css('margin-left',mr);
	$(window).load(function(){
	var avatar_h = $('.oi_author_avatar').outerHeight();
	$('.oi_post_content').css('min-height',avatar_h)
	});
	
});
jQuery.noConflict()(function($){
	
	
	
	$(window).load(function(){
	if(oi_theme.sticky_sidebars == true){
		if($('.oi_single_post').outerHeight() > $(".oi_big_sidebar_bottom").outerHeight()){
			$(".oi_big_sidebar_bottom").addClass('oi_need_absolute');
			$(".oi_big_sidebar_bottom").stick_in_parent();
		};
		var h1 = $('.oi_posts_holder').outerHeight();
		var h2 = $(".oi_big_sidebar_bottom").outerHeight()
		if( h1> h2){
			$(".oi_big_sidebar_bottom").addClass('oi_need_absolute_index');
			$(".oi_small_sidebar_bottom").addClass('oi_small_need_absolute_index');
			$(".oi_big_sidebar_bottom, .oi_small_sidebar_bottom").stick_in_parent();
		};
		
		
		var hh1 = $('#page_holder').outerHeight();
		var hh2 = $(".oi_big_sidebar_bottom").outerHeight()
		if( hh1> hh2){
			$(".oi_big_sidebar_bottom").addClass('oi_need_absolute');
			$(".oi_small_sidebar_bottom").addClass('oi_small_need_absolute');
			$(".oi_big_sidebar_bottom, .oi_small_sidebar_bottom").stick_in_parent();
		};
		
	};
	});
	
});


jQuery.noConflict()(function($){
	$('.oi_vc_gal').flexslider({
		prevText: "",           //String: Set the text for the "previous" directionNav item
		nextText: "",  
		animation: "fade",
		useCSS: false,
		controlNav: false,
		directionNav: false,
		animationLoop: true,
		slideshow: true,
		slideshowSpeed: 3000,
		pauseOnHover: true, 
		start: function(slider) {
			slider.removeClass('oi_flex_loading');
		}  
	});
});


jQuery.noConflict()(function($){
	$('.oi_page_post_slider').flexslider({
		prevText: "",           //String: Set the text for the "previous" directionNav item
		nextText: "",  
		animation: "fade",
		useCSS: false,
		controlNav: false,
		directionNav: true,
		animationLoop: true,
		slideshow: true,
		slideshowSpeed: 3000,
		pauseOnHover: true, 
		
	});
});





jQuery.noConflict()(function($){

	if(oi_theme.css_animation == true){

	$('.oi_post').addClass("oi_hidden").viewportChecker({
		classToAdd: 'oi_visible animated bounceInUp',
		offset: 100
	});
	
	$('.oi_widget').addClass("oi_hidden").viewportChecker({
		classToAdd: 'oi_visible animated fadeIn',
		offset: 0
	});
	};
	
	$('.oi_categories_list > li > ul').hide()
	$('.oi_categories_place').hover(function() {
		$('.oi_rigth_menu_place').toggleClass('oi_need_margin_for_cat')
		$('.oi_categories_place').toggleClass('oi_abs_cat')
		$('.oi_categories_list > li > ul').slideToggle('fast')
	});

});

jQuery.noConflict()(function($){
	$( ".oi_show_mobile_menu" ).click(function() {
		$( ".oi_smalldev_categories_list" ).toggleClass('oi_visible_menu')
	})
	
	$( ".oi_main_menu_opener" ).click(function() {
		$( ".header_menu" ).toggleClass('oi_visible_main_menu')
	});
	
	 if ($( ".oi_categories_list > li" ).length  == 2 ) {
		 $('.oi_categories_list > li').css('margin-top','40px');
		 $('.oi_categories_list > li').css('margin-bottom','40px');
	};
	if ($( ".oi_categories_list > li" ).length  == 3 ) {
		 $('.oi_categories_list > li').css('margin-top','20px');
		 $('.oi_categories_list > li').css('margin-bottom','20px');
	};
	if ($( ".oi_categories_list > li" ).length  == 4 ) {
		 $('.oi_categories_list > li').css('margin-top','15px');
		 $('.oi_categories_list > li').css('margin-bottom','15px');
	};
	if ($( ".oi_categories_list > li" ).length  == 5 ) {
		 $('.oi_categories_list > li').css('margin-top','10px');
		 $('.oi_categories_list > li').css('margin-bottom','10px');
	};
});

