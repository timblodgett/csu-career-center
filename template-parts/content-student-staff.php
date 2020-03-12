<?php
/**
 * Template part for displaying page content in meet-the-team.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .page-header -->

	<?php if ( get_field( 'team_intro_msg' ) ) : ?>
	<div class="entry-content">
		<?php the_field( 'team_intro_msg' ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php
	$student_args = array(
		'post_type'      => 'team-member',
		'orderby'        => 'rand',
		'posts_per_page' =>  99,
		'tax_query'      =>  array( array(
			'taxonomy' => 'team',
			'field'    => 'slug',
			'terms'    => 'student-staff'
		) )
	);
	$student_staff = new WP_Query( $student_args );

	if ( $student_staff->have_posts() ) :
	?>
	<div class="student-staff team-group">
		<?php while ( $student_staff->have_posts() ) : $student_staff->the_post(); ?>
		<div class="team-member">
			<div class="team-member-image">
				<?php echo ( has_post_thumbnail() ) ? the_post_thumbnail( $post->ID, 'team-member' ) : get_avatar( 0, '400' ); ?>
			</div>
			<div class="team-member-details">
				<h3 class="team-member-name"><?php the_title(); ?></h3>
				<p class="team-member-title"><?php the_field( 'job_title' ); ?></p>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div><!-- .student-staff -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
