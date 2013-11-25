<?php 

class TESTIMONIAL_META_BOXES {
	
	/** 
	 * Adds all of the Meta Boxes that are used by the Associate Custom Post Type
	 */
	function add_custom_boxes() {
	
		if( function_exists( 'add_meta_box' )) {
			
			
//			add_meta_box( 'home_details', __( 'Home Details', 'custom_post_types' ), array('LOCATION_META_BOXES', 'home_details'), Custom_Post_Types::LOCATION_POST_TYPE, 'normal', 'high' );			

			add_meta_box( 'test_details', __( 'Testimonial Details', 'custom_post_types' ), array('TESTIMONIAL_META_BOXES', 'test_details'), Custom_Post_Types::TESTIMONIAL_POST_TYPE, 'normal', 'high' );			



//	
			
		}
	}
	


	/** 
	 * Displays all of the Contact Information Fields for the Associate Custom Post Type
	 */
	function test_details() {
		global $post;
		// Use nonce for verification ... ONLY USE ONCE!
		echo '<input type="hidden" name="noncename" id="noncename" value="' . 
		wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
?>

		<style type="text/css">				
		.removeM {
			display: block;
			height: 20px;
			width: 80px;
			background: #F3F3F3;
			border: 2px solid #F3F3F3;
			
			color: rgba(0, 0, 0, 0.55);
			text-align: center;
			font: bold 13px "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
			
			background: -webkit-linear-gradient(top, #FFFFFF, #F3F3F3);
			background: -moz-linear-gradient(top, #FFFFFF, #F3F3F3);
			background: -o-linear-gradient(top, #FFFFFF, #F3F3F3);
			background: -ms-linear-gradient(top, #FFFFFF, #F3F3F3);
			background: linear-gradient(top, #FFFFFF, #F3F3F3);
			
			-webkit-border-radius: 5px;
			-khtml-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			
			-webkit-box-shadow: 0 1px 0 #999;
			-moz-box-shadow: 0 1px 0 #999;
			box-shadow: 0 1px 0 #999;
			
			text-shadow: 0 2px 2px rgba(255, 255, 255, 0.2);			
		}
		a.removeM {
			text-decoration: none;
		}	
		a.removeM:hover {
			background: #999;
			background: -webkit-linear-gradient(top, #F3F3F3, #FFFFFF);
			background: -moz-linear-gradient(top, #F3F3F3, #FFFFFF);
			background: -o-linear-gradient(top, #F3F3F3, #FFFFFF);
			background: -ms-linear-gradient(top, #F3F3F3, #FFFFFF);
			background: linear-gradient(top, #F3F3F3, #FFFFFF);
		}

		</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" /></script>
        <script>
			var j = jQuery.noConflict();
			j(function() {
		//		j( "#_post_dated" ).click(){
//					j( "#_post_dated" ).datepicker();					
//				}


				var etb = j('#bldg input:text').filter(function() { return this.value == ""; });
				etb.each(function() {
					if(j(this).closest('div').attr('class') != 'box1'){
					j(this).closest('div').hide();
					}					
				});
				
				var i =  j('#bldg > div:visible ').length + 1;
				
				 j('.addM').live('click', function() {
						j('.box' +i).show('slow');											
						i++;
					return false;
				});
				

				j('.removeM').live('click', function() { 
					if( i > 2 ) {
					j(this).closest('div').hide('slow');
					j(this).closest('div').find('input:text').attr('value', '');
					j(this).closest('div').find('input:checkbox').attr('value', '');
					j(this).closest('div').find('textarea').text('');
					
					
						i--;
					}
					return false;
				});

			// save the send_to_editor handler function
			window.send_to_editor_default = window.send_to_editor;
	
 //Onee	
//			j('#set-image-one').click(function(){
			j('[id^="set-image"]').click(function(){			
				
		        str = j(this).attr('id');
//				alert(str);
		        substring = str.substring(str.length, str.length - 1);
		        id_to_pass = 'upload_image_id' + substring;
//		        alert(id_to_pass);
						// replace the default send_to_editor handler function with our own
				window.send_to_editor = window.attach_image;
				tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');
				
				return false;
			});
			
//			j('#remove-image-one').click(function() {
			j('[id^="remove-image"]').click(function() {			
				
		        str = j(this).attr('id');				
//alert(str );

		        substring = str.substring(str.length, str.length - 1);
		        id_to_pass = 'upload_image_id' + substring;

//alert(id_to_pass );

				j('#'+id_to_pass).val('');
				j('#_custom_attachment_'+substring).attr('style', ' display : none;');
				j('#_custom_attachment_'+substring).attr('src', '#');
				j(this).hide();
				
				return false;
			});
			
			// handler function which is invoked after the user selects an image from the gallery popup.
			// this function displays the image and sets the id so it can be persisted to the post meta
			window.attach_image = function(html) {
				
				
				// turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
				j('body').append('<div id="temp_image">' + html + '</div>');
					
				var img = j('#temp_image').find('img');
				
				imgurl   = img.attr('src');
				imgclass = img.attr('class');
				imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);
	
	
//				j('#upload_image_id1').val(imgid);
				j('#'+ id_to_pass).val(imgid);				
				j('#remove-image-'+substring).show();
	
				j('img#_custom_attachment_'+substring).attr('src', imgurl);
				j('#_custom_attachment_'+substring).attr('style', ' display : block;');				
				if (substring==1){
				j('input#_custom_attachment_one').attr('value', imgurl);
				}

				if (substring==2){
				j('input#_custom_attachment_two').attr('value', imgurl);
				}

				if (substring==3){
				j('input#_custom_attachment_three').attr('value', imgurl);
				}

				if (substring==4){
				j('input#_custom_attachment_four').attr('value', imgurl);
				}

				
				try{tb_remove();}catch(e){};
				j('#temp_image').remove();
				
				// restore the send_to_editor handler function
				window.send_to_editor = window.send_to_editor_default;
				
			}




				
			});

			jQuery('form#post').attr((this.encoding ? 'encoding' : 'enctype') , 'multipart/form-data');
			
		</script>


<?php
		$image_id = get_post_meta( $post->ID, 'upload_image_id1', true );
		$image_src = wp_get_attachment_url( $image_id );

		echo '<div id="bldg">';
        echo '<div class="box1" style="padding:15px 0 0 0">';

		echo '<label for="_client_name">' . __("Client Name :", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_client_name" value="'.get_post_meta($post->ID, '_client_name', true).'" /><br /><br />';

		echo '<label for="_post_dated">' . __("Post Dated:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_post_dated" name="_post_dated" value="'.get_post_meta($post->ID, '_post_dated', true).'" /><br /><br />';
		
		echo '<label for="_programpatner_one_image">' . __("Program Partner image:", 'sp' ) . '</label><br />';
		echo '<input type="hidden" name="upload_image_id1" id="upload_image_id1" value="'. $image_id .'" />';
		echo '<input type="hidden" name="_custom_attachment_one" id="_custom_attachment_one" value="" />';		
		echo '<img height="150px" id="_custom_attachment_1" src="'. $image_src .'" style="max-width:100%;" />';		
		
//		echo '<img src="'.get_post_meta($post->ID, '_custom_attachment_one', true).'" width="150px" hight="150px" />';
?>

		<p>
			<a title="<?php esc_attr_e( 'Set image' ) ?>" href="#" id="set-image-1"><?php _e( 'Set image' ) ?></a>
			<a title="<?php esc_attr_e( 'Remove image' ) ?>" href="#" id="remove-image-1" style=" <?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"><?php _e( 'Remove image' ) ?></a>
		</p>



		<fieldset id="fs_r">
<?php 
	echo '<label for="_pp1_checkbox">' . __("Remove This:", 'custom_post_types' ) . '</label>';
	?>
	<input name="_pp1_checkbox" id="_pp1_checkbox" type="checkbox" value="Checked"  /><br /><br />
</fieldset>
<?php
        echo '</div>';

		
//		echo '<a href="#" class="addM button" >Add More</a>';
		echo '</div>';



}







	/** 
	 * Displays all of the Contact Information Fields for the Associate Custom Post Type
	 */
	function home_details() {
		global $post;
		
		// Use nonce for verification ... ONLY USE ONCE!
		echo '<input type="hidden" name="noncename" id="noncename" value="' . 
		wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

		echo '<label for="_localtion_home">' . __("Home Title Text:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_localtion_home" name="_localtion_home" value="'.get_post_meta($post->ID, '_localtion_home', true).'" /><br /><br />';
		
		echo '<label for="_localtion_homeDetail">' . __("Details:", 'custom_post_types' ) . '</label><br />';
		//wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', $settings );
		wp_editor( get_post_meta($post->ID, '_localtion_homeDetail', true), '_localtion_homeDetail', array( 'textarea_name' => '_localtion_homeDetail'
) );		
	
		echo '<br /><br />';		

		echo '<label for="_location_map">' . __("Google maps embed code:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_location_map" name="_location_map" value="'.get_post_meta($post->ID, '_location_map', true).'" /><br /><br />';


?>


<?php 
	echo '<label for="_location_active">' . __("Active:", 'custom_post_types' ) . '</label>';
	?>
	<input name="_location_active" id="_location_active" type="checkbox" value="Checked" <?php echo  (get_post_meta($post->ID, '_location_active', true)=='Checked') ? 'checked="checked"' : '' ;?>  /><br /><br />

<?php 
	
	}
	
	
	
	


	/** 
	 * Saves all of the Associate Meta Box field information
	 */
	function save_postdata($post_id, $post) {
		
		

		
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( empty($_POST['noncename']) || !wp_verify_nonce( $_POST['noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
		}
	
		// Is the user allowed to edit the post or page?
		if ( 'page' == $_POST['post_type'] ) {

			if ( !current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
			if ( !current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
	


	if($_POST['upload_image_id1']!=""){ $mydata['upload_image_id1'] = $_POST['upload_image_id1'];}else{ $mydata['upload_image_id1'] = "";}	
    if($_POST['_custom_attachment_one']!=""){ $mydata['_custom_attachment_one'] = $_POST['_custom_attachment_one'];}else{ $mydata['_custom_attachment_one'] = "";}	

	if($_POST['_client_name']!=""){ $mydata['_client_name'] = $_POST['_client_name'];}else{ $mydata['_client_name'] = "";}	
	
	if($_POST['_post_dated']!=""){ $mydata['_post_dated'] = $_POST['_post_dated'];}else{ $mydata['_events_sdated'] = "";}

	if($_POST['jq_checkbox']!=""){ $mydata['jq_checkbox'] = $_POST['jq_checkbox'];}else{ $mydata['jq_checkbox'] = "";}	

	if($_POST['_post_dated']!=""){ $mydata['_post_dated'] = $_POST['_post_dated'];}else{ $mydata['_post_dated'] = "";}		
	
	
	
	
//	echo $_POST['jq_checkbox'];
//	exit();
	
	if($_POST['_pp1_checkbox']!=""){ 
	$mydata['_custom_attachment_one'] = "";
	$mydata['_custom_attachment_one_file']="";	
	}

	
	



//	if($_POST['_localtion_home']!=""){ $mydata['_localtion_home'] = $_POST['_localtion_home'];}else{ $mydata['_localtion_home'] = "";}	


//exit();


		
		
		// Add values of $mydata as custom fields
		if ($mydata) : // Make sure $mydata has values
			foreach ($mydata as $key => $value) { //Let's cycle through the $mydata array!
				if( $post->post_type == 'revision' ) return; //don't store custom data twice
				$value = implode(',', (array)$value); //if $value is an array, make it a CSV (unlikely)
				if(get_post_meta($post->ID, $key, FALSE)) { //if the custom field already has a value
					update_post_meta($post->ID, $key, $value);
				} else { //if the custom field doesn't have a value
					add_post_meta($post->ID, $key, $value);
				}
				if(!$value) delete_post_meta($post->ID, $key); //delete if blank
			}
		endif;
	}

}
	
	
