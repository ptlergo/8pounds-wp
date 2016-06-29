jQuery(document).ready(function() {
	var media_frame;
	var formlabel = 0;
	var fileInput = '';
 
 jQuery('.upload_image_button').click(function(e) {
     e.preventDefault();
     fileInput = jQuery(this).prev('input');
		if ( media_frame ) {
			  media_frame.open();
			  return;
		}
		media_frame = wp.media.frames.media_frame = wp.media({
			  className: 'media-frame new-media-frame',
			  frame: 'select',
			  multiple: false,
			  library: {
			  type: 'image'
			  },
		});
		media_frame.on('select', function(){
		var media_attachment = media_frame.state().get('selection').first().toJSON();
			  fileInput.val(media_attachment.id);
		});
	
		media_frame.open();
 });
});