<?php


// Include the custom post, but only if it exists


if (file_exists(TEMPLATEPATH . '/custom-post-types/custom-post-types.php')):
	include_once(TEMPLATEPATH . '/custom-post-types/custom-post-types.php');
endif;


 
 
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "".bloginfo('template_url')."/images/noimages.jpg";
  }
  return $first_img;
}

function the_titlesmall($before = '', $after = '', $echo = true, $length = false) { $title = get_the_title();

	if ( $length && is_numeric($length) ) {
		$title = substr( $title, 0, $length );
	}

	if ( strlen($title)> 0 ) {
		$title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo )
			echo $title;
		else
			return $title;
	}
}

/**
 * Get an abbreviated content with custom lenth and more content
 */
function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '', $display = true) {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);
	
	$output = '';
   if (isset($_GET['p']) && strlen($_GET['p']) > 0) 
   {
      $output .= "<p>";
      $output .= $content;
      $output .= "&nbsp;<a rel='nofollow' href='";
      $output .= get_permalink();
      $output .= "'>".__('Read More', 'virtualresults')." &rarr;</a>";
      $output .= "</p>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) 
   {
        $content = substr($content, 0, $espacio);
        $content = $content;
        $output .= "<p>";
        $output .= $content;
        $output .= "...";
        $output .= "&nbsp;<a rel='nofollow' href='";
        $output .= get_permalink();
        $output .= "'>".$more_link_text."</a>";
        $output .= "</p>";
   }
   else 
   {
      $output .= "<p>";
      $output .= $content;
      $output .= "</p>";
   }
   
   if ($display)
		echo $output;
	else
		return $output;
}
