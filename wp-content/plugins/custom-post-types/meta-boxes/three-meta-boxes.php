<?php 

class THREE_META_BOXES {
	
	/** 
	 * Adds all of the Meta Boxes that are used by the Associate Custom Post Type
	 */
	function add_custom_boxes() {
	
		if( function_exists( 'add_meta_box' )) {
			
			
//			add_meta_box( 'home_details', __( 'Home Details', 'custom_post_types' ), array('LOCATION_META_BOXES', 'home_details'), Custom_Post_Types::LOCATION_POST_TYPE, 'normal', 'high' );			

			add_meta_box( 'test_details', __( 'Three Steps Step # 1', 'custom_post_types' ), array('THREE_META_BOXES', 'test_details'), Custom_Post_Types::THREE_POST_TYPE, 'normal', 'high' );			

			add_meta_box( 'test_details2', __( 'Three Steps Step # 2', 'custom_post_types' ), array('THREE_META_BOXES', 'test_details2'), Custom_Post_Types::THREE_POST_TYPE, 'normal', 'high' );			

			add_meta_box( 'test_details3', __( 'Three Steps Step # 3', 'custom_post_types' ), array('THREE_META_BOXES', 'test_details3'), Custom_Post_Types::THREE_POST_TYPE, 'normal', 'high' );			

			add_meta_box( 'test_details4', __( 'Three Steps Slogan', 'custom_post_types' ), array('THREE_META_BOXES', 'test_details4'), Custom_Post_Types::THREE_POST_TYPE, 'normal', 'high' );	

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



<?php
		$image_id = get_post_meta( $post->ID, 'upload_image_id1', true );
		$image_src = wp_get_attachment_url( $image_id );

		echo '<div id="bldg">';
        echo '<div class="box1" style="padding:15px 0 0 0">';

		echo '<label for="_Step_1_Title">' . __("Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_Step_1_Title" value="'.get_post_meta($post->ID, '_Step_1_Title', true).'" /><br /><br />';

		echo '<label for="_Step_1_Content">' . __("Content:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_Step_1_Content" name="_Step_1_Content" value="'.get_post_meta($post->ID, '_Step_1_Content', true).'" /><br /><br />';
		
        echo '</div>';

		echo '</div>';


}



/** 
	 * Displays all of the Contact Information Fields for the Associate Custom Post Type
	 */
	function test_details2() {
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



<?php
		$image_id = get_post_meta( $post->ID, 'upload_image_id1', true );
		$image_src = wp_get_attachment_url( $image_id );

		echo '<div id="bldg">';
        echo '<div class="box1" style="padding:15px 0 0 0">';

		echo '<label for="_Step_2_Title">' . __("Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_Step_2_Title" value="'.get_post_meta($post->ID, '_Step_2_Title', true).'" /><br /><br />';

		echo '<label for="_Step_2_Content">' . __("Content:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_Step_2_Content" name="_Step_2_Content" value="'.get_post_meta($post->ID, '_Step_2_Content', true).'" /><br /><br />';
		
        echo '</div>';

		echo '</div>';




}



/** 
	 * Displays all of the Contact Information Fields for the Associate Custom Post Type
	 */
	function test_details3() {
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



<?php
		$image_id = get_post_meta( $post->ID, 'upload_image_id1', true );
		$image_src = wp_get_attachment_url( $image_id );

		echo '<div id="bldg">';
        echo '<div class="box1" style="padding:15px 0 0 0">';

		echo '<label for="_Step_3_Title">' . __("Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_Step_3_Title" value="'.get_post_meta($post->ID, '_Step_3_Title', true).'" /><br /><br />';

		echo '<label for="_Step_3_Content">' . __("Content:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_Step_3_Content" name="_Step_3_Content" value="'.get_post_meta($post->ID, '_Step_3_Content', true).'" /><br /><br />';
		
        echo '</div>';

		echo '</div>';




}




/** 
	 * Displays all of the Contact Information Fields for the Associate Custom Post Type
	 */
	function test_details4() {
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



<?php
		$image_id = get_post_meta( $post->ID, 'upload_image_id1', true );
		$image_src = wp_get_attachment_url( $image_id );

		echo '<div id="bldg">';
        echo '<div class="box1" style="padding:15px 0 0 0">';

		echo '<label for="_Step_4_Slogan">' . __("Slogan:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_Step_4_Slogan" value="'.get_post_meta($post->ID, '_Step_4_Slogan', true).'" /><br /><br />';

		echo '<label for="_Step_4_callaction">' . __("Call To Action:", 'custom_post_types' ) . '</label><br />';
		echo '<input style="width: 95%;" type="text" id="_Step_4_callaction" name="_Step_4_callaction" value="'.get_post_meta($post->ID, '_Step_4_callaction', true).'" /><br /><br />';
		
        echo '</div>';

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
	


	if($_POST['_Step_4_callaction']!=""){ $mydata['_Step_4_callaction'] = $_POST['_Step_4_callaction'];}else{ $mydata['_Step_4_callaction'] = "";}	
	if($_POST['_Step_4_Slogan']!=""){ $mydata['_Step_4_Slogan'] = $_POST['_Step_4_Slogan'];}else{ $mydata['_Step_4_Slogan'] = "";}	
	
    if($_POST['_Step_3_Content']!=""){ $mydata['_Step_3_Content'] = $_POST['_Step_3_Content'];}else{ $mydata['_Step_3_Content'] = "";}	
	if($_POST['_Step_3_Title']!=""){ $mydata['_Step_3_Title'] = $_POST['_Step_3_Title'];}else{ $mydata['_Step_3_Title'] = "";}	

    if($_POST['_Step_2_Content']!=""){ $mydata['_Step_2_Content'] = $_POST['_Step_2_Content'];}else{ $mydata['_Step_2_Content'] = "";}	
	if($_POST['_Step_2_Title']!=""){ $mydata['_Step_2_Title'] = $_POST['_Step_2_Title'];}else{ $mydata['_Step_2_Title'] = "";}	


    if($_POST['_Step_1_Content']!=""){ $mydata['_Step_1_Content'] = $_POST['_Step_1_Content'];}else{ $mydata['_Step_1_Content'] = "";}	
	if($_POST['_Step_1_Title']!=""){ $mydata['_Step_1_Title'] = $_POST['_Step_1_Title'];}else{ $mydata['_Step_1_Title'] = "";}	


		
		
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
	
	
