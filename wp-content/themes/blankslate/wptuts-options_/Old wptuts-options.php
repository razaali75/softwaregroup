<?php

function wptuts_get_default_options() {
	$options = array(
		'logo' => '',
		'logo_ids'=>''
	);
	return $options;
}


function theme_options_init() {
     $wptuts_options1 = get_option( 'theme_homepage_options' );
	 
	 // Are our options saved in the DB?
     if ( false === $wptuts_options1 ) {
		  // If not, we'll save our default options
          $wptuts_options1 = wptuts_get_default_options();
		  add_option( 'theme_homepage_options', $wptuts_options1 );
     }
	 
	 
//     $wptuts_options2 = get_option( 'theme_foundations_options' );
	 
	 // Are our options saved in the DB?
//     if ( false === $wptuts_options2 ) {
//		  // If not, we'll save our default options
//          $wptuts_options2 = wptuts_get_default_options();
//		  add_option( 'theme_foundations_options', $wptuts_options2 );
//     }	 
	 
	 
     // In other case we don't need to update the DB
}
// Initialize Theme options
add_action( 'after_setup_theme', 'theme_options_init' );

function theme_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we'll replace the 'Insert into Post Button inside Thickbox' 
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'theme_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), 'wptuts-settings' );
		if ( $referer != '' ) {
			return __('I want this to be my logo!', 'wptuts' );
		}
	}

	return $translated_text;
}

// Add "WPTuts Options" link to the "Appearance" menu
function theme_menu_options() {
	//add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
     add_theme_page('Homepage Options', 'Homepage Options', 'edit_theme_options', 'wptuts-settings', 'theme_admin_options_page');
 
}
// Load the Admin Options page
add_action('admin_menu', 'theme_menu_options');

function theme_admin_options_page() {
	?>
		<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php _e( 'Home Page Options', 'wptuts' ); ?></h2>
			
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'wptuts-settings-errors' ); ?>
			
			<form id="form-wptuts-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_homepage_options');
//					settings_fields('theme_foundation_options');					
					do_settings_sections('wptuts');
				?>
			
				<p class="submit">
					<input name="theme_homepage_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'wptuts'); ?>" />
					<input name="theme_homepage_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'wptuts'); ?>" />		
				</p>
			
			</form>
			
		</div>

	

        
        
        
        
	<?php
}




