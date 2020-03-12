
<?php
/**
 * Template part for displaying page content in employers.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php if ( have_rows( 'employer_accordions') ) : ?>
		<div class="accordion-group">
			<?php while ( have_rows( 'employer_accordions' ) ) : the_row(); ?>
			<div class="accordion">
				<h2 class="accordion-title"><?php the_sub_field( 'heading' ); ?></h2>
				<div class="accordion-content">
					<?php the_sub_field( 'content' ); ?>
				</div>
			</div><!-- .accordion -->
			<?php endwhile; ?>
		</div><!-- .accordion-group -->
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
