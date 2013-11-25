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




		$valid_input['gallery_title'] = $input['gallery_title'];
		$valid_input['htags_h1_title'] = $input['htags_h1_title'];
		$valid_input['htags_h2_title'] = $input['htags_h2_title'];

		$valid_input['topdonation_title'] = $input['topdonation_title'];
		$valid_input['topdonation_linktitle'] = $input['topdonation_linktitle'];
		if ($input['checkbox1']=="checked") 
			$valid_input['topdonation_link'] = $input['topdonation_link1'];
		else
			$valid_input['topdonation_link'] = $input['topdonation_link'];
			
		$valid_input['logo_title'] = $input['logo_title'];		
		
		if ($input['checkbox2']=="checked") 
			$valid_input['donatetoday_link'] = $input['donatetoday_link1'];
		else
			$valid_input['donatetoday_link'] = $input['donatetoday_link'];
			
		$valid_input['donatetoday'] = $input['donatetoday'];
		$valid_input['svideo_title'] = $input['svideo_title'];
		$valid_input['svideo_subtitle'] = $input['svideo_subtitle'];
		$valid_input['svideo_linktitle'] = $input['svideo_linktitle'];
		$valid_input['svideo_linktext'] = $input['svideo_linktext'];
		if ($input['checkbox3']=="checked") 
			$valid_input['svideo_link'] = $input['svideo_link1'];
		else $valid_input['svideo_link'] = $input['svideo_link'];	
		
		$valid_input['svideo_Ulink'] = $input['svideo_Ulink'];
		$valid_input['htags_h1'] = $input['htags_h1'];
		$valid_input['htags_h2'] = $input['htags_h2'];
		$valid_input['area_Wbtn1'] = $input['area_Wbtn1'];
		$valid_input['area_Wbtn2'] = $input['area_Wbtn2'];
		$valid_input['area_Wbtn3'] = $input['area_Wbtn3'];
		$valid_input['social_google'] = $input['social_google'];
		$valid_input['social_linkedin'] = $input['social_linkedin'];
		$valid_input['social_facebook'] = $input['social_facebook'];
		$valid_input['social_twitter'] = $input['social_twitter'];
		$valid_input['social_rss'] = $input['social_rss'];
		$valid_input['social_youtube'] = $input['social_youtube'];
		$valid_input['social_pinterest'] = $input['social_pinterest'];



		$valid_input['visit_title'] = $input['visit_title'];
		$valid_input['visit_text'] = $input['visit_text'];
		$valid_input['register_title'] = $input['register_title'];
		$valid_input['register_text'] = $input['register_text'];
		$valid_input['shop_title'] = $input['shop_title'];
		$valid_input['shop_text'] = $input['shop_text'];
		if ($input['checkbox4']=="checked") 
			$valid_input['shop_link'] = $input['shop_link1'];	
		else $valid_input['shop_link'] = $input['shop_link'];	



		$valid_input['gallery_image1_title'] = $input['gallery_image1_title'];
		$valid_input['gallery_image1_name'] = $input['gallery_image1_name'];
		$valid_input['gallery_image1_linktitle'] = $input['gallery_image1_linktitle'];
		if ($input['checkbox5']=="checked") 		
			$valid_input['gallery_image1_link'] = $input['gallery_image1_link1'];												
		else  $valid_input['gallery_image1_link'] = $input['gallery_image1_link'];



		$valid_input['gallery_image2_title'] = $input['gallery_image2_title'];
		$valid_input['gallery_image2_name'] = $input['gallery_image2_name'];
		$valid_input['gallery_image2_linktitle'] = $input['gallery_image2_linktitle'];
		if ($input['checkbox6']=="checked") 				
			$valid_input['gallery_image2_link'] = $input['gallery_image2_link1'];
		else
			$valid_input['gallery_image2_link'] = $input['gallery_image2_link'];	



		$valid_input['gallery_image3_title'] = $input['gallery_image3_title'];
		$valid_input['gallery_image3_name'] = $input['gallery_image3_name'];
		$valid_input['gallery_image3_linktitle'] = $input['gallery_image3_linktitle'];
		if ($input['checkbox7']=="checked") 		
			$valid_input['gallery_image3_link'] = $input['gallery_image3_link1'];		
		else
			$valid_input['gallery_image3_link'] = $input['gallery_image3_link'];	



		$valid_input['gallery_image4_title'] = $input['gallery_image4_title'];
		$valid_input['gallery_image4_name'] = $input['gallery_image4_name'];
		$valid_input['gallery_image4_linktitle'] = $input['gallery_image4_linktitle'];
		if ($input['checkbox8']=="checked") 				
		$valid_input['gallery_image4_link'] = $input['gallery_image4_link1'];
		else
		$valid_input['gallery_image4_link'] = $input['gallery_image4_link'];		

		$valid_input['gallery_image5_title'] = $input['gallery_image5_title'];
		$valid_input['gallery_image5_name'] = $input['gallery_image5_name'];
		$valid_input['gallery_image5_linktitle'] = $input['gallery_image5_linktitle'];
		if ($input['checkbox9']=="checked") 	
			$valid_input['gallery_image5_link'] = $input['gallery_image5_link1'];	
		else
			$valid_input['gallery_image5_link'] = $input['gallery_image5_link'];

		if ($input['checkbox10']=="checked") 
			$valid_input['copyrights_link'] = $input['copyrights_link1'];
		else
			$valid_input['copyrights_link'] = $input['copyrights_link'];
			
		$valid_input['copyrights'] = $input['copyrights'];


