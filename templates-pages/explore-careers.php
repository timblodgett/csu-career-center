<?php
/**
 * Template Name: Explore Careers
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

$careers = get_terms( array(
	'posts_per_page' =>  99,
	'taxonomy'       => 'career-interest'
) );

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<div class="wrapper">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div><!-- .wrapper -->
				</header><!-- .entry-header -->

				<?php while( have_posts() ) : the_post(); ?>
					<?php if ( !empty( $post->post_content ) ) : ?>
					<div class="entry-content">
						<div class="wrapper">
							<?php the_content(); ?>
						</div><!-- .wrapper -->
					</div><!-- .entry-content -->
					<?php endif; ?>
				<?php endwhile; ?>

				<div class="career-interests">
					<?php foreach ( $careers as $career ) : ?>
					<section class="career-interest">
						<div class="wrapper">
							<div class="career-image">
								<?php echo wp_get_attachment_image( get_field( 'tax_feat_img', $career ), 'large' ); ?>
							</div>

							<div class="career-details">
								<h2 class="career-name"><a href="<?php echo esc_url( get_term_link($career) ); ?>"><?php echo esc_attr($career->name); ?></a></h2>
								<?php echo apply_filters( 'the_content', $career->description ) ?>
							</div><!-- .career-details -->
						</div><!-- .wrapper -->
					</section><!-- .career-interest -->
					<?php endforeach; ?>
				</div><!-- .career-interests -->
			</article><!-- #post-<?php the_ID(); ?> -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
