<style >
#slider-code4 { 
clear: both;
margin: 0 auto;
position: absolute; 
width: 2000px;  
left: 50%; 
 
}


#slider-code4 .viewport 
{ 
width: 2000px; 
height: 510px;
position: absolute; 
left: -50%; 
 }


#slider-code4 .buttons { display: block; margin: 30px 10px 0 0; }


#slider-code4 .next { margin: 30px 0 0 10px;  }


#slider-code4 .disable { visibility: hidden; }


#slider-code4 .overview 
{ 
list-style: none; 
position: absolute; 
padding: 0; 
margin: 0; 
top: 0; 
}


#slider-code4 .overview li
{ 
float: left; 
margin: 0 0px 0 0; 
height: 510px;

           
</style>    


<div id="slider_wrapper" class="full-width">


<div id="slider-code4">
    
    
    <a class="buttons prev" href="#" id="prevButton" style="display: none;">left</a>
    <div class="viewport">
        <ul class="overview">
	<?php 
	query_posts("post_type=_slider&showposts=-1&order=ASC&orderby=meta_value&meta_key=_slider_order_by"); 
	$i=1;
	?>	
        
	<?php while (have_posts()) : the_post(); 
	$option_1=get_post_meta($post->ID, '_slider_one_image', true);
	
	?>
     <li class="li_<?php echo $i++ ;?>">
        <div id="slider" class="full-width">
        
            

                <div class="slider" style="background: url(<?php echo $option_1;?>) center no-repeat; height:440px">
                
                <div class="container">
                      
                
                <h2><?php echo get_post_meta($post->ID, '_slider_one_title', true);?></h2>
                <p><?php echo get_post_meta($post->ID, '_slider_one_text', true);?>
                </p>
            
                <div class="slider_links">
                
                <span id="getstarted">
                        <a href="<?php echo get_post_meta($post->ID, '_slider_one_link_1', true);?>" >Get Started</a>
                    </span>
                
               
                </div>
                </div>
                
                </div>
            
                </div>
      
        
        </li>
	<?php endwhile; ?>
        </ul>
    </div>
    <a class="buttons next" href="#" id="nextButton" style="display: none;">right</a>
</div>  


</div>



<script type="text/javascript">
    $(document).ready(function(){
    
	    var current = 1;
	    var totalImages = $("#slider-code4 ul li").size();
            
	  	var oSlider4 =    $('#slider-code4').tinycarousel({ interval: true ,  intervaltime: 4500 });		
	
	
	    $('#nextButton').click(function(){
		
         current += 1;
        if(current > totalImages){
         current = 1;   
        }
         oSlider4.tinycarousel_move(current);          
    });
        
    });
</script> 