function theme_options_validate( $input ) {
	$default_options = wptuts_get_default_options();
	$valid_input = $default_options;
	
	$wptuts_options1 = get_option('theme_homepage_options');
//	$wptuts_options2 = get_option('theme_foundation_options');	
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;

//print_r($input);
//exit();	
	if ( $submit ) {
		if ( $wptuts_options1['logo'] != $input['logo']  && $wptuts_options1['logo'] != '' )
			delete_image( $wptuts_options1['logo'] );
		
		$valid_input['logo'] = $input['logo'];
		$valid_input['logo_ids'] = rtrim($input['logo_ids'], ',');;	

		$valid_input['logo2'] = $input['logo2'];
		$valid_input['logo_ids2'] = rtrim($input['logo_ids2'],',');		


		$valid_input['logo3'] = $input['logo3'];
		$valid_input['logo_ids3'] = rtrim($input['logo_ids3'],',');		
		
		$valid_input['donatetoday_link'] = $input['donatetoday_link'];
		$valid_input['donatetoday'] = $input['donatetoday'];
		$valid_input['svideo_title'] = $input['svideo_title'];
		$valid_input['svideo_subtitle'] = $input['svideo_subtitle'];
		$valid_input['svideo_linktitle'] = $input['svideo_linktitle'];
		$valid_input['svideo_linktext'] = $input['svideo_linktext'];
		$valid_input['svideo_link'] = $input['svideo_link'];
		$valid_input['svideo_Ulink'] = $input['svideo_Ulink'];
		$valid_input['htags_h1'] = $input['htags_h1'];
		$valid_input['htags_h2'] = $input['htags_h2'];
		$valid_input['area_Wbtn1'] = $input['area_Wbtn1'];
		$valid_input['area_Wbtn2'] = $input['area_Wbtn2'];
		$valid_input['area_Wbtn3'] = $input['area_Wbtn3'];
		$valid_input['area_Sbtn1'] = $input['area_Sbtn1'];
		$valid_input['area_Sbtn2'] = $input['area_Sbtn2'];
		$valid_input['area_Sbtn3'] = $input['area_Sbtn3'];
		$valid_input['area_Sbtn4'] = $input['area_Sbtn4'];
		$valid_input['area_Sbtn5'] = $input['area_Sbtn5'];
		$valid_input['area_Sbtn6'] = $input['area_Sbtn6'];


		$valid_input['visit_title'] = $input['visit_title'];
		$valid_input['visit_text'] = $input['visit_text'];
		$valid_input['register_title'] = $input['register_title'];
		$valid_input['register_text'] = $input['register_text'];
		$valid_input['shop_title'] = $input['shop_title'];
		$valid_input['shop_text'] = $input['shop_text'];
		$valid_input['shop_link'] = $input['shop_link'];												




		
	}
	elseif ( $reset ) {
		delete_image( $wptuts_options1['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		delete_image( $wptuts_options1['logo'] );
		$valid_input['logo'] = '';
		$valid_input['logo_ids'] = '';		
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	
	// We need to get the image's meta ID..
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);

	// And delete them (if more than one attachment is in the Library
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function wptuts_options_enqueue_scripts() {
	wp_register_script( 'wptuts-upload', get_template_directory_uri() .'/wptuts-options/js/wptuts-upload.js', array('jquery','media-upload','thickbox') );	

	if ( 'appearance_page_wptuts-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('wptuts-upload');
		
		wp_enqueue_script('editor');

//wp_enqueue_script('tiny_mce');		
		
	}
	
}
add_action('admin_enqueue_scripts', 'wptuts_options_enqueue_scripts');


function theme_options_settings_init() {
	register_setting( 'theme_homepage_options', 'theme_homepage_options', 'theme_options_validate' );
	//register_setting( 'theme_foundation_options', 'theme_foundation_options', 'theme_options_validate' );	

//********************** Logo Area ***********************************
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_logo', __( 'Site Logo', 'wptuts' ), 'logo_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_logo_Field',  __( 'Logo', 'wptuts' ), 'wptuts_setting_logo_Field', 'wptuts', 'wptuts_settings_header_logo');
	// Add Current Image Preview 
	add_settings_field('wptuts_setting_logo_preview',  __( 'Logo Preview', 'wptuts' ), 'wptuts_setting_logo_preview', 'wptuts', 'wptuts_settings_header_logo');
	
	
//********************** Image Slider Area ***********************************	
	// Add a form section for the Main Image Area 
	add_settings_section('wptuts_settings_header_mainimage', __( 'Main Image Area', 'wptuts' ), 'ImagesSlider_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_mainImage_Field',  __( 'Main Image', 'wptuts' ), 'wptuts_setting_mainImage_Field', 'wptuts', 'wptuts_settings_header_mainimage');
	// Add Current Image Preview 
	add_settings_field('wptuts_setting_mainImage_preview',  __( 'Main Image Preview', 'wptuts' ), 'wptuts_setting_mainImage_preview', 'wptuts', 'wptuts_settings_header_mainimage');


	
//********************** Donation Bar ***********************************		
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_donatetoday', __( 'Donate Today Bar', 'wptuts' ), 'donationbar_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_donate_Field',  __( 'Donate Today Bar text', 'wptuts' ), 'wptuts_setting_donate_Field', 'wptuts', 'wptuts_settings_header_donatetoday');

	// Add Logo uploader
	add_settings_field('wptuts_setting_donatetoday_link',  __( 'Donate Today Bar URL', 'wptuts' ), 'wptuts_setting_donatetoday_link', 'wptuts', 'wptuts_settings_header_donatetoday');	



//********************** Short Video ***********************************		
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_shortvideo', __( 'Short Video ', 'wptuts' ), 'shortvideo_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_svideo_Title',  __( 'Title', 'wptuts' ), 'wptuts_setting_svideo_Title', 'wptuts', 'wptuts_settings_header_shortvideo');

	// Add Logo uploader
	add_settings_field('wptuts_setting_svideo_subtitle',  __( 'Sub Title', 'wptuts' ), 'wptuts_setting_svideo_subtitle', 'wptuts', 'wptuts_settings_header_shortvideo');	


	// Add Logo uploader
	add_settings_field('wptuts_setting_svideo_linktitle',  __( 'Link Title', 'wptuts' ), 'wptuts_setting_svideo_linktitle', 'wptuts', 'wptuts_settings_header_shortvideo');	


	// Add Logo uploader
	add_settings_field('wptuts_setting_svideo_linktext',  __( 'Link Text', 'wptuts' ), 'wptuts_setting_svideo_linktext', 'wptuts', 'wptuts_settings_header_shortvideo');	


	// Add Logo uploader
	add_settings_field('wptuts_setting_svideo_link',  __( 'Link URL', 'wptuts' ), 'wptuts_setting_svideo_link', 'wptuts', 'wptuts_settings_header_shortvideo');	

	// Add Logo uploader
	add_settings_field('wptuts_setting_svideo_Ulink',  __( 'youtube Link', 'wptuts' ), 'wptuts_setting_svideo_Ulink', 'wptuts', 'wptuts_settings_header_shortvideo');	



//********************** H1 area ***********************************		

	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_Htags', __( 'Welcome Home H1', 'wptuts' ), 'Htags_settings_header_text', 'wptuts');

	// Add Logo uploader
	add_settings_field('wptuts_setting_Htags_H1',  __( 'H1 Text', 'wptuts' ), 'wptuts_setting_Htags_H1', 'wptuts', 'wptuts_settings_header_Htags');


	// Add Logo uploader
	add_settings_field('wptuts_setting_Htags_H2',  __( 'H2 Text ', 'wptuts' ), 'wptuts_setting_Htags_H2', 'wptuts', 'wptuts_settings_header_Htags');



//********************** Widget Button & Social Links ***********************************		
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_WBSK', __( 'Widget buttons and Social Links', 'wptuts' ), 'WBSL_settings_header_text', 'wptuts');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Wbtn1',  __( 'Widget box1 Text ', 'wptuts' ), 'wptuts_setting_area_Wbtn1', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Wbtn2',  __( 'Widget Box2 Text', 'wptuts' ), 'wptuts_setting_area_Wbtn2', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Wbtn3',  __( 'Widget Box3 Text', 'wptuts' ), 'wptuts_setting_area_Wbtn3', 'wptuts', 'wptuts_settings_header_WBSK');


	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Sbtn1',  __( 'Google Plus ', 'wptuts' ), 'wptuts_setting_area_Sbtn1', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Sbtn2',  __( 'Linked-In', 'wptuts' ), 'wptuts_setting_area_Sbtn2', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Sbtn3',  __( 'FaceBook ', 'wptuts' ), 'wptuts_setting_area_Sbtn3', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Sbtn4',  __( 'Twitter', 'wptuts' ), 'wptuts_setting_area_Sbtn4', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Sbtn5',  __( 'Rss ', 'wptuts' ), 'wptuts_setting_area_Sbtn5', 'wptuts', 'wptuts_settings_header_WBSK');

	// Add Logo uploader
	add_settings_field('wptuts_setting_area_Sbtn6',  __( 'Youtube ', 'wptuts' ), 'wptuts_setting_area_Sbtn6', 'wptuts', 'wptuts_settings_header_WBSK');



//********************** Image Slider Area ***********************************	
	// Add a form section for the Main Image Area 
	add_settings_section('wptuts_settings_header_gallery', __( '5 Gallery Button Images', 'wptuts' ), 'Gallary_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_gallery_Field',  __( 'Gallery Image', 'wptuts' ), 'wptuts_setting_gallery_Field', 'wptuts', 'wptuts_settings_header_gallery');
	// Add Current Image Preview 
	add_settings_field('wptuts_setting_gallery_preview',  __( 'Gallery Image Preview', 'wptuts' ), 'wptuts_setting_gallery_preview', 'wptuts', 'wptuts_settings_header_gallery');



//********************** Image Slider Area ***********************************	
	// Add a form section for the Main Image Area 
	add_settings_section('wptuts_settings_header_raiseMoney', __( 'Raise Money ', 'wptuts' ), 'raiseMoney_settings_header_text', 'wptuts');

	// Add Logo visit
	add_settings_field('wptuts_setting_visit_title',  __( 'Visit Title', 'wptuts' ), 'wptuts_setting_visit_title', 'wptuts', 'wptuts_settings_header_raiseMoney');

	// Add Logo uploader
	add_settings_field('wptuts_setting_visit_text',  __( 'Visit Text', 'wptuts' ), 'wptuts_setting_visit_text', 'wptuts', 'wptuts_settings_header_raiseMoney');

	// Add Logo register
	add_settings_field('wptuts_setting_register_title',  __( 'Register Title', 'wptuts' ), 'wptuts_setting_register_title', 'wptuts', 'wptuts_settings_header_raiseMoney');


	// Add Logo uploader
	add_settings_field('wptuts_setting_register_text',  __( 'Register Text', 'wptuts' ), 'wptuts_setting_register_text', 'wptuts', 'wptuts_settings_header_raiseMoney');


	// Add Logo shop
	add_settings_field('wptuts_setting_shop_title',  __( 'Shop Title', 'wptuts' ), 'wptuts_setting_shop_title', 'wptuts', 'wptuts_settings_header_raiseMoney');

	// Add Logo uploader
	add_settings_field('wptuts_setting_shop_text',  __( 'Shop Text', 'wptuts' ), 'wptuts_setting_shop_text', 'wptuts', 'wptuts_settings_header_raiseMoney');

	// Add Logo uploader
	add_settings_field('wptuts_setting_shop_link',  __( 'Shop Link', 'wptuts' ), 'wptuts_setting_shop_link', 'wptuts', 'wptuts_settings_header_raiseMoney');









	
}
add_action( 'admin_init', 'theme_options_settings_init' );

function wptuts_setting_logo_preview() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );  ?>
	<?php
		//$existing_photos_html = get_photos_html();		
	?>
    
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options1['logo'] ); ?>" />

	</div>
