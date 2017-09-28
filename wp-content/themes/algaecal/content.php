<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1>', '</h1>' );
			else :
				the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				'Continue reading %s',
				the_title( '<span>', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div><span>' . 'Pages:' . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span>' . 'Page' . ' </span>%',
				'separator'   => '<span>, </span>',
			) );
		?>
	</div>
</article>
