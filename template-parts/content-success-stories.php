<?php
/**
 * Template part for displaying Success Story posts on archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" class="success-story-card">
		<div class="post-thumbnail">
			<?php echo ( $headshot = get_field( 'success_headshot' ) ) ? wp_get_attachment_image( $headshot, 'team-member' ) : get_avatar( 0, '400' ); ?>
		</div><!-- .post-thumbnail -->

		<div class="card-details">
			<h2 class="details-name"><?php the_title(); ?></h2>
			<p class="details-year">'<?php echo substr( get_field( 'success_grad_year' ), -2 ); ?></p>
			<p class="details-role"><?php the_field( 'success_role' ); ?></p>
			<p class="details-org"><?php the_field( 'success_organization' ); ?></p>
		</div><!-- .card-details -->
	</a><!-- .success-story-card -->
</div><!-- #post-<?php the_ID(); ?> -->