<style>
.vr_venue_instructions {
	font-style: italic;
	padding-bottom: 1em;
}
#vr_venue_photos_container {
	overflow: hidden;
}
#vr_venue_photos_container li {
	float: left;
	background-color: #ccc;
	width: 85px;
	height: 85px;
	border-radius: 4px;
	margin: 0 20px 20px 0;
	position: relative
}
#vr_venue_photos_container .vr_photo {
	cursor: move;
	margin: 5px 0 0 5px;
	width: 75px;
	height: 75px;
}


#vr_venue_photos_container2 {
	overflow: hidden;
}
#vr_venue_photos_container2 li {
	float: left;
	background-color: #ccc;
	width: 85px;
	height: 85px;
	border-radius: 4px;
	margin: 0 20px 20px 0;
	position: relative
}
#vr_venue_photos_container2 .vr_photo {
	cursor: move;
	margin: 5px 0 0 5px;
	width: 75px;
	height: 75px;
}

#vr_venue_photos_container3 {
	overflow: hidden;
}
#vr_venue_photos_container3 li {
	float: left;
	background-color: #ccc;
	width: 85px;
	height: 85px;
	border-radius: 4px;
	margin: 0 20px 20px 0;
	position: relative
}
#vr_venue_photos_container3 .vr_photo {
	cursor: move;
	margin: 5px 0 0 5px;
	width: 75px;
	height: 75px;
}




