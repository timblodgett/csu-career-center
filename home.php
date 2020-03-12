<?php
/**
 * The main blog page file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

get_header();
?>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h1>
			</header>

			<div class="posts-grid">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'blog' );
				endwhile;
			?>
			</div><!-- .posts-grid -->

			<?php
				the_posts_pagination();
			endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrapper -->
<?php
get_footer();
