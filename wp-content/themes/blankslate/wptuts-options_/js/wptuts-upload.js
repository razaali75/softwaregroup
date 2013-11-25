jQuery(document).ready(function($){
//	$('#upload_logo_button1').click(function() {
	$('[id^="upload_logo_button"]').click(function() {		
		//type = image,audio,video,file. If we write it wrong, nothing will appear. type = file by default
		// El tipo no importa, ya que desde hace algunas versiones, el uploader puede subir cualquier tipo de archivo
		
		// Si no lo hacemos desde un meta box dentro de un post y además WP_DEBUG = true, nos saldrá un error ya que
		// no estará asociado a ningún post
		
		//tb_show(caption, url, imageGroup)
		// Google: 'ImageGroup tb_show thickbox':
		//The optional imageGroup parameter can also be used to pass in an array of images for a single or multiple image slide show gallery.
		
		str = $(this).attr('id');
//				alert(str);
		        substring = str.substring(str.length, str.length - 1);
//alert(substring );				
		
		// The problem is that inserting a gallery needs an associated post to work
		tb_show('Upload a logo', 'media-upload.php?referer=wptuts-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
		return false;
	});


	
//	$('.vr_delete_photo').live('click', function(e) { 
	$('[id^="delete"]').live('click', function(e) { 	
		        str = $(this).attr('id');
//				alert(str);
		        substring = str.substring(str.length, str.length - 1);
//				alert(substring);
//		        id_to_pass = 'upload_image_id' + substring;				
	var target = $(e.target);
	var full=$('#img_ids'+substring ).val()
	var selected=target.attr('data-id');
//	alert('you are deleting id '+target.attr('data-id'));


    var match = full.split(',')
	var newvar='';
    console.log(match)
    for (var a in match){
        var variable = match[a]
		if (variable != selected){
        console.log(variable)
		newvar=variable+','+newvar;
		}
    }

//alert(newvar.slice(0,-1));

$('#img_ids'+substring ).val(newvar.slice(0,-1));		

		$('#submit_options_form').trigger('click');

					return false;
	});
	


	
	
	
	window.send_to_editor = function(html) {
		// html returns a link like this:
		// <a href="{server_uploaded_image_url}"><img src="{server_uploaded_image_url}" alt="" title="" width="" height"" class="alignzone size-full wp-image-125" /></a>
		$('body').append('<div id="temp_image">' + html + '</div>');
		var img = $('#temp_image').find('img');
		imgurl   = img.attr('src');
		imgclass = img.attr('class');
		imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

				
		
//		var image_url = $('img',html).attr('src');
//			imgclass = image_url.attr('class');
//			imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);
		
//		alert(imgid);
if (substring ==1)
{
//		alert('#img_ids'+substring );	
		$('#logo_url'+substring).val(imgurl);
		$('#img_ids'+substring ).val(imgid);		
}
else {
//alert('#img_ids'+substring );
		$('#logo_url'+substring).val(imgurl);
		$('#img_ids'+substring ).val(imgid +','+$('#img_ids'+substring ).val());		

}

		tb_remove();
		$('#upload_logo_preview img').attr('src',imgurl);
		$('#submit_options_form').trigger('click');
		// $('#uploaded_logo').val('uploaded');
		
	}
	
	
	
});