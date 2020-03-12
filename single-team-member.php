<?php
/**
 * The template for displaying Team Member single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Career_Center
 */

get_header();
?>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<article id="post-<?php the_ID(); ?>" <?php post_class('staff-grid'); ?>>
				<header class="entry-header">
					<div class="post-thumbnail">
						<?php echo ( has_post_thumbnail() ) ? the_post_thumbnail( $post->ID, 'team-member' ) : get_avatar( 0, '400' ); ?>
					</div><!-- .post-thumbnail -->

					<div class="entry-header-details">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<?php if ( get_field( 'job_title' ) ) : ?>
						<p class="staff-title"><?php the_field('job_title'); ?></p>
						<?php endif; ?>

						<div class="staff-contact">
							<?php if ( get_field( 'phone_number' ) ) : ?>
							<p class="staff-phone"><?php the_field('phone_number'); ?></p>
							<?php endif; ?>

							<?php if ( get_field( 'email_address' ) ) : ?>
							<p class="staff-email"><a class="email-link" href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a></p>
							<?php endif; ?>
						</div><!-- .staff-contact -->
					</div><!-- .entry-header-details -->
				</header><!-- .entry-header -->

				<div class="bio-details">
					<?php if ( have_rows('bio_questions') ) : ?>
						<?php while ( have_rows('bio_questions') ) : the_row(); ?>
						<p class="bio-detail"><span><?php the_sub_field('question'); ?>:</span> <?php the_sub_field('answer'); ?></p>
						<?php endwhile; ?>
					<?php endif; ?>
				</div><!-- .bio-details -->

				<?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
				<?php endwhile; ?>
			</article><!-- #post-<?php the_ID(); ?> -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrapper -->
<?php
get_footer();
