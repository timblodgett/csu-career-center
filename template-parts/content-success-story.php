<?php
/**
 * Template part for displaying Success Story posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-thumbnail">
			<?php echo ( $headshot = get_field( 'success_headshot' ) ) ? wp_get_attachment_image( $headshot, 'team-member' ) : get_avatar( 0, '400' ); ?>
		</div><!-- .post-thumbnail -->

		<h1 class="entry-title"><?php the_title(); ?>, '<?php echo substr( get_field( 'success_grad_year' ), -2 ); ?></h1>
		<p class="success-degree"><?php the_field( 'success_degree' ); ?></p>
		<p class="success-role"><?php the_field( 'success_role' ); ?></p>
		<p class="success-org"><?php the_field( 'success_organization' ); ?></p>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( have_rows( 'success_commentary' ) ) :
			while ( have_rows(  'success_commentary'  ) ) : the_row();
				the_sub_field( 'content' );
			endwhile;
		endif;
		?>

		<?php
		if ( have_rows( 'success_questions' ) ) :
			while ( have_rows( 'success_questions' ) ) : the_row();
		?>
			<h2 class="success-question"><?php the_sub_field( 'question' ); ?></h2>
			<p><?php the_sub_field( 'answer' ); ?></p>
		<?php
			endwhile;
		endif;
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
