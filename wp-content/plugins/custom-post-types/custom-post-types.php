<?php
/*
Plugin Name: Custom Fields software release group
Plugin URI: http://www.vectorsolution.com
Description: Enables the creation of standard custom post types for use within the exploreanddevelop.
Version: 0.1
Author: Raza Ali
TODO: Need to add an options panel to turn on/off the Custom Post Types
TODO: Add an option panel to adjust the order of Communities and Associates
*/

class Custom_Post_Types {	
	
	const TESTIMONIAL_POST_TYPE = '_testimonial';
	const SLIDER_POST_TYPE = '_slider';	
	const THREE_POST_TYPE = '_3steps';		
	
	/**
	 * Function to Create All of the Post Types
	 */
	function create_custom_post_types() {
		// TODO: Include an option to allow end users the ability to turn on/off each post type.
		// Conditional statement would be placed here to check if each post type was enabled
		
		
		self::register_professional_post_type();
		self::register_slider_post_type();		
		self::register_3steps_post_type();		
				
	}
	
	/**
	 * On Activation of Plugin Rewrite Rules will be flushed so that new Post Type permalinks will be active preventing a 404
	 */
	function flush_rewrite_rules() {
		self::create_custom_post_types();
		flush_rewrite_rules();
	}	
	
	/** 
	 * Register Events Custom Post Type
	 */
	function register_professional_post_type() {
		register_post_type(self::TESTIMONIAL_POST_TYPE, array(
			'labels' => array(
				'name' => 'Testimonial',
				'singular_name' => 'Testimonial',
				'add_new' => 'Add Testimonial',
				'add_new_item' => 'Add New Testimonial',
				'edit_item' => 'Edit Testimonial',
				'new_item' => 'New Testimonial',
				'view_item' => 'View Testimonial',
				'search_items' => "Search Testimonial's",
				'not_found' => "No Testimonial's found",
				'not_found_in_trash' => 'No Testimonial found in trash',
			),
			'public' => true,
			'rewrite' => array('slug' => 'Testimonial'),
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'has_archive' => true,
		));
		
  
	
		// Register the Video Meta Boxes
		 add_action('admin_menu', array('TESTIMONIAL_META_BOXES', 'add_custom_boxes'));
	
		// Save the Data from the Video Meta Boxes
		 add_action('save_post', array('TESTIMONIAL_META_BOXES', 'save_postdata'), 1, 2);

$show_description_column = TRUE;
		 
		
	}

	/** 
	 * Register slider Custom Post Type
	 */
	
	function register_slider_post_type() {
		register_post_type(self::SLIDER_POST_TYPE, array(
			'labels' => array(
				'name' => 'Slider',
				'singular_name' => 'Slider',
				'add_new' => 'Add Slider',
				'add_new_item' => 'Add New Slider',
				'edit_item' => 'Edit Slider',
				'new_item' => 'New Slider',
				'view_item' => 'View Slider',
				'search_items' => 'Search Slider',
				'not_found' => 'No Slider found',
				'not_found_in_trash' => 'No Slider found in trash',
			),
			'public' => true,
			'rewrite' => array('slug' => 'Slider'),
			'supports' => array('title','author','thumbnail','excerpt','comments'),
			'has_archive' => true,
		));
		
	
		// Register the Video Meta Boxes
		add_action('admin_menu', array('SLIDER_META_BOXES', 'add_custom_boxes'));
	
		// Save the Data from the Video Meta Boxes
		add_action('save_post', array('SLIDER_META_BOXES', 'save_postdata'), 1, 2);
	}


	/** 
	 * Register Events Custom Post Type
	 */
	function register_3steps_post_type() {
		register_post_type(self::THREE_POST_TYPE, array(
			'labels' => array(
				'name' => '3 Steps',
				'singular_name' => '3 Steps',
				'add_new' => 'Add 3 Steps',
				'add_new_item' => 'Add New 3 Steps',
				'edit_item' => 'Edit 3 Steps',
				'new_item' => 'New 3 Steps',
				'view_item' => 'View 3 Steps',
				'search_items' => "Search 3 Steps's",
				'not_found' => "No 3 Steps's found",
				'not_found_in_trash' => 'No 3 Steps found in trash',
			),
			'public' => true,
			'rewrite' => array('slug' => '3-steps'),
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'has_archive' => true,
		));
		
  
	
		// Register the Video Meta Boxes
		 add_action('admin_menu', array('THREE_META_BOXES', 'add_custom_boxes'));
	
		// Save the Data from the Video Meta Boxes
		 add_action('save_post', array('THREE_META_BOXES', 'save_postdata'), 1, 2);

$show_description_column = TRUE;
		 
		
	}
}






add_action('init', array('Custom_Post_Types', 'create_custom_post_types'), 5);
register_activation_hook(__FILE__, array('Custom_Post_Types', 'flush_rewrite_rules') );



function verbose_calendar_admin_scripts() {
    global $post;

    wp_enqueue_script('jquery');

	// this is a bit excessive to include these scripts everywhere, but there's not an easy way to include it on just the
//		// custom post type pages
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('swfupload');

        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
		
//   wp_register_style('verboseCalCustomStyles', '/wp-content/plugins/custom-post-types/styles.css');
 //   wp_enqueue_style('verboseCalCustomStyles');

//    wp_register_style('jqueryUIALL', '/wp-content/plugins/themes/base/jquery.ui.all.css');
//    wp_enqueue_style('jqueryUIALL');

//    wp_register_script('jqueryUICore', '/wp-content/plugins/custom-post-types/ui/jquery.ui.core.js');
//    wp_enqueue_script('jqueryUICore');

//    wp_register_script('jqueryUIWidget', '/wp-content/plugins/custom-post-types/ui/jquery.ui.widget.js');
//    wp_enqueue_script('jqueryUIWidget');

 //   wp_register_script('jqueryUIDate', '/wp-content/plugins/custom-post-types/ui/jquery.ui.datepicker.js');
//    wp_enqueue_script('jqueryUIDate');
//		
		
}

add_action('admin_enqueue_scripts', 'verbose_calendar_admin_scripts');

// Included Files
require_once(dirname(__FILE__) . '/meta-boxes/testimonial-meta-boxes.php');
require_once(dirname(__FILE__) . '/meta-boxes/slider-meta-boxes.php');
require_once(dirname(__FILE__) . '/meta-boxes/three-meta-boxes.php');