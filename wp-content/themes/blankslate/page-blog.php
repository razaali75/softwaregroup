<?php
/**
 * Template Name: Blog
 *
 */
?>

<?php get_header(); ?>

<div class="blogroll full-width subpage">

	<div class="container">
	
	<div id="content">
	
	
	<h1>Software Release Group News</h1>
	
	<?php
	query_posts("post_type=post&order=DESC&paged=$page"); 

 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	

		<div class="blog-post">
			
			<div class="blog-image">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($page->ID, array(685,300)); ?></a>
			</div>
			
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="blog-excerpt">
			<?php the_excerpt(); ?>
			<div>
			
			<a href="<?php the_permalink(); ?>" class="blog-link">Read More</a>
		
		
		</div>
	
	</div>
	
	
	
	</div>

<?php endwhile; endif; ?>
</div>

	
	<?php get_sidebar(); ?>

</div>

</div>




<?php get_footer(); ?>