$valid_input['checkbox1'] = $_POST['checkbox1'];
$valid_input['checkbox2'] =  $_POST['checkbox2'];
$valid_input['checkbox3'] = $_POST['checkbox3'];
$valid_input['checkbox4'] = $_POST['checkbox4'];
$valid_input['checkbox5'] = $_POST['checkbox5'];
$valid_input['checkbox6'] = $_POST['checkbox6'];
$valid_input['checkbox7'] = $_POST['checkbox7'];
$valid_input['checkbox8'] = $_POST['checkbox8'];
$valid_input['checkbox9'] = $_POST['checkbox9'];
$valid_input['checkbox10'] = $_POST['checkbox10'];

$valid_input['decks'] = $input['decks'];





//print_r($input);
//print_r($_POST);

//exit();

		
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

//********************** Top Donation Area ***********************************
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_top_donation', __( 'Top Donation Area ', 'wptuts' ), 'top_donation_settings_header_text', 'wptuts');
	// Add Logo uploader

	add_settings_field('wptuts_setting_top_donation_title',  __( 'Title', 'wptuts' ), 'wptuts_setting_top_donation_title', 'wptuts', 'wptuts_settings_header_top_donation');	


	// Add Logo uploader
	add_settings_field('wptuts_setting_top_donation_linktitle',  __( 'Link Title', 'wptuts' ), 'wptuts_setting_top_donation_linktitle', 'wptuts', 'wptuts_settings_header_top_donation');	


	// Add Logo uploader
add_settings_field('wptuts_setting_top_donation_link',  __( 'Link URL', 'wptuts' ), 'wptuts_setting_top_donation_link', 'wptuts', 'wptuts_settings_header_top_donation');	


add_settings_section('wptuts_settings_header_slider', __( 'Slider Option', 'wptuts' ), 'wptuts_settings_header_slider', 'wptuts');

add_settings_field('wptuts_setting_slider_Field',  __( 'Slect Slider ', 'wptuts' ), 'wptuts_setting_slider_Field', 'wptuts', 'wptuts_settings_header_slider');




//********************** Logo Area ***********************************
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_logo', __( 'Site Logo', 'wptuts' ), 'logo_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_logo_Field',  __( 'Logo', 'wptuts' ), 'wptuts_setting_logo_Field', 'wptuts', 'wptuts_settings_header_logo');

	// Add Current Image Preview 
	add_settings_field('wptuts_setting_logo_preview',  __( 'Logo Preview', 'wptuts' ), 'wptuts_setting_logo_preview', 'wptuts', 'wptuts_settings_header_logo');

	// Add Logo uploader
	add_settings_field('wptuts_setting_logo_Field_title',  __( 'Logo Title', 'wptuts' ), 'wptuts_setting_logo_Field_title', 'wptuts', 'wptuts_settings_header_logo');

	
	
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





//********************** copy rights ***********************************		
	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_copyright', __( 'Copyrights ', 'wptuts' ), 'copyrights_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_copyrights_Field',  __( 'Copyrights text', 'wptuts' ), 'wptuts_setting_copyrights_Field', 'wptuts', 'wptuts_settings_header_copyright');

	// Add Logo uploader
	add_settings_field('wptuts_setting_copyrights_link',  __( 'Copyrights URL', 'wptuts' ), 'wptuts_setting_copyrights_link', 'wptuts', 'wptuts_settings_header_copyright');	



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

	add_settings_field('wptuts_setting_Htags_H1_title',  __( 'H2 Title', 'wptuts' ), 'wptuts_setting_Htags_H1_title', 'wptuts', 'wptuts_settings_header_Htags');

	// Add Logo uploader
	add_settings_field('wptuts_setting_Htags_H1',  __( 'H1 Text', 'wptuts' ), 'wptuts_setting_Htags_H1', 'wptuts', 'wptuts_settings_header_Htags');