</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script language="javascript">
(function() {

var $ = jQuery; 

//i don't really dig wrapping this stuff in a document ready call, but as WordPress loads the libraries beneath
//this, there's not really a better option
$(initPhotos);


function initPhotos() {
//	alert(vrSwfUploadSettings.flash_url);
	var buildingPhotosContainer = $('#vr_venue_photos_container');
	buildingPhotosContainer.sortable({ containment: 'parent' ,update: function(ev,ui) {
var stortedval='';

$( "#vr_venue_photos_container li img" ).each(function( index ) {
	if (index%2===0){
		console.log( index + ": " + $(this).attr('data-id') );
		stortedval=stortedval+$(this).attr('data-id')+',';
//		alert(index  );
	}
});
$('#img_ids1').val(stortedval.slice(0,-1));	
//alert(stortedval);

	}});





	var buildingPhotosContainer = $('#vr_venue_photos_container2');
	buildingPhotosContainer.sortable({ containment: 'parent' ,update: function(ev,ui) {
var stortedval='';

$( "#vr_venue_photos_container2 li img" ).each(function( index ) {
	if (index%2===0){
		console.log( index + ": " + $(this).attr('data-id') );
		stortedval=stortedval+$(this).attr('data-id')+',';
//		alert(index  );
	}
});
$('#img_ids2').val(stortedval.slice(0,-1));	
//alert(stortedval);

	}});




	var buildingPhotosContainer = $('#vr_venue_photos_container3');
	buildingPhotosContainer.sortable({ containment: 'parent' ,update: function(ev,ui) {
var stortedval='';

$( "#vr_venue_photos_container3 li img" ).each(function( index ) {
	if (index%2===0){
		console.log( index + ": " + $(this).attr('data-id') );
		stortedval=stortedval+$(this).attr('data-id')+',';
//		alert(index  );
	}
});
$('#img_ids3').val(stortedval.slice(0,-1));	
//alert(stortedval);

	}});
	
}



})();

