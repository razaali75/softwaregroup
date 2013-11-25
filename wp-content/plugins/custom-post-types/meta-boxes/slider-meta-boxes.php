<?php 

class SLIDER_META_BOXES {
	
	/** 
	 * Adds all of the Meta Boxes that are used by the Associate Custom Post Type
	 */
	function add_custom_boxes() {
	
		if( function_exists( 'add_meta_box' )) {

			
			add_meta_box( 'slider_tabs', __( 'Sliders', 'custom_post_types' ), array('SLIDER_META_BOXES', 'slider_Tabs'), Custom_Post_Types::SLIDER_POST_TYPE, 'normal', 'high' );			

		}
	}
	

	

	/** 
	 * Displays all of the Contact Information Fields for the Slider  Custom Post Type
	 */
	function slider_Tabs() {
		global $post;
		// Use nonce for verification ... ONLY USE ONCE!
		echo '<input type="hidden" name="noncename" id="noncename" value="' . 
		wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
		
		

?>

<script type="text/javascript">
		(function($) {

			$(function(){//doc.ready start

							$(".le_txt_count").each(function(){
								$max = 200;
								$len = $(this).val().length;
								$charleft = $(this).parent().find('#txtLen b');
								$charleft.text($max - $len);	
							}).keyup(function(){
								$len2 = $(this).val().length;
			    				$charleft2 = $(this).parent().find('#txtLen b');
			    				$charleft2.text($max - $len2);
			    				if($len2 > $max){
			    					$(this).val($(this).val().substr(0, $max));
			    				}
							});


							var checkbox_fade = $('#fs_r input');
							$(checkbox_fade).each(function(){
								este = $(this).attr('id');
								var check2 = $(this).is(':checked');

								switch((check2 == true) ? este : ''){
									case 'hfr_youtube':
										$('#feature_box_youtube').fadeIn(2000);	

									break;
									case 'hfr_slider':
										$('#feature_box_slider').fadeIn(2000);
									break;
									
									case 'hfr_singleimg':
										$('#feature_box_single').fadeIn(500);
									break;						
								}

							}).change(function(){
								 este = $(this).attr('id');
								
								 console.log(este);

								$('.feature_box_item').hide();
								switch(este){
									case 'hfr_youtube':
										$('#feature_box_youtube').fadeIn(500);	

									break;
									case 'hfr_slider':
										$('#feature_box_slider').fadeIn(500);

									break;
									
									case 'hfr_singleimg':
										//console.log('Nothing Yet for This');
										$('#feature_box_single').fadeIn(500);
									break;						
								}
							});

							$('input.use_link').change(function(){
								if($(this).is(':checked')){
									$(this).next().css({'visibility':'visible'});
								}
								else{
									$(this).next().css({'visibility':'hidden'});
								}

							}).each(function(){
								if($(this).is(':checked')){
									$(this).next().css({'visibility':'visible'});
								}
								else{
									$(this).next().css({'visibility':'hidden'});
								}
							});


					});//doc ready end

			})(jQuery);

	
</script>


<table width="100%" style="display: table;">
<tbody>
<tr>
<td width="100%" class="feature_box_options" style="border:0px solid #cccccc;">
	<!--div class="feature_box_item" id="feature_box_youtube"style="display: <?php echo  (get_post_meta($post->ID, '_feature_option', true)=='youtube') ? 'block' : 'none' ;?>;">
    	<label>Insert Video Id (http://www.youtube.com/watch?v=<b>90yxiRBY8vA</b>): </label><br /><code style="color:red;"> *Not Full link</code>
        	<input type="text" value="<?=get_post_meta($post->ID, '_youtube', true)?>" name="youtube" class="widefat"></div>
    <div class="feature_box_item" id="feature_box_single" style="display: <?php echo  (get_post_meta($post->ID, '_feature_option', true)=='singleimg') ? 'Block' : 'None' ;?>;">
    	<code> Feature Area Width: 430px || Height: 205px</code>
        <input type="text" value="<?=get_post_meta($post->ID, '_singleimg', true)?>" name="singleimg" class="upload-url" id="home_feature" style="width: 80%; color: rgb(153, 153, 153);">


        <input type="file"  name="upload_singleimg" class="st_upload_button" id="upload_singleimg"><br />
		<label for="_singlelink">Link to: (Include http:// for external links)</label><br />        
        <input type="text" value="<?=get_post_meta($post->ID, '_singlelink', true)?>" name="_singlelink" class="widefat">        
        </div-->
   <div class="feature_box_item" id="feature_box_slider" style="display: Block;"><label>Available Slides: </label>
   
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
					j(this).closest('div').find('img').src('');
					
					
					
						i--;
					}
					return false;
				});
				
			});

			jQuery('form#post').attr((this.encoding ? 'encoding' : 'enctype') , 'multipart/form-data');
			
		</script>

