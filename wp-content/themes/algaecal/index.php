<?php get_header(); ?>
<div class="container">
	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<?php
		
		// "THE LOOP"
		while ( have_posts() ) : the_post();
			// Display the post
			get_template_part( 'content', get_post_format() );
		endwhile;

		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => 'Previous page',
			'next_text'          => 'Next page',
			'before_page_number' => '<span>' . 'Page' . ' </span>',
		) );
	endif;
	?>
</div>
<?php get_footer(); ?>