</script>


<?php

}


function wptuts_setting_mainImage_preview() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );  ?>
<?php
		$existing_photos_html = get_photos_html_mainImages();		
	?>    
    
	<div id="upload_logo_preview" style="min-height: 100px;">
		<p class="vr_venue_instructions">
			Note: To reorder the photos, simply drag them into place. Make sure you save the building after reordering.
		</p>
    
		<ul id="vr_venue_photos_container2">
			<?php echo $existing_photos_html ?>
		</ul>    

	</div>
 
<?php
}


function wptuts_setting_gallery_preview() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );  ?>
<?php
		$existing_photos_html = get_photos_html_gallery();		
	?>    
    
	<div id="upload_logo_preview" style="min-height: 100px;">
		<p class="vr_venue_instructions">
			Note: To reorder the photos, simply drag them into place. Make sure you save the building after reordering.
		</p>
    
		<ul id="vr_venue_photos_container3">
			<?php echo $existing_photos_html ?>
		</ul>    

	</div>
 
<?php
}


function get_photos_html() {
		$post_attachments = get_option( 'theme_homepage_options' );
		if (!empty($post_attachments['logo_ids']))
		{  
			$post = explode(",", $post_attachments['logo_ids']);
		}else{ $post =isset($post_attachments['logo_ids'])?$post_attachments['logo_ids']:"";}

//print_r($post);


		$delete_icon_src = get_template_directory_uri() .'/wptuts-options/images/delete.png';
		
		$existing_photos_html = '';
if (!empty($post ))	{	
		foreach ($post as $attachment) {
			$photo_thumb = image_downsize($attachment, 'thumbnail');
			$existing_photos_html .= "<li style=\"float:left;margin: 0 20px 20px 0;\">";
			$existing_photos_html .= "<img src=\"{$photo_thumb[0]}\"  data-id=\"{$attachment}\" class=\"vr_photo\" />";
			$existing_photos_html .= "<img id='delete1' src=\"{$delete_icon_src}\" data-id=\"{$attachment}\" class=\"vr_delete_photo\" />";
			$existing_photos_html .= "</li>\n";
		}
}
		return $existing_photos_html;
	}