//********************** H1 area ***********************************		

	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header_H2tags', __( 'Home H2', 'wptuts' ), 'Htags_settings_header_text', 'wptuts');

	// Add Logo uploader
	add_settings_field('wptuts_setting_Htags_H2_title',  __( 'H2 Title', 'wptuts' ), 'wptuts_setting_Htags_H2_title', 'wptuts', 'wptuts_settings_header_H2tags');
	// Add Logo uploader
	add_settings_field('wptuts_setting_Htags_H2',  __( 'H2 Text ', 'wptuts' ), 'wptuts_setting_Htags_H2', 'wptuts', 'wptuts_settings_header_H2tags');



//********************** Image Slider Area ***********************************	


	// Add a form section for the Main Image Area 
	
	add_settings_section('wptuts_settings_header_gallery', __( '5 Gallery Button Images', 'wptuts' ), 'Gallary_settings_header_text', 'wptuts');

	add_settings_field('wptuts_setting_gallery_Field_title',  __( 'H2 Title', 'wptuts' ), 'wptuts_setting_gallery_Field_title', 'wptuts', 'wptuts_settings_header_gallery');

	// Add Logo uploader
	add_settings_field('wptuts_setting_gallery_Field',  __( 'Gallery Image', 'wptuts' ), 'wptuts_setting_gallery_Field', 'wptuts', 'wptuts_settings_header_gallery');
	// Add Current Image Preview 
	add_settings_field('wptuts_setting_gallery_preview',  __( 'Gallery Image Preview', 'wptuts' ), 'wptuts_setting_gallery_preview', 'wptuts', 'wptuts_settings_header_gallery');


	// Add img-1
	add_settings_field('wptuts_setting_gallery_image1_title',  __( 'Image 1 Title  ', 'wptuts' ), 'wptuts_setting_gallery_image1_title', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image1_name',  __( 'Image 1 Name ', 'wptuts' ), 'wptuts_setting_gallery_image1_name', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image1_linktitle',  __( 'Image 1 Link Title ', 'wptuts' ), 'wptuts_setting_gallery_image1_linktitle', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image1_link',  __( 'Image 1 Link ', 'wptuts' ), 'wptuts_setting_gallery_image1_link', 'wptuts', 'wptuts_settings_header_gallery');



	// Add img-2
	add_settings_field('wptuts_setting_gallery_image2_title',  __( 'Image 2 Title  ', 'wptuts' ), 'wptuts_setting_gallery_image2_title', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image2_name',  __( 'Image 2 Name ', 'wptuts' ), 'wptuts_setting_gallery_image2_name', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image2_linktitle',  __( 'Image 2 Link Title ', 'wptuts' ), 'wptuts_setting_gallery_image2_linktitle', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image2_link',  __( 'Image 2 Link ', 'wptuts' ), 'wptuts_setting_gallery_image2_link', 'wptuts', 'wptuts_settings_header_gallery');



	// Add img-3
	add_settings_field('wptuts_setting_gallery_image3_title',  __( 'Image 3 Title  ', 'wptuts' ), 'wptuts_setting_gallery_image3_title', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image3_name',  __( 'Image 3 Name  ', 'wptuts' ), 'wptuts_setting_gallery_image3_name', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image3_linktitle',  __( 'Image 3 Link Title ', 'wptuts' ), 'wptuts_setting_gallery_image3_linktitle', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image3_link',  __( 'Image 3 Link ', 'wptuts' ), 'wptuts_setting_gallery_image3_link', 'wptuts', 'wptuts_settings_header_gallery');



	// Add img-4
	add_settings_field('wptuts_setting_gallery_image4_title',  __( 'Image 4 Title  ', 'wptuts' ), 'wptuts_setting_gallery_image4_title', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image4_name',  __( 'Image 4 Name ', 'wptuts' ), 'wptuts_setting_gallery_image4_name', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image4_linktitle',  __( 'Image 4 Link Title ', 'wptuts' ), 'wptuts_setting_gallery_image4_linktitle', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image4_link',  __( 'Image 4 Link ', 'wptuts' ), 'wptuts_setting_gallery_image4_link', 'wptuts', 'wptuts_settings_header_gallery');



	// Add img-5
	add_settings_field('wptuts_setting_gallery_image5_title',  __( 'Image 5 Title  ', 'wptuts' ), 'wptuts_setting_gallery_image5_title', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image5_name',  __( 'Image 5 Name ', 'wptuts' ), 'wptuts_setting_gallery_image5_name', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image5_linktitle',  __( 'Image 5 Link Title ', 'wptuts' ), 'wptuts_setting_gallery_image5_linktitle', 'wptuts', 'wptuts_settings_header_gallery');
	add_settings_field('wptuts_setting_gallery_image5_link',  __( 'Image 5 Link ', 'wptuts' ), 'wptuts_setting_gallery_image5_link', 'wptuts', 'wptuts_settings_header_gallery');



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
	add_settings_field('wptuts_setting_area_Sbtn7',  __( 'Pinterest ', 'wptuts' ), 'wptuts_setting_area_Sbtn7', 'wptuts', 'wptuts_settings_header_WBSK');


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








function top_donation_settings_header_text() {
	?>
		<p><?php _e( 'Top Donation Area for Theme.', 'wptuts' ); ?></p>
	<?php
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


function copyrights_settings_header_text() {
	?>
		<p><?php _e( 'Copyrights Options for Theme.', 'wptuts' ); ?></p>
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


function wptuts_settings_header_slider() {
	?>
		<p><?php _e( 'Select Slider.', 'wptuts' ); ?></p>
	<?php
}







function wptuts_setting_slider_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );	
	?>
<?php         
//GET SLIDE DECKS
   if (class_exists('SlideDeck')) {
   $SlideDeck = new SlideDeck();
         $slidedecks = $SlideDeck->get( null, 'post_title', 'ASC', 'publish' );
   }
 echo '<div id="feature_box_slider" class="feature_box_item">';
    echo '<label>Available Slides: </label>';
    echo '<select style="min-width:150px;" class="select' . $field_class . '" name="theme_homepage_options[decks]">';
    echo '<option value="false">-------</option>';
    foreach ( $slidedecks as $sd){
		$selected=($wptuts_options1['decks']==esc_attr( $sd['id'] )) ? "selected":"";
     echo '<option value="' . esc_attr( $sd['id'] ) . '"' . selected( $options[$id]['decks'], $sd['id'], false ) . '   '.$selected.'>' . $sd['title'] . '</option>';
    }
    echo '</select>';
    echo '</div>';        
        
?>        
        
        
	<?php } 





function wptuts_setting_top_donation_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="topdonation_title" name="theme_homepage_options[topdonation_title]" value="<?php echo $wptuts_options1['topdonation_title'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Sub Title .', 'wptuts' ); ?></span>
        
        
        
        
	<?php } 
	

function wptuts_setting_top_donation_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="topdonation_linktitle" name="theme_homepage_options[topdonation_linktitle]" value="<?php echo $wptuts_options1['topdonation_linktitle'] ; ?>" />
		<span class="description"><?php _e('Text For Short Video Link Title.', 'wptuts' ); ?></span>
	<?php } 
	


	

function wptuts_setting_top_donation_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
    
    
<select id="topdonation_link" name="theme_homepage_options[topdonation_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['topdonation_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox1" name="checkbox1" type="checkbox" value="checked" <?php echo $wptuts_options1['checkbox1'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox1').change(function(){
        if(this.checked){ $('#checkboxdiv1').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv1').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv1" style="display:<?php echo ($wptuts_options1['checkbox1']=='checked')? 'block': 'none' ?>;" >
		<input type="text" id="topdonation_link1" name="theme_homepage_options[topdonation_link1]" value="<?php echo esc_url( $wptuts_options1['topdonation_link'] ); ?>" />

</div>
		<!-- input type="text" id="topdonation_link" name="theme_homepage_options[topdonation_link]" value="<?php //echo esc_url( $wptuts_options1['topdonation_link'] ); ?>" / -->
		<span class="description"><?php _e('Text For Short Video Link.', 'wptuts' ); ?></span>
	<?php } 
	



function wptuts_setting_logo_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="hidden" id="logo_url1" name="theme_homepage_options[logo]" value="<?php echo esc_url( $wptuts_options1['logo'] ); ?>" />
		<input type="hidden" id="img_ids1" name="theme_homepage_options[logo_ids]" value="<?php echo  $wptuts_options1['logo_ids'] ; ?>" />        
		<input id="upload_logo_button1" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />

		<span class="description"><?php _e('Upload an image for the logo.', 'wptuts' ); ?></span>
	<?php
}

function wptuts_setting_logo_Field_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => false,
		'textarea_name' => 'theme_homepage_options[logo_title]'
	);
	wp_editor( $wptuts_options1['logo_title'] , 'logo_title', $args );

	?>
		<span class="description"><?php _e('Title for Logo.', 'wptuts' ); ?></span>
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

$args = array(
    'textarea_rows' => 1,
    'teeny' => true,
    'quicktags' => false,
	'textarea_name' => 'theme_homepage_options[donatetoday]'
);
	wp_editor( $wptuts_options1['donatetoday'] , 'donatetoday', $args );	
	?>
		<!--<input type="text" id="donatetoday" name="theme_homepage_options[donatetoday]" value="<?php //echo  $wptuts_options1['donatetoday'] ; ?>" />-->
		<span class="description"><?php _e('Text For Donate today.', 'wptuts' ); ?></span>
	<?php } 
	
