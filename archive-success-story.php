<?php
/**
 * The template for displaying Success Story archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

get_header();
?>
	<div class="success-bg"></div>

	<div id="primary" class="content-area">
		<div class="wrapper">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php _e( get_queried_object()->label, 'csu-career-center' ); ?></h1>
				</header><!-- .page-header -->

				<div class="success-stories">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'success-stories' );
					endwhile;
					?>

					<?php if ( $link = get_field('success_share_link', 'option') ) : ?>
					<div class="story-cta">
						<a class="button" href="<?php echo esc_url( $link ); ?>">Share Your Story</a>
					</div>
					<?php endif; ?>
				</div><!-- .success-stories -->
				<?php endif; ?>
			</main><!-- #main -->
		</div><!-- .wrapper -->
	</div><!-- #primary -->

<?php
get_footer();
