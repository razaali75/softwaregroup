<?php get_header(); ?>

<div id="content_area" class="full-width subpage">
<div class="container">

	<article id="content">
		<?php the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


		<h1 class="entry-title"><?php the_title(); ?></h1>


		<div class="entry-content">

			<?php the_content(); ?>

		</div>
</div>

</article>


	<?php get_sidebar(); ?>

</div>

</div>

<?php get_footer(); ?>