function get_photos_html_mainImages() {
		$post_attachments = get_option( 'theme_homepage_options' );
		if (!empty($post_attachments['logo_ids2']))
		{  
			$post = explode(",", $post_attachments['logo_ids2']);
		}else{ $post =isset($post_attachments['logo_ids2'])?$post_attachments['logo_ids2']:"";}

//print_r($post);


		$delete_icon_src = get_template_directory_uri() .'/wptuts-options/images/delete.png';
		
		$existing_photos_html = '';
if (!empty($post ))	{	
		foreach ($post as $attachment) {
			$photo_thumb = image_downsize($attachment, 'thumbnail');
			$existing_photos_html .= "<li style=\"float:left;margin: 0 20px 20px 0;\">";
			$existing_photos_html .= "<img src=\"{$photo_thumb[0]}\"  data-id=\"{$attachment}\" class=\"vr_photo\" />";
			$existing_photos_html .= "<img id='delete2' src=\"{$delete_icon_src}\" data-id=\"{$attachment}\" class=\"vr_delete_photo\" />";
			$existing_photos_html .= "</li>\n";
		}
}
		return $existing_photos_html;
	}




function get_photos_html_gallery() {
		$post_attachments = get_option( 'theme_homepage_options' );
		if (!empty($post_attachments['logo_ids3']))
		{  
			$post = explode(",", $post_attachments['logo_ids3']);
		}else{ $post =isset($post_attachments['logo_ids3'])?$post_attachments['logo_ids3']:"";}

//print_r($post);


		$delete_icon_src = get_template_directory_uri() .'/wptuts-options/images/delete.png';
		
		$existing_photos_html = '';
if (!empty($post ))	{	
		foreach ($post as $attachment) {
			$photo_thumb = image_downsize($attachment, 'thumbnail');
			$existing_photos_html .= "<li style=\"float:left;margin: 0 20px 20px 0;\">";
			$existing_photos_html .= "<img src=\"{$photo_thumb[0]}\"  data-id=\"{$attachment}\" class=\"vr_photo\" />";
			$existing_photos_html .= "<img id='delete3' src=\"{$delete_icon_src}\" data-id=\"{$attachment}\" class=\"vr_delete_photo\" />";
			$existing_photos_html .= "</li>\n";
		}
}
		return $existing_photos_html;
	}







function logo_settings_header_text() {
	?>
		<p><?php _e( 'Upload Site Logo for Theme.', 'wptuts' ); ?></p>
	<?php
}

function ImagesSlider_settings_header_text() {
	?>
		<p><?php _e( 'Upload Main Slider Image for Theme.', 'wptuts' ); ?></p>
	<?php
}

function donationbar_settings_header_text() {
	?>
		<p><?php _e( 'Donation Bar Options for Theme.', 'wptuts' ); ?></p>
	<?php
}


function shortvideo_settings_header_text() {
	?>
		<p><?php _e( 'Home Page Short Video for Theme.', 'wptuts' ); ?></p>
	<?php
}


function Htags_settings_header_text() {
	?>
		<p><?php _e( 'Home Page Heading for Theme.', 'wptuts' ); ?></p>
	<?php
}


function WBSL_settings_header_text() {
	?>
		<p><?php _e( 'Widget Button and Social Links for Theme.', 'wptuts' ); ?></p>
	<?php
}


function Gallary_settings_header_text() {
	?>
		<p><?php _e( 'Upload Gallary Image for Theme.', 'wptuts' ); ?></p>
	<?php
}


function raiseMoney_settings_header_text() {
	?>
		<p><?php _e( 'Raise Money for Theme.', 'wptuts' ); ?></p>
	<?php
}



