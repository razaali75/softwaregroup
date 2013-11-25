<div class="clear"></div>
</div>
<footer id="footer" class="full-width">

	<div class="container">

		<div class="footer_box one">
			<h3>Navigate</h3>
			<?php wp_nav_menu( array('menu' => 'Footer Menu' )); ?>
		</div>

		<div class="footer_box two">
			<h3>Connect</h3>
			<ul>
			<li><a href="#">Facebook</a></li>
			<li><a href="#">Twitter</a></li>
			<li><a href="#">LinkedIn</a></li>
			<li><a href="#">Pinterest</a></li>
			<li><a href="#">Google</a></li>
			<li><a href="#">YouTube</a></li>
			</ul>
			
		</div>
		
		<div class="footer_box three">
			<h3>Case Studies</h3>
			<ul>
			<li><a href="#">CS 1</a></li>
			<li><a href="#">CS 2</a></li>
			<li><a href="#">CS 3</a></li>
			<li><a href="#">CS 4</a></li>
			<li><a href="#">CS 5</a></li>
			<li><a href="#">CS 6</a></li>
			</ul>
		</div>
		
		<div class="footer_box four">
		<h3>Get Started</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			<?php 
			$id=2;
			
			gravity_form($id, $display_title=false, $description=false); ?>
			
		</div>

		<div class="footer_box five">
			<img src="/wp-content/themes/blankslate/images/footer-logo.png" />
		</div>



	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>