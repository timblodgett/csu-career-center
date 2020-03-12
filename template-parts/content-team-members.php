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
		'posts_per_page' =>  8,
		'tax_query'      =>  array( array(
			'taxonomy' => 'team',
			'field'    => 'slug',
			'terms'    => 'student-staff'
		) )
	);
	$student_staff = new WP_Query( $student_args );

	if ( $student_staff->have_posts() ) :
	?>
	<h2 class="screen-reader-text">Student Staff</h2>
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

		<?php if ( $cta = get_field('student_staff_cta') ) : ?>
		<p class="student-staff-cta">
			<a class="button" href="<?php echo( esc_url($cta['url']) ); ?>"><?php echo( esc_attr($cta['title']) ); ?></a>
		</p>
		<?php endif; ?>
	<?php endif; ?>

	<div class="team-members-group">
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'team',
		'exclude'  => get_term_by( 'slug', 'student-staff', 'team' )->term_id
	) );

	foreach ( $terms as $term ) :
		$term_staff_args = array(
			'posts_per_page' =>  99,
			'post_type'      => 'team-member',
			'tax_query'      =>  array( array(
				'taxonomy' => 'team',
				'field'    => 'slug',
				'terms'    => $term->slug
			) )
		);
		$term_staff = new WP_Query( $term_staff_args );

		if ( $term_staff->have_posts() ) :
	?>
		<div class="team-members <?php echo $term->slug; ?>">
			<h2 class="team-members-title"><?php echo esc_attr( $term->name ); ?></h2>
			<div class="team-members-content team-group">
				<?php while ( $term_staff->have_posts() ) : $term_staff->the_post(); ?>
				<a class="team-member" href="<?php the_permalink(); ?>">
					<div class="team-member-image">
					<?php echo ( has_post_thumbnail() ) ? the_post_thumbnail( $post->ID, 'team-member' ) : get_avatar( 0, '400' ); ?>
					</div>
					<div class="team-member-details">
						<h3 class="team-member-name"><?php the_title(); ?></h3>
						<p class="team-member-title"><?php the_field( 'job_title' ); ?></p>
					</div>
				</a><!-- .team-member -->

				<?php endwhile; wp_reset_postdata(); ?>
			</div><!-- .team-members-content -->
		</div><!-- .team-members -->
	<?php
		endif;
	endforeach;
	?>
	</div><!-- .team-members-group -->
</article><!-- #post-<?php the_ID(); ?> -->