function wptuts_setting_logo_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="hidden" id="logo_url1" name="theme_homepage_options[logo]" value="<?php echo esc_url( $wptuts_options1['logo'] ); ?>" />
		<input type="hidden" id="img_ids1" name="theme_homepage_options[logo_ids]" value="<?php echo  $wptuts_options1['logo_ids'] ; ?>" />        
		<input id="upload_logo_button1" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />

		<span class="description"><?php _e('Upload an image for the logo.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_mainImage_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="hidden" id="logo_url2" name="theme_homepage_options[logo2]" value="<?php echo esc_url( $wptuts_options1['logo2'] ); ?>" />
		<input type="hidden" id="img_ids2" name="theme_homepage_options[logo_ids2]" value="<?php echo  $wptuts_options1['logo_ids2'] ; ?>" />        
		<input id="upload_logo_button2" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options1['logo'] ): ?>
			<!-- input id="delete_logo_button2" name="theme_homepage_options[delete_logo2]" type="submit" class="button" value="<?php //_e( 'Delete Logo', 'wptuts' ); ?>" / -->
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the Slider.', 'wptuts' ); ?></span>
	<?php
}


function wptuts_setting_donate_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="donatetoday" name="theme_homepage_options[donatetoday]" value="<?php echo  $wptuts_options1['donatetoday'] ; ?>" />
		<span class="description"><?php _e('Text For Donate today.', 'wptuts' ); ?></span>
	<?php } 
	
function wptuts_setting_donatetoday_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="donatetoday_link" name="theme_homepage_options[donatetoday_link]" value="<?php echo esc_url( $wptuts_options1['donatetoday_link'] ); ?>" />
		<span class="description"><?php _e('Link For Donate today.', 'wptuts' ); ?></span>
	<?php } 
	
	
	
function wptuts_setting_svideo_Title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="svideo_title" name="theme_homepage_options[svideo_title]" value="<?php echo $wptuts_options1['svideo_title'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Title.', 'wptuts' ); ?></span>
	<?php } 
	


function wptuts_setting_svideo_subtitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="svideo_subtitle" name="theme_homepage_options[svideo_subtitle]" value="<?php echo $wptuts_options1['svideo_subtitle'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Sub Title .', 'wptuts' ); ?></span>
	<?php } 
	

function wptuts_setting_svideo_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="svideo_linktitle" name="theme_homepage_options[svideo_linktitle]" value="<?php echo $wptuts_options1['svideo_linktitle'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Link Title.', 'wptuts' ); ?></span>
	<?php } 
	


function wptuts_setting_svideo_linktext() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="svideo_linktext" name="theme_homepage_options[svideo_linktext]" value="<?php echo $wptuts_options1['svideo_linktext'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Link Text.', 'wptuts' ); ?></span>
	<?php } 
		

function wptuts_setting_svideo_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="svideo_link" name="theme_homepage_options[svideo_link]" value="<?php echo esc_url( $wptuts_options1['svideo_link'] ); ?>" />
		<span class="description"><?php _e('Text For Short Video Link.', 'wptuts' ); ?></span>
	<?php } 
	

function wptuts_setting_svideo_Ulink() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="svideo_Ulink" name="theme_homepage_options[svideo_Ulink]" value="<?php echo $wptuts_options1['svideo_Ulink'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Youtube Link.', 'wptuts' ); ?></span>
	<?php } 




