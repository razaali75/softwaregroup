<?php

function wptuts_get_default_options() {
	$options = array(
		'logo' => '',
		'logo_ids'=>''
	);
	return $options;
}


function theme_options_init() {
     $wptuts_options1 = get_option( 'theme_sponser_options' );
	 
	 // Are our options saved in the DB?
     if ( false === $wptuts_options1 ) {
		  // If not, we'll save our default options
          $wptuts_options1 = wptuts_get_default_options();
		  add_option( 'theme_sponser_options', $wptuts_options1 );
     }
	 
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
     add_theme_page('Sponser Options', 'Sponser Options', 'edit_theme_options', 'wptuts-settings', 'theme_admin_options_page');
//   add_theme_page('Foundations Options', 'Foundations Options', 'edit_theme_options', 'wptuts-settings', 'wptuts_admin_options_page2');	 

  //   add_theme_page('Media Sponser Options', 'Media Sponser Options', 'edit_theme_options', 'wptuts-settings', 'wptuts_admin_options_page3');	 


	// As a "top level" menu
//	add_menu_page( 'Sponser Settings', 'Sponser Settings', 'manage_options', 'wptuts-settings', 'wptuts_admin_options_page'); 
	
	 
}
// Load the Admin Options page
add_action('admin_menu', 'theme_menu_options');

function theme_admin_options_page() {
	?>
		<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php _e( 'Sponser Options', 'wptuts' ); ?></h2>
			
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'wptuts-settings-errors' ); ?>
			
			<form id="form-wptuts-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_sponser_options');
					do_settings_sections('wptuts');
				?>
			
				<p class="submit">
					<input name="theme_sponser_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'wptuts'); ?>" />
					<input name="theme_sponser_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'wptuts'); ?>" />		
				</p>
			
			</form>
			
		</div>
	<?php
}




function theme_options_validate( $input ) {
	$default_options = wptuts_get_default_options();
	$valid_input = $default_options;
	
	$wptuts_options1 = get_option('theme_sponser_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	if ( $submit ) {
		if ( $wptuts_options1['logo'] != $input['logo']  && $wptuts_options1['logo'] != '' )
			delete_image( $wptuts_options1['logo'] );
		
		$valid_input['logo'] = $input['logo'];
		$valid_input['logo_ids'] = $input['logo_ids'];		
	}
	elseif ( $reset ) {
		delete_image( $wptuts_options1['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		delete_image( $wptuts_options1['logo'] );
		$valid_input['logo'] = '';
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
		
	}
	
}
add_action('admin_enqueue_scripts', 'wptuts_options_enqueue_scripts');


function theme_options_settings_init() {
	register_setting( 'theme_sponser_options', 'theme_sponser_options', 'theme_options_validate' );
	


	// Add a form section for the Logo
	add_settings_section('wptuts_settings_header', __( 'Sponser Options', 'wptuts' ), 'option1_settings_header_text', 'wptuts');
	// Add Logo uploader
	add_settings_field('wptuts_setting_logo',  __( 'Logo', 'wptuts' ), 'wptuts_setting_logo', 'wptuts', 'wptuts_settings_header');
	// Add Current Image Preview 
	add_settings_field('wptuts_setting_logo_preview',  __( 'Logo Preview', 'wptuts' ), 'wptuts_setting_logo_preview', 'wptuts', 'wptuts_settings_header');
	add_settings_section('wptuts_settings_header', __( 'Sponser Options', 'wptuts' ), 'option1_settings_header_text', 'wptuts');


	
}
add_action( 'admin_init', 'theme_options_settings_init' );

function wptuts_setting_logo_preview() {
	$wptuts_options1 = get_option( 'theme_sponser_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<!-- img style="max-width:100%;" src="<?php //echo esc_url( $wptuts_options1['logo'] ); ?>" / -->
	</div>


	<?php
		$existing_photos_html = get_photos_html();		
	?>

<ul id="test" style="float:left">
<?php echo $existing_photos_html; ?>
</ul>

    
	<?php
	
	
}

function get_photos_html() {
		$post_attachments = get_option( 'theme_sponser_options' );
		if (!empty($post_attachments['logo_ids']))
		{  
			$post = explode(",", $post_attachments['logo_ids']);
		}else{ $post =isset($post_attachments['logo_ids'])?$post_attachments['logo_ids']:"";}

//print_r($post);

		
//		$post_attachments = get_children(array(
//			'post_parent'	=> $post->ID,
//			'post_type'		=> 'attachment',
//			'orderby'		=> 'menu_order ASC, ID',
//			'order'			=> 'DESC'
//		));
		$delete_icon_src = get_template_directory_uri() .'/wptuts-options/images/delete.png';
		
		$existing_photos_html = '';
if (!empty($post ))	{	
		foreach ($post as $attachment) {
			$photo_thumb = image_downsize($attachment, 'thumbnail');
			$existing_photos_html .= "<li style=\"float:left;margin: 0 20px 20px 0;\">";
			$existing_photos_html .= "<img src=\"{$photo_thumb[0]}\"  data-id=\"{$attachment}\" class=\"vr_photo\" />";
			$existing_photos_html .= "<img src=\"{$delete_icon_src}\" data-id=\"{$attachment}\" class=\"vr_delete_photo\" />";
			$existing_photos_html .= "</li>\n";
		}
}
		return $existing_photos_html;
	}


function option1_settings_header_text() {
	?>
		<p><?php _e( 'Manage Sponser Logo Options for Theme.', 'wptuts' ); ?></p>
	<?php
}

function wptuts_setting_logo() {
	$wptuts_options1 = get_option( 'theme_sponser_options' );
	?>
		<input type="text" id="logo_url" name="theme_sponser_options[logo]" value="<?php echo esc_url( $wptuts_options1['logo'] ); ?>" />
		<input type="text" id="img_ids" name="theme_sponser_options[logo_ids]" value="<?php echo  $wptuts_options1['logo_ids'] ; ?>" />        
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'wptuts' ); ?>" />
		<?php if ( '' != $wptuts_options1['logo'] ): ?>
			<input id="delete_logo_button" name="theme_sponser_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wptuts' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'wptuts' ); ?></span>
	<?php
}








?>