function wptuts_setting_donatetoday_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
    
<select id="donatetoday_link" name="theme_homepage_options[donatetoday_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['donatetoday_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox2" name="checkbox2" type="checkbox" value="checked" <?php echo $wptuts_options1['checkbox2'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox2').change(function(){
        if(this.checked){ $('#checkboxdiv2').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv2').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv2" style="display:<?php echo ($wptuts_options1['checkbox2']=='checked')? 'block': 'none' ?>;" >
		<input type="text" id="donatetoday_link1" name="theme_homepage_options[donatetoday_link1]" value="<?php echo esc_url( $wptuts_options1['donatetoday_link'] ); ?>" />

</div>    
		
		<span class="description"><?php _e('Link For Donate today.', 'wptuts' ); ?></span>
	<?php } 
	


function wptuts_setting_copyrights_Field() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );

$args = array(
    'textarea_rows' => 1,
    'teeny' => true,
    'quicktags' => false,
	'textarea_name' => 'theme_homepage_options[copyrights]'
);
	wp_editor( $wptuts_options1['copyrights'] , 'copyrights', $args );	
	?>
		<!--<input type="text" id="donatetoday" name="theme_homepage_options[donatetoday]" value="<?php //echo  $wptuts_options1['donatetoday'] ; ?>" />-->
		<span class="description"><?php _e('Text For Copyrights.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_copyrights_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
    
<select id="copyrights_link" name="theme_homepage_options[copyrights_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['copyrights_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox10" name="checkbox10" type="checkbox" value="checked" <?php echo $wptuts_options1['checkbox10'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox10').change(function(){
        if(this.checked){ $('#checkboxdiv10').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv10').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv10" style="display:<?php echo ($wptuts_options1['checkbox10']=='checked')? 'block': 'none' ?>;" >
		<input type="text" id="copyrights_link1" name="theme_homepage_options[copyrights_link1]" value="<?php echo esc_url( $wptuts_options1['copyrights_link'] ); ?>" />

</div>    
		
		<span class="description"><?php _e('Link For Copyrights.', 'wptuts' ); ?></span>
	<?php } 
	
	
function wptuts_setting_svideo_Title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	

$args = array(
    'textarea_rows' => 1,
    'teeny' => true,
    'quicktags' => false,
	'textarea_name' => 'theme_homepage_options[svideo_title]'
);
	wp_editor( $wptuts_options1['svideo_title'] , 'svideo_title', $args );
	
	?>
		<!--<input type="text" id="svideo_title" name="theme_homepage_options[svideo_title]" value="<?php //echo $wptuts_options1['svideo_title'] ; ?>" />-->
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

   
<select id="svideo_link" name="theme_homepage_options[svideo_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['svideo_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox3" name="checkbox3" type="checkbox" value="checked" <?php echo $wptuts_options1['checkbox3'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox3').change(function(){
        if(this.checked){ $('#checkboxdiv3').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv3').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv3" style="display:<?php echo ($wptuts_options1['checkbox3']=='checked')? 'block': 'none' ?>;" >
		<input type="text" id="svideo_link" name="theme_homepage_options[svideo_link1]" value="<?php echo esc_url( $wptuts_options1['svideo_link'] ); ?>" />
</div>    
    

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

	wp_editor( $wptuts_options1['htags_h1'] , 'htags_h1', array( 'textarea_name' => 'theme_homepage_options[htags_h1]', 'teeny' => true,     'quicktags' => false ) );

	?>
		<!-- input type="text" id="htags_h1" name="theme_homepage_options[htags_h1]" value="<?php //echo  $wptuts_options1['htags_h1'] ; ?>" /-->
		<span class="description"><?php _e('Text For H1 Tages.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_Htags_H2() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	wp_editor( $wptuts_options1['htags_h2'] , 'htags_h2', array(  'teeny' => true,     'quicktags' => false, 'textarea_name' => 'theme_homepage_options[htags_h2]' ) );	
	?>
<!--		<input type="text" id="htags_h2" name="theme_homepage_options[htags_h2]" value="<?php //echo $wptuts_options1['htags_h2'] ; ?>" />-->
		<span class="description"><?php _e('Text For H2 Tages.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_Htags_H2_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );

$args = array(
    'textarea_rows' => 1,
    'teeny' => true,
    'quicktags' => false,
	'textarea_name' => 'theme_homepage_options[htags_h2_title]'
);

	
	wp_editor( $wptuts_options1['htags_h2_title'] , 'htags_h2_title',$args );	
	?>
<!--		<input type="text" id="htags_h2" name="theme_homepage_options[htags_h2]" value="<?php //echo $wptuts_options1['htags_h2'] ; ?>" />-->
		<span class="description"><?php _e('Text For H2 Tages.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_Htags_H1_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	
$args = array(
    'textarea_rows' => 1,
    'teeny' => true,
    'quicktags' => false,
	'textarea_name' => 'theme_homepage_options[htags_h1_title]'
);

	
	wp_editor( $wptuts_options1['htags_h1_title'] , 'htags_h1_title', $args  );	
	?>
<!--		<input type="text" id="htags_h2" name="theme_homepage_options[htags_h2]" value="<?php //echo $wptuts_options1['htags_h2'] ; ?>" />-->
		<span class="description"><?php _e('Text For H1 Tages.', 'wptuts' ); ?></span>
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
		<input type="text" id="social_google" name="theme_homepage_options[social_google]" value="<?php echo esc_url( $wptuts_options1['social_google'] ); ?>" />
		<span class="description"><?php _e('Social Link For Google .', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn2() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="social_linkedin" name="theme_homepage_options[social_linkedin]" value="<?php echo esc_url( $wptuts_options1['social_linkedin'] ); ?>" />
		<span class="description"><?php _e('Social Link For Linked-In .', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn3() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="social_facebook" name="theme_homepage_options[social_facebook]" value="<?php echo  $wptuts_options1['social_facebook'] ; ?>" />
		<span class="description"><?php _e('Social Link For Facebook.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn4() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="social_twitter" name="theme_homepage_options[social_twitter]" value="<?php echo esc_url( $wptuts_options1['social_twitter'] ); ?>" />
		<span class="description"><?php _e('Social Link For Twitter.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn5() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="social_rss" name="theme_homepage_options[social_rss]" value="<?php echo esc_url( $wptuts_options1['social_rss'] ); ?>" />
		<span class="description"><?php _e('RSS Link.', 'wptuts' ); ?></span>
	<?php } 

function wptuts_setting_area_Sbtn6() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="social_youtube" name="theme_homepage_options[social_youtube]" value="<?php echo esc_url( $wptuts_options1['social_youtube'] ); ?>" />
		<span class="description"><?php _e('Social Link For Youtube.', 'wptuts' ); ?></span>
	<?php } 


function wptuts_setting_area_Sbtn7() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="social_pinterest" name="theme_homepage_options[social_pinterest]" value="<?php echo esc_url( $wptuts_options1['social_pinterest'] ); ?>" />
		<span class="description"><?php _e('Social Link For Youtube.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_Field_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );

$args = array(
    'textarea_rows' => 1,
    'teeny' => true,
    'quicktags' => false,
	'textarea_name' => 'theme_homepage_options[gallery_title]'
);
	wp_editor( $wptuts_options1['gallery_title'] , 'gallery_title', $args );
	?>
		<span class="description"><?php _e('Upload an image for the Gallery Images.', 'wptuts' ); ?></span>
	<?php
}



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
  
<select id="shop_link" name="theme_homepage_options[shop_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['shop_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox4" name="checkbox4" type="checkbox" value="checked"  <?php echo $wptuts_options1['checkbox4'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox4').change(function(){
        if(this.checked){ $('#checkboxdiv4').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv4').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv4" style="display:<?php echo ($wptuts_options1['checkbox4']=='checked')? 'block': 'none' ?>;" >
		    
		<input type="text" id="shop_link1" name="theme_homepage_options[shop_link1]" value="<?php echo  $wptuts_options1['shop_link'] ; ?>" />
</div>  
		<span class="description"><?php _e('Shop Link', 'wptuts' ); ?></span>
	<?php } 




// gallery image 1 fields 

function wptuts_setting_gallery_image1_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image1_title" name="theme_homepage_options[gallery_image1_title]" value="<?php echo $wptuts_options1['gallery_image1_title'] ; ?>" />
		<span class="description"><?php _e('Image 1 Title.', 'wptuts' ); ?></span>
	<?php } 

// gallery image 1 fields 

function wptuts_setting_gallery_image1_name() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image1_name" name="theme_homepage_options[gallery_image1_name]" value="<?php echo ( $wptuts_options1['gallery_image1_name'] ); ?>" />
		<span class="description"><?php _e('Image 1 Title.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image1_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image1_linktitle" name="theme_homepage_options[gallery_image1_linktitle]" value="<?php echo ( $wptuts_options1['gallery_image1_linktitle'] ); ?>" />
		<span class="description"><?php _e('Image 1 Title.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image1_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
<select id="gallery_image1_link" name="theme_homepage_options[gallery_image1_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['gallery_image1_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox5" name="checkbox5" type="checkbox" value="checked" <?php echo $wptuts_options1['checkbox5'];?>/><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox5').change(function(){
        if(this.checked){ $('#checkboxdiv5').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv5').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv5" style="display:<?php echo ($wptuts_options1['checkbox5']=='checked')? 'block': 'none' ?>;" >
		    
		<input type="text" id="gallery_image1_link1" name="theme_homepage_options[gallery_image1_link1]" value="<?php echo esc_url( $wptuts_options1['gallery_image1_link'] ); ?>" />
</div>  
    

		<span class="description"><?php _e('Image 1 Title.', 'wptuts' ); ?></span>
	<?php } 





// gallery image 1 fields 

function wptuts_setting_gallery_image2_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image2_title" name="theme_homepage_options[gallery_image2_title]" value="<?php echo $wptuts_options1['gallery_image2_title'] ; ?>" />
		<span class="description"><?php _e('Image 2 Title.', 'wptuts' ); ?></span>
	<?php } 

// gallery image 1 fields 

function wptuts_setting_gallery_image2_name() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image2_name" name="theme_homepage_options[gallery_image2_name]" value="<?php echo ( $wptuts_options1['gallery_image2_name'] ); ?>" />
		<span class="description"><?php _e('Image 2 Name.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image2_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image2_linktitle" name="theme_homepage_options[gallery_image2_linktitle]" value="<?php echo ( $wptuts_options1['gallery_image2_linktitle'] ); ?>" />
		<span class="description"><?php _e('Image 2 link Title.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image2_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
    
<select id="gallery_image2_link" name="theme_homepage_options[gallery_image2_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['gallery_image2_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox6" name="checkbox6" type="checkbox" value="checked"  <?php echo $wptuts_options1['checkbox6'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox6').change(function(){
        if(this.checked){ $('#checkboxdiv6').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv6').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv6" style="display:<?php echo ($wptuts_options1['checkbox6']=='Checked')? 'block': 'none' ?>;" >
		    
		<input type="text" id="gallery_image2_link1" name="theme_homepage_options[gallery_image2_link1]" value="<?php echo esc_url( $wptuts_options1['gallery_image2_link'] ); ?>" />
</div>     
		<span class="description"><?php _e('Image 2 Link e.', 'wptuts' ); ?></span>
	<?php } 



// gallery image 1 fields 

function wptuts_setting_gallery_image3_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image3_title" name="theme_homepage_options[gallery_image3_title]" value="<?php echo $wptuts_options1['gallery_image3_title'] ; ?>" />
		<span class="description"><?php _e('Image 3 Title.', 'wptuts' ); ?></span>
	<?php } 

// gallery image 1 fields 

function wptuts_setting_gallery_image3_name() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image3_name" name="theme_homepage_options[gallery_image3_name]" value="<?php echo ( $wptuts_options1['gallery_image3_name'] ); ?>" />
		<span class="description"><?php _e('Image 3 Name.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image3_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image3_linktitle" name="theme_homepage_options[gallery_image3_linktitle]" value="<?php echo ( $wptuts_options1['gallery_image3_linktitle'] ); ?>" />
		<span class="description"><?php _e('Image 3 LInk Title .', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image3_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
<select id="gallery_image3_link" name="theme_homepage_options[gallery_image3_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['gallery_image3_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox7" name="checkbox7" type="checkbox" value="checked"  <?php echo $wptuts_options1['checkbox7'];?>  /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox7').change(function(){
        if(this.checked){ $('#checkboxdiv7').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv7').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv7" style="display:<?php echo ($wptuts_options1['checkbox7']=='Checked')? 'block': 'none' ?>;" >
		    
		<input type="text" id="gallery_image3_link1" name="theme_homepage_options[gallery_image3_link1]" value="<?php echo esc_url( $wptuts_options1['gallery_image3_link'] ); ?>" />
</div>         
		<span class="description"><?php _e('Image 3 Link .', 'wptuts' ); ?></span>
	<?php } 





// gallery image 1 fields 

function wptuts_setting_gallery_image4_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image4_title" name="theme_homepage_options[gallery_image4_title]" value="<?php echo $wptuts_options1['gallery_image4_title'] ; ?>" />
		<span class="description"><?php _e('Image 4 Title.', 'wptuts' ); ?></span>
	<?php } 

// gallery image 1 fields 

function wptuts_setting_gallery_image4_name() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image4_name" name="theme_homepage_options[gallery_image4_name]" value="<?php echo ( $wptuts_options1['gallery_image4_name'] ); ?>" />
		<span class="description"><?php _e('Image 4 name.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image4_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image4_linktitle" name="theme_homepage_options[gallery_image4_linktitle]" value="<?php echo ( $wptuts_options1['gallery_image4_linktitle'] ); ?>" />
		<span class="description"><?php _e('Image 4 link title .', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image4_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>


<select id="gallery_image4_link" name="theme_homepage_options[gallery_image4_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['gallery_image4_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox8"  name="checkbox8" type="checkbox" value="checked"  <?php echo $wptuts_options1['checkbox8'];?> /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox8').change(function(){
        if(this.checked){ $('#checkboxdiv8').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv8').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv8" style="display:<?php echo ($wptuts_options1['checkbox8']=='Checked')? 'block': 'none' ?>;" >
		    
		<input type="text" id="gallery_image4_link1" name="theme_homepage_options[gallery_image4_link1]" value="<?php echo esc_url( $wptuts_options1['gallery_image4_link'] ); ?>" />
</div>       
		<span class="description"><?php _e('Image 4 link .', 'wptuts' ); ?></span>
	<?php } 





// gallery image 1 fields 

function wptuts_setting_gallery_image5_title() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image5_title" name="theme_homepage_options[gallery_image5_title]" value="<?php echo $wptuts_options1['gallery_image5_title'] ; ?>" />
		<span class="description"><?php _e('Image 5 Title.', 'wptuts' ); ?></span>
	<?php } 

// gallery image 1 fields 

function wptuts_setting_gallery_image5_name() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image5_name" name="theme_homepage_options[gallery_image5_name]" value="<?php echo ( $wptuts_options1['gallery_image5_name'] ); ?>" />
		<span class="description"><?php _e('Image 5 Name.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image5_linktitle() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>
		<input type="text" id="gallery_image5_linktitle" name="theme_homepage_options[gallery_image5_linktitle]" value="<?php echo ( $wptuts_options1['gallery_image5_linktitle'] ); ?>" />
		<span class="description"><?php _e('Image 5 linktitle.', 'wptuts' ); ?></span>
	<?php } 



function wptuts_setting_gallery_image5_link() {
	$wptuts_options1 = get_option( 'theme_homepage_options' );
	?>


<select id="gallery_image5_link" name="theme_homepage_options[gallery_image5_link]"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( $wptuts_options1['gallery_image5_link'] )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	
<br />
<input id="checkbox9"  name="checkbox9" type="checkbox" value="checked"  <?php echo $wptuts_options1['checkbox9'];?>  /><label >External Link</label>
<script language="javascript">
var $ = jQuery; 
$(document).ready(function(){
    $('#checkbox9').change(function(){
        if(this.checked){ $('#checkboxdiv9').fadeIn(500);
            //$('#checkboxdiv1').show();
			}
        else
		{ $('#checkboxdiv9').fadeOut(500);
            //$('#checkboxdiv1').hide();
		}

    });

	
});


</script>
<div id="checkboxdiv9" style="display:<?php echo ($wptuts_options1['checkbox9']=='checked')? 'block': 'none' ?>;" >
		    
		<input type="text" id="gallery_image5_link1" name="theme_homepage_options[gallery_image5_link1]" value="<?php echo esc_url( $wptuts_options1['gallery_image5_link'] ); ?>" />
</div>       
    
		<span class="description"><?php _e('Image 5 link.', 'wptuts' ); ?></span>
	<?php } 


	?>    
    