function wptuts_setting_Htags_H1() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="htags_h1" name="theme_homepage_options[htags_h1]" value="<?php echo  $wptuts_options1['htags_h1'] ; ?>" />
		<span class="description"><?php _e('Text For H1 Tages.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_Htags_H2() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="htags_h2" name="theme_homepage_options[htags_h2]" value="<?php echo $wptuts_options1['htags_h2'] ; ?>" />
		<span class="description"><?php _e('Text For H2 Tages.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_area_Wbtn1() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Wbtn1" name="theme_homepage_options[area_Wbtn1]" value="<?php echo  $wptuts_options1['area_Wbtn1'] ; ?>" />
		<span class="description"><?php _e('Widget Button #1.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Wbtn2() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Wbtn2" name="theme_homepage_options[area_Wbtn2]" value="<?php echo  $wptuts_options1['area_Wbtn2'] ; ?>" />
		<span class="description"><?php _e('Widget Button #2.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_area_Wbtn3() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Wbtn3" name="theme_homepage_options[area_Wbtn3]" value="<?php echo esc_url( $wptuts_options1['area_Wbtn3'] ); ?>" />
		<span class="description"><?php _e('Widget Button #3.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn1() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Sbtn1" name="theme_homepage_options[area_Sbtn1]" value="<?php echo esc_url( $wptuts_options1['area_Sbtn1'] ); ?>" />
		<span class="description"><?php _e('Social Link For Google .', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn2() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Sbtn2" name="theme_homepage_options[area_Sbtn2]" value="<?php echo esc_url( $wptuts_options1['area_Sbtn2'] ); ?>" />
		<span class="description"><?php _e('Social Link For Linked-In .', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn3() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Sbtn3" name="theme_homepage_options[area_Sbtn3]" value="<?php echo  $wptuts_options1['area_Sbtn3'] ; ?>" />
		<span class="description"><?php _e('Social Link For Facebook.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn4() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Sbtn4" name="theme_homepage_options[area_Sbtn4]" value="<?php echo esc_url( $wptuts_options1['area_Sbtn4'] ); ?>" />
		<span class="description"><?php _e('Social Link For Twitter.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn5() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Sbtn5" name="theme_homepage_options[area_Sbtn5]" value="<?php echo esc_url( $wptuts_options1['area_Sbtn5'] ); ?>" />
		<span class="description"><?php _e('RSS Link.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn6() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="area_Sbtn6" name="theme_homepage_options[area_Sbtn6]" value="<?php echo esc_url( $wptuts_options1['area_Sbtn6'] ); ?>" />
		<span class="description"><?php _e('Social Link For Youtube.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="hidden" id="logo_url3" name="theme_homepage_options[logo3]" value="<?php echo esc_url( $wptuts_options1['logo3'] ); ?>" />
		<input type="hidden" id="img_ids3" name="theme_homepage_options[logo_ids3]" value="<?php echo  $wptuts_options1['logo_ids3'] ; ?>" />        
		<input id="upload_logo_button3" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options1['logo3'] ): ?>
			<!-- input id="delete_logo_button2" name="theme_homepage_options[delete_logo2]" type="submit" class="button" value="<?php //_e( 'Delete Logo', 'wptuts' ); ?>" / -->
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the Gallery Images.', 'wptuts' ); ?></span>
	<?php
}



function wptuts_setting_visit_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="visit_title" name="theme_homepage_options[visit_title]" value="<?php echo  $wptuts_options1['visit_title'] ; ?>" />
		<span class="description"><?php _e('Visit Title.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_visit_text() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="visit_text" name="theme_homepage_options[visit_text]" value="<?php echo  $wptuts_options1['visit_text'] ; ?>" />
		<span class="description"><?php _e('Visit Text.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_register_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="register_title" name="theme_homepage_options[register_title]" value="<?php echo  $wptuts_options1['register_title'] ; ?>" />
		<span class="description"><?php _e('Register Title.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_register_text() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="register_text" name="theme_homepage_options[register_text]" value="<?php echo  $wptuts_options1['register_text'] ; ?>" />
		<span class="description"><?php _e('Register Text', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_shop_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="shop_title" name="theme_homepage_options[shop_title]" value="<?php echo  $wptuts_options1['shop_title'] ; ?>" />
		<span class="description"><?php _e('Shop Title', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_shop_text() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="shop_text" name="theme_homepage_options[shop_text]" value="<?php echo  $wptuts_options1['shop_text'] ; ?>" />
		<span class="description"><?php _e('Shop Text', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_shop_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="shop_link" name="theme_homepage_options[shop_link]" value="<?php echo  $wptuts_options1['shop_link'] ; ?>" />
		<span class="description"><?php _e('Shop Link', 'wptuts' ); ?></span>
	<?php } 





	?>    