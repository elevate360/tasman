<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Tasman
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if ( get_theme_mod( 'author_display', true ) == true ) {
				get_template_part( 'template-parts/biography' );
			}

			the_post_navigation( array(
			    'prev_text'                  => __( '<span>&larr; previous post</span> %title', 'tasman' ),
			    'next_text'                  => __( '<span>next post &rarr;</span> %title', 'tasman' ),
			    'screen_reader_text'		 => __( 'Continue Reading', 'tasman' ),
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
