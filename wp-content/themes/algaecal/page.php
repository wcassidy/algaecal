<?php get_header(); ?>

	<div class="container">
		<?php
		while ( have_posts() ) : the_post();
			// Include the page content template.
			get_template_part( 'content', 'page' );
		endwhile;
		?>
	</div>

<?php get_footer(); ?>
