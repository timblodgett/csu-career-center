<?php
/**
 * The template for displaying single Employer Resource posts
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

			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'resource' ); ?>>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'resource-thumb' ); ?>
				</div>

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>

					<?php
					$url = get_field('resource_url');
					$form_id = get_field('report_emp_resource_form', 'option');
					$shortcode = '[gravityform id='.$form_id.' title=false description=false ajax=true]';

					if ( $url || $form_id ) :
					?>
					<div class="entry-actions">
						<?php if ( $url ) : ?>
						<a class="button" href="<?php echo esc_url( $url) ; ?>" target="_blank" rel="noopener"><?php echo get_resource_button_text( get_the_terms( get_the_ID(), 'resource-type' )[0] ); ?></a>
						<?php endif; ?>

						<?php if ( $form_id ) : ?>
						<button class="report-button" aria-controls="report-form" aria-expanded="false" type="button"><?php _e('Report An Issue', 'csu-career-center'); ?></button>

						<div id="report-form" class="report-form" aria-hidden="true">
							<?php echo do_shortcode( $shortcode ); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div><!-- .entry-content -->

				<div class="entry-terms">
					<?php if ( $topics = get_the_terms( $post->ID, 'emp-topic' ) ) : ?>
					<div class="entry-term">
						<h2 class="term-name"><?php _e('Topics', 'csu-career-center'); ?></h2>
						<ul class="taxonomy-list">
							<?php foreach( $topics as $topic ) : ?>
							<li><span class="fas fa-comment"></span> <?php echo $topic->name; ?></li>
							<?php endforeach; ?>
						</ul><!-- .taxonomy-list -->
					</div><!-- .entry-term -->
					<?php endif; ?>

					<?php if ( $types = get_the_terms( $post->ID, 'employment-type' ) ) : ?>
					<div class="entry-term">
						<h2 class="term-name"><?php _e('Employment Types', 'csu-career-center'); ?></h2>
						<ul class="taxonomy-list">
							<?php foreach( $types as $type ) : ?>
							<li><span class="fas fa-id-card-alt"></span> <?php echo $type->name; ?></li>
							<?php endforeach; ?>
						</ul><!-- .taxonomy-list -->
					</div><!-- .entry-term -->
					<?php endif; ?>
				</div><!-- .entry-terms -->
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	// add Topics, Identities, and Career Interests to arrays to be used for displaying Related Resources
	if ( $topics = get_the_terms( $post->ID, 'emp-topic' ) ) {
		$topic_ids = array();
		foreach ( $topics as $topic ) {
			$topic_ids[] = $topic->term_id;
		}
	}

	if ( $types = get_the_terms( $post->ID, 'employment-type' ) ) {
		$type_ids = array();
		foreach ( $types as $type ) {
			$type_ids[] = $type->term_id;
		}
	}

	$args = array(
		'post_type'      => 'emp_resource',
		'orderby'        => 'rand',
		'posts_per_page' =>  4,
		'post__not_in'   =>  array( $post->ID ),
		'tax_query'      =>  array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'emp-topic',
				'field'    => 'term_id',
				'operator' => 'IN',
				'terms'    => $topic_ids
			),
			array(
				'taxonomy' => 'employment-types',
				'field'    => 'term_id',
				'operator' => 'IN',
				'terms'    => $type_ids
			)
		)
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
	?>
	<div class="related-resources">
		<h2 class="related-title"><?php _e( 'Related Resources', 'csu-career-center' ); ?></h2>
		<div class="related-grid">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="related-resource">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'resource-thumb' );
					} else {
						echo '<img src="'.get_template_directory_uri().'/images/defaults/post_thumb_md.jpg" alt="">';
					}
					?>

					<div class="entry-wrapper">
						<header class="entry-header">
							<h3 class="entry-title"><?php the_title(); ?></h3>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div><!-- .entry-content -->
					</div><!-- entry-wrapper -->
				</a>
			</div><!-- .related-resource -->
			<?php endwhile; ?>
		</div><!-- .related-grid -->
	</div><!-- .related-resources -->
	<?php
		wp_reset_postdata();
	endif;
	?>
</div><!-- .wrapper -->
<?php
get_footer();
