<?php get_header(); ?>

<div class="blogroll full-width subpage">

	<div class="container">
	
	<div id="content">
	
	<?php
	 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<div class="blog-post single">
			
			<div class="blog-image">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($page->ID, array(685,300)); ?></a>
			</div>
			
			<h1><?php the_title(); ?></h1>
			
			<div class="blog-content">
			<?php the_content(); ?>
			<div>
			
		
		
		</div>
	
	</div>
	
	
	
	</div>


<?php endwhile; endif; ?>

</div>

	
	<?php get_sidebar(); ?>

</div>

</div>




<?php get_footer(); ?>