<?php
		echo '<div id="bldg">';
        echo '<div class="box1" style="padding:15px 0 0 0">';

		echo '<label for="_slider_one_title">' . __("Slider One Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_one_title" value="'.get_post_meta($post->ID, '_slider_one_title', true).'" /><br /><br />';

		echo '<label for="_slider_one_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_one_subTitle" value="'.get_post_meta($post->ID, '_slider_one_subTitle', true).'" /><br /><br />';

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_one_text'
	);
	wp_editor( get_post_meta($post->ID, '_slider_one_text', true) , 'slider_one_text', $args );

		echo '<br><label for="_slider_one_link_1">' . __("Get Started :", 'sp' ) . '</label><br />';
		?>
  
<select id="_slider_one_link_1" name="_slider_one_link_1"> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	  $selected=(get_page_link( $page->ID )==esc_url( get_post_meta($post->ID, '_slider_one_link_1', true) )) ? "Selected" : "";
  	$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selected.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>	<br /><br />        
       <?php
	//	echo '<input class="widefat" type="text" name="_slider_one_video" value="'.get_post_meta($post->ID, '_slider_one_video', true).'" /><br /><br />';

		echo '<br><label for="wp_slider_one_image">' . __("Slider Image One:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_one_image" name="wp_slider_one_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img  src="'.get_post_meta($post->ID, '_slider_one_image', true).'" width="150px" hight="150px" />';

        echo '</div>';

        
        echo '<div  class="box2" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_two_title">' . __("Slider Two Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_two_title" value="'.get_post_meta($post->ID, '_slider_two_title', true).'" /><br /><br />';

		echo '<label for="_slider_two_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_two_subTitle" value="'.get_post_meta($post->ID, '_slider_two_subTitle', true).'" /><br /><br />';



	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_two_text'
	);
	wp_editor( get_post_meta($post->ID, '_slider_two_text', true) , 'slider_two_text', $args );


		echo '<label for="_slider_two_video">' . __("Link to:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_two_video" value="'.get_post_meta($post->ID, '_slider_two_video', true).'" /><br /><br />';

		echo '<label for="wp_slider_two_image">' . __("Slider Image Two:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_two_image" name="wp_slider_two_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_two_image', true).'" width="150px" hight="150px" />';
		
		echo '</div>';


        echo '<div  class="box3" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_three_title">' . __("Slider Three Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_three_title" value="'.get_post_meta($post->ID, '_slider_three_title', true).'" /><br /><br />';

		echo '<label for="_slider_three_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_three_subTitle" value="'.get_post_meta($post->ID, '_slider_three_subTitle', true).'" /><br /><br />';

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_three_text'
	);
	wp_editor( get_post_meta($post->ID, '_slider_three_text', true)  , 'slider_three_text', $args );

		echo '<label for="_slider_three_video">' . __("Link to:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_three_video" value="'.get_post_meta($post->ID, '_slider_three_video', true).'" /><br /><br />';

		echo '<label for="_slider_three_image">' . __("Slider Image Three:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_three_image" name="wp_slider_three_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_three_image', true).'" width="150px" hight="150px" />';

		echo '</div>';


        echo '<div  class="box4" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_four_title">' . __("Slider Four Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_four_title" value="'.get_post_meta($post->ID, '_slider_four_title', true).'" /><br /><br />';

		echo '<label for="_slider_four_subTitle">' . __("Slider Four Sub Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_four_subTitle" value="'.get_post_meta($post->ID, '_slider_four_subTitle', true).'" /><br /><br />';
	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_four_text'
	);
	
	wp_editor( get_post_meta($post->ID, '_slider_four_text', true)   , 'slider_four_text', $args );
	
		echo '<label for="_slider_four_video">' . __("Link to:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_four_video" value="'.get_post_meta($post->ID, '_slider_four_video', true).'" /><br /><br />';

		echo '<label for="_slider_four_image">' . __("Slider Image Four:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_four_image" name="wp_slider_four_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_four_image', true).'" width="150px" hight="150px" />';


//		wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', array( 'textarea_name' => '_building_tab_one_description') );		

		echo '</div>';



        echo '<div  class="box5" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_five_title">' . __("Slider Five Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_five_title" value="'.get_post_meta($post->ID, '_slider_five_title', true).'" /><br /><br />';

		echo '<label for="_slider_five_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_five_subTitle" value="'.get_post_meta($post->ID, '_slider_five_subTitle', true).'" /><br /><br />';
	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_five_text'
	);
	wp_editor( get_post_meta($post->ID, '_slider_five_text', true)    , 'slider_five_text', $args );

		echo '<label for="_slider_five_video">' . __("Link to:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_five_video" value="'.get_post_meta($post->ID, '_slider_five_video', true).'" /><br /><br />';

		echo '<label for="_slider_five_image">' . __("Slider Image Five:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_five_image" name="wp_slider_five_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_five_image', true).'" width="150px" hight="150px" />';


//		wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', array( 'textarea_name' => '_building_tab_one_description') );		

		echo '</div>';




        echo '<div  class="box6" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_six_title">' . __("Slider Six Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_six_title" value="'.get_post_meta($post->ID, '_slider_six_title', true).'" /><br /><br />';

		echo '<label for="_slider_six_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_six_subTitle" value="'.get_post_meta($post->ID, '_slider_six_subTitle', true).'" /><br /><br />';

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_six_text'
	);
	wp_editor( get_post_meta($post->ID, '_slider_six_text', true)     , 'slider_six_text', $args );
	
		echo '<label for="_slider_six_video">' . __("Link to:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_six_video" value="'.get_post_meta($post->ID, '_slider_six_video', true).'" /><br /><br />';

		echo '<label for="_slider_six_image">' . __("Slider Image Six:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_six_image" name="wp_slider_six_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_six_image', true).'" width="150px" hight="150px" />';


//		wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', array( 'textarea_name' => '_building_tab_one_description') );		

		echo '</div>';




        echo '<div  class="box7" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_seven_title">' . __("Slider Seven Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_seven_title" value="'.get_post_meta($post->ID, '_slider_seven_title', true).'" /><br /><br />';

		echo '<label for="_slider_seven_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_seven_subTitle" value="'.get_post_meta($post->ID, '_slider_seven_subTitle', true).'" /><br /><br />';

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_seven_text'
	);
	wp_editor( get_post_meta($post->ID, '_slider_seven_text', true)    , 'slider_seven_text', $args );
	
		echo '<label for="_slider_seven_video">' . __("Slider Seven Video:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_seven_video" value="'.get_post_meta($post->ID, '_slider_seven_video', true).'" /><br /><br />';

		echo '<label for="_slider_seven_image">' . __("Slider Image Seven:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_seven_image" name="wp_slider_seven_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_seven_image', true).'" width="150px" hight="150px" />';


//		wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', array( 'textarea_name' => '_building_tab_one_description') );		

		echo '</div>';


        echo '<div  class="box8" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_eight_title">' . __("Slider Eight Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_eight_title" value="'.get_post_meta($post->ID, '_slider_eight_title', true).'" /><br /><br />';

		echo '<label for="_slider_eight_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_eight_subTitle" value="'.get_post_meta($post->ID, '_slider_eight_subTitle', true).'" /><br /><br />';

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_eight_text'
	);
	wp_editor(  get_post_meta($post->ID, '_slider_eight_text', true) , 'slider_eight_text', $args );
	
		echo '<label for="_slider_eight_video">' . __("Slider Eight Video:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_eight_video" value="'.get_post_meta($post->ID, '_slider_eight_video', true).'" /><br /><br />';

		echo '<label for="_slider_eight_image">' . __("Slider Image Eight:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_eight_image" name="wp_slider_eight_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_eight_image', true).'" width="150px" hight="150px" />';


//		wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', array( 'textarea_name' => '_building_tab_one_description') );		

		echo '</div>';




        echo '<div  class="box9" style="padding:15px 0 0 0">';
		echo '<a href="#" class="removeM button">Remove</a><br /><br />';

		echo '<label for="_slider_nine_title">' . __("Slider Nine Title:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_nine_title" value="'.get_post_meta($post->ID, '_slider_nine_title', true).'" /><br /><br />';

		echo '<label for="_slider_nine_subTitle">' . __("Description:", 'sp' ) . '</label><br />';
//		echo '<input class="widefat" type="text" name="_slider_nine_subTitle" value="'.get_post_meta($post->ID, '_slider_nine_subTitle', true).'" /><br /><br />';

	$args = array(
		'textarea_rows' => 1,
		'teeny' => true,
		'quicktags' => true,
		'textarea_name' => 'slider_nine_text'
	);
	wp_editor(  get_post_meta($post->ID, '_slider_nine_text', true)  , 'slider_nine_text', $args );

		echo '<label for="_slider_nine_video">' . __("Slider Nine Video:", 'sp' ) . '</label><br />';
		echo '<input class="widefat" type="text" name="_slider_nine_video" value="'.get_post_meta($post->ID, '_slider_nine_video', true).'" /><br /><br />';

		echo '<label for="_slider_nine_image">' . __("Slider Image Nine:", 'sp' ) . '</label><br />';
		echo  '<input id="wp_slider_nine_image" name="wp_slider_nine_image" value="" size="25" type="file"> <br>';  
//		$imgone=get_post_meta($post->ID, 'wp_custom_attachment_one', true);
		echo '<img src="'.get_post_meta($post->ID, '_slider_nine_image', true).'" width="150px" hight="150px" />';


//		wp_editor( get_post_meta($post->ID, '_building_tab_one_description', true), '_building_tab_one_description', array( 'textarea_name' => '_building_tab_one_description') );		

		echo '</div>';




		
		echo '<a href="#" class="addM button" >Add More</a>';
		echo '</div>';

?>


</div>
   </td>
</tr>
<tr><td>&nbsp;</td><td></td></tr>
<tr>

<td><label for="_slider_order_by">Order By</label><br /><input id="_slider_order_by" name="_slider_order_by" value="<?php echo get_post_meta($post->ID, '_slider_order_by', true)?>" /></td>
</tr>
</tbody>
</table>


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
	


//if ($_POST['smartexpress_options']['feature_option']=='slider')
//{
    if(!empty($_FILES['wp_slider_one_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
       $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_one_image']['name']));  
//	   print_r($arr_file_type);
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_one_image']['name'], null, file_get_contents($_FILES['wp_slider_one_image']['tmp_name']));  
		//	 print_r($upload);
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_one_image']=$upload['url'];
				$mydata['_slider_one_image_file']=$upload['file'];				
			
//                add_post_meta($id, 'wp_custom_attachment_one', $upload);  
//                update_post_meta($id, 'wp_custom_attachment_one', $upload);       
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  


    if(!empty($_FILES['wp_slider_two_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_two_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_two_image']['name'], null, file_get_contents($_FILES['wp_slider_two_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_two_image']=$upload['url'];
				$mydata['_slider_two_image_file']=$upload['file'];				
			
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  



    if(!empty($_FILES['wp_slider_three_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_three_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_three_image']['name'], null, file_get_contents($_FILES['wp_slider_three_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_three_image']=$upload['url'];
				$mydata['_slider_three_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  





    if(!empty($_FILES['wp_slider_four_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_four_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_four_image']['name'], null, file_get_contents($_FILES['wp_slider_four_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_four_image']=$upload['url'];
				$mydata['_slider_four_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  
	



    if(!empty($_FILES['wp_slider_five_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_five_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_five_image']['name'], null, file_get_contents($_FILES['wp_slider_five_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_five_image']=$upload['url'];
				$mydata['_slider_five_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  
	



    if(!empty($_FILES['wp_slider_six_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_six_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_six_image']['name'], null, file_get_contents($_FILES['wp_slider_six_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_six_image']=$upload['url'];
				$mydata['_slider_six_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  



    if(!empty($_FILES['wp_slider_seven_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_seven_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_seven_image']['name'], null, file_get_contents($_FILES['wp_slider_seven_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_seven_image']=$upload['url'];
				$mydata['_slider_seven_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  



    if(!empty($_FILES['wp_slider_eight_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_eight_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_eight_image']['name'], null, file_get_contents($_FILES['wp_slider_eight_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_eight_image']=$upload['url'];
				$mydata['_slider_eight_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  



    if(!empty($_FILES['wp_slider_nine_image']['name'])) { 
         
        // Setup the array of supported file types. In this case, it's just PDF.  
        $supported_types = array('image/jpeg','image/pjpeg','image/png');  
          
        // Get the file type of the upload  
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_slider_nine_image']['name']));  
        $uploaded_type = $arr_file_type['type'];  
          
        // Check if the type is supported. If not, throw an error.  
        if(in_array($uploaded_type, $supported_types)) {  
  
            // Use the WordPress API to upload the file  
             $upload = wp_upload_bits($_FILES['wp_slider_nine_image']['name'], null, file_get_contents($_FILES['wp_slider_nine_image']['tmp_name']));  
      
            if(isset($upload['error']) && $upload['error'] != 0) {  
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
            } else {  
				$mydata['_slider_nine_image']=$upload['url'];
				$mydata['_slider_nine_image_file']=$upload['file'];				
            } // end if/else  
  
        } else {  
            wp_die("The file type that you've uploaded is not a JPEG.");  
        } // end if/else  
          
    } // end if  



	if($_POST['_slider_one_title']!=""){ $mydata['_slider_one_title'] = $_POST['_slider_one_title'];}else{ $mydata['_slider_one_title'] = "";}	
	if($_POST['_slider_one_subTitle']!=""){ $mydata['_slider_one_subTitle'] = $_POST['_slider_one_subTitle'];}else{ $mydata['_slider_one_subTitle'] = "";}	
	if($_POST['_slider_one_link_1']!=""){ $mydata['_slider_one_link_1'] = $_POST['_slider_one_link_1'];}else{ $mydata['_slider_one_link_1'] = "";}
	if($_POST['_slider_one_link_2']!=""){ $mydata['_slider_one_link_2'] = $_POST['_slider_one_link_2'];}else{ $mydata['_slider_one_link_2'] = "";}		

	if($_POST['_slider_two_title']!=""){ $mydata['_slider_two_title'] = $_POST['_slider_two_title'];}else{ $mydata['_slider_two_title'] = "";}	
	if($_POST['_slider_two_subTitle']!=""){ $mydata['_slider_two_subTitle'] = $_POST['_slider_two_subTitle'];}else{ $mydata['_slider_two_subTitle'] = "";}	
	if($_POST['slider_one_text']!=""){ $mydata['_slider_one_text'] = $_POST['slider_one_text'];}else{ $mydata['_slider_one_text'] = "";}	
	if($_POST['slider_two_text']!=""){ $mydata['_slider_two_text'] = $_POST['slider_two_text'];}else{ $mydata['_slider_two_text'] = "";}	
	if($_POST['slider_three_text']!=""){ $mydata['_slider_three_text'] = $_POST['slider_three_text'];}else{ $mydata['_slider_three_text'] = "";}	
	if($_POST['slider_four_text']!=""){ $mydata['_slider_four_text'] = $_POST['slider_four_text'];}else{ $mydata['_slider_four_text'] = "";}	
	if($_POST['slider_five_text']!=""){ $mydata['_slider_five_text'] = $_POST['slider_five_text'];}else{ $mydata['_slider_five_text'] = "";}	
	if($_POST['slider_six_text']!=""){ $mydata['_slider_six_text'] = $_POST['slider_six_text'];}else{ $mydata['_slider_six_text'] = "";}	
	if($_POST['slider_seven_text']!=""){ $mydata['_slider_seven_text'] = $_POST['slider_seven_text'];}else{ $mydata['_slider_seven_text'] = "";}	
	if($_POST['slider_eight_text']!=""){ $mydata['_slider_eight_text'] = $_POST['slider_eight_text'];}else{ $mydata['_slider_eight_text'] = "";}	
	if($_POST['slider_nine_text']!=""){ $mydata['_slider_nine_text'] = $_POST['slider_nine_text'];}else{ $mydata['_slider_nine_text'] = "";}								
	
	if($_POST['_slider_two_video']!=""){ $mydata['_slider_two_video'] = $_POST['_slider_two_video'];}else{ $mydata['_slider_two_video'] = "";}	

	if($_POST['_slider_three_title']!=""){ $mydata['_slider_three_title'] = $_POST['_slider_three_title'];}else{ $mydata['_slider_three_title'] = "";}	
	if($_POST['_slider_three_subTitle']!=""){ $mydata['_slider_three_subTitle'] = $_POST['_slider_three_subTitle'];}else{ $mydata['_slider_three_subTitle'] = "";}	
	if($_POST['_slider_three_video']!=""){ $mydata['_slider_three_video'] = $_POST['_slider_three_video'];}else{ $mydata['_slider_three_video'] = "";}	

	if($_POST['_slider_four_title']!=""){ $mydata['_slider_four_title'] = $_POST['_slider_four_title'];}else{ $mydata['_slider_four_title'] = "";}	
	if($_POST['_slider_four_subTitle']!=""){ $mydata['_slider_four_subTitle'] = $_POST['_slider_four_subTitle'];}else{ $mydata['_slider_four_subTitle'] = "";}	
	if($_POST['_slider_four_video']!=""){ $mydata['_slider_four_video'] = $_POST['_slider_four_video'];}else{ $mydata['_slider_four_video'] = "";}	


	if($_POST['_slider_five_title']!=""){ $mydata['_slider_five_title'] = $_POST['_slider_five_title'];}else{ $mydata['_slider_five_title'] = "";}	
	if($_POST['_slider_five_subTitle']!=""){ $mydata['_slider_five_subTitle'] = $_POST['_slider_five_subTitle'];}else{ $mydata['_slider_five_subTitle'] = "";}	
	if($_POST['_slider_five_video']!=""){ $mydata['_slider_five_video'] = $_POST['_slider_five_video'];}else{ $mydata['_slider_five_video'] = "";}	


	if($_POST['_slider_six_title']!=""){ $mydata['_slider_six_title'] = $_POST['_slider_six_title'];}else{ $mydata['_slider_six_title'] = "";}	
	if($_POST['_slider_six_subTitle']!=""){ $mydata['_slider_six_subTitle'] = $_POST['_slider_six_subTitle'];}else{ $mydata['_slider_six_subTitle'] = "";}	
	if($_POST['_slider_six_video']!=""){ $mydata['_slider_six_video'] = $_POST['_slider_six_video'];}else{ $mydata['_slider_six_video'] = "";}	


	if($_POST['_slider_seven_title']!=""){ $mydata['_slider_seven_title'] = $_POST['_slider_seven_title'];}else{ $mydata['_slider_seven_title'] = "";}	
	if($_POST['_slider_seven_subTitle']!=""){ $mydata['_slider_seven_subTitle'] = $_POST['_slider_seven_subTitle'];}else{ $mydata['_slider_seven_subTitle'] = "";}	
	if($_POST['_slider_seven_video']!=""){ $mydata['_slider_seven_video'] = $_POST['_slider_seven_video'];}else{ $mydata['_slider_seven_video'] = "";}	


	if($_POST['_slider_eight_title']!=""){ $mydata['_slider_eight_title'] = $_POST['_slider_eight_title'];}else{ $mydata['_slider_eight_title'] = "";}	
	if($_POST['_slider_eight_subTitle']!=""){ $mydata['_slider_eight_subTitle'] = $_POST['_slider_eight_subTitle'];}else{ $mydata['_slider_eight_subTitle'] = "";}	
	if($_POST['_slider_eight_video']!=""){ $mydata['_slider_eight_video'] = $_POST['_slider_eight_video'];}else{ $mydata['_slider_eight_video'] = "";}	


	if($_POST['_slider_nine_title']!=""){ $mydata['_slider_nine_title'] = $_POST['_slider_nine_title'];}else{ $mydata['_slider_nine_title'] = "";}	
	if($_POST['_slider_nine_subTitle']!=""){ $mydata['_slider_nine_subTitle'] = $_POST['_slider_nine_subTitle'];}else{ $mydata['_slider_nine_subTitle'] = "";}	
	if($_POST['_slider_nine_video']!=""){ $mydata['_slider_nine_video'] = $_POST['_slider_nine_video'];}else{ $mydata['_slider_nine_video'] = "";}	
	if($_POST['_slider_order_by']!=""){ $mydata['_slider_order_by'] = $_POST['_slider_order_by'];}else{ $mydata['_slider_order_by'] = "0";}		


//} else
//{
//	$mydata['_slider_one_title'] = "";
//	$mydata['_slider_one_subTitle'] = "";
//	$mydata['_slider_one_video'] = "";
//	$mydata['_slider_one_image']=$upload['url'];
//	$mydata['_slider_one_image_file']=$upload['file'];	
//	
//	$mydata['_slider_two_title'] = "";
//	$mydata['_slider_two_subTitle'] = "";
//	$mydata['_slider_two_video'] = "";
//	$mydata['_slider_two_image']=$upload['url'];
//	$mydata['_slider_two_image_file']=$upload['file'];	
//	
//	$mydata['_slider_three_title'] = "";
//	$mydata['_slider_three_subTitle'] = "";
//	$mydata['_slider_three_video'] = "";
//	$mydata['_slider_three_image']=$upload['url'];
//	$mydata['_slider_three_image_file']=$upload['file'];	
//					
//	$mydata['_slider_four_title'] = "";	
//	$mydata['_slider_four_subTitle'] = "";
//	$mydata['_slider_four_video'] = "";
//	$mydata['_slider_four_image']=$upload['url'];
//	$mydata['_slider_four_image_file']=$upload['file'];	
//	
//	$mydata['_slider_five_title'] = "";
//	$mydata['_slider_five_subTitle'] = "";
//	$mydata['_slider_five_video'] = "";
//	$mydata['_slider_five_image']=$upload['url'];
//	$mydata['_slider_five_image_file']=$upload['file'];	
//	
//	$mydata['_slider_six_title'] = "";	
//	$mydata['_slider_six_subTitle'] = "";
//	$mydata['_slider_six_video'] = "";
//	$mydata['_slider_six_image']=$upload['url'];
//	$mydata['_slider_six_image_file']=$upload['file'];	
//	
//	$mydata['_slider_seven_title'] = "";
//	$mydata['_slider_seven_subTitle'] = "";
//	$mydata['_slider_seven_video'] = "";
//	$mydata['_slider_seven_image']=$upload['url'];
//	$mydata['_slider_seven_image_file']=$upload['file'];	
//	
//	$mydata['_slider_eight_title'] = "";	
//	$mydata['_slider_eight_subTitle'] = "";	
//	$mydata['_slider_eight_video'] = "";	
//	$mydata['_slider_eight_image']=$upload['url'];
//	$mydata['_slider_eight_image_file']=$upload['file'];	
//	
//	$mydata['_slider_nine_title'] = "";	
//	$mydata['_slider_nine_subTitle'] = "";	
//	$mydata['_slider_nine_video'] = "";	
//	$mydata['_slider_nine_image']=$upload['url'];
//	$mydata['_slider_nine_image_file']=$upload['file'];	
//	if ($_POST['smartexpress_options']['feature_option']== 'youtube')
//	{ 
////			if($_POST['youtube']!=""){ $mydata['_youtube'] = $_POST['youtube'];}else{ $mydata['_youtube'] = "";}	
//	}
//
//
//	if ($_POST['smartexpress_options']['feature_option']== 'singleimg')
//	{ 
//	
//	  if(!empty($_FILES['upload_singleimg']['name'])) { 
//         
//        // Setup the array of supported file types. In this case, it's just PDF.  
//        $supported_types = array('image/jpeg','image/pjpeg');  
//          
//        // Get the file type of the upload  
//        $arr_file_type = wp_check_filetype(basename($_FILES['upload_singleimg']['name']));  
//        $uploaded_type = $arr_file_type['type'];  
//          
//        // Check if the type is supported. If not, throw an error.  
//        if(in_array($uploaded_type, $supported_types)) {  
//  
//            // Use the WordPress API to upload the file  
//             $upload = wp_upload_bits($_FILES['upload_singleimg']['name'], null, file_get_contents($_FILES['upload_singleimg']['tmp_name']));  
//      
//            if(isset($upload['error']) && $upload['error'] != 0) {  
//                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
//            } else {  
//				$mydata['_singleimg']=$upload['url'];
//				
////				$mydata['_slider_nine_image_file']=$upload['file'];				
//            } // end if/else  
//  
//        } else {  
//            wp_die("The file type that you've uploaded is not a JPEG.");  
//        } // end if/else  
//          
//    } // end if  

	
	
//			if($_POST['_singlelink']!=""){ $mydata['_singlelink'] = $_POST['_singlelink'];}else{ $mydata['_singleimg'] = "";}	
			
//	}


	
//}

//$mydata['_feature_option']=$_POST['smartexpress_options']['feature_option'];

//print_r($mydata);

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
	
	
