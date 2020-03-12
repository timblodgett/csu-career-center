<?php
/**
 * The template for displaying all single Success Story posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Career_Center
 */

get_header();
?>
<div class="success-bg"></div>

<div id="primary" class="content-area">
	<div class="wrapper">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'success-story' );
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- .wrapper -->
</div><!-- #primary -->
<?php
get_footer();
