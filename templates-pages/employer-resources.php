<?php
/**
 * Template Name: Employer Resources
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */
if( has_post_thumbnail() ) {
	$header_bg = 'style="background-image:url(' . get_the_post_thumbnail_url( get_the_id(), 'header-bg' ) . ');"';
} else {
	$header_bg = 'style="background-image:url(' . get_template_directory_uri() . '/images/defaults/employer-resources.jpg);"';
}

$loading_txt = __( 'Loading...', 'csu-career-center' );
$loaded_txt = __( 'Load More Resources', 'csu-career-center' );

$query_args = array(
	'post_type'      => array( 'emp_resource'),
	'posts_per_page' => 12
);

$query_string = parse_query_str( $_SERVER['QUERY_STRING'] );

// create empty arrays to hold selections
$resources_tags = $types_array = $topics_array = array();

foreach ( $query_string as $key => $value ) {
	switch ( $key ) {
		case 'keyword':
			$query_args['s'] = $keyword = $value[0];
			$resources_tags[$key] = $keywords_array = $value;
			$keywords_array;
			break;
		case 'employment-type':
			$query_args[$key] = $resources_tags[$key] = $types_array = $value;
			break;
		case 'emp-topic':
			$query_args[$key] = $resources_tags[$key] = $topics_array = $value;
			break;
	}
}

$resources = new WP_Query( $query_args );

// load more resources
function career_center_load_more_resources() {
	global $resources;
	$query_vars = $resources->query_vars;

	wp_localize_script( 'csu-career-center-scripts', 'career_center_loadmore_params', array(
		'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
		'posts'        => json_encode( $resources->query_vars ),
		'current_page' => $query_vars['paged'] ? $query_vars['paged'] : 1,
		'max_page'     => $resources->max_num_pages
	) );
}
add_action( 'wp_enqueue_scripts', 'career_center_load_more_resources', 10, 1 );

get_header();
?>
	<header class="page-header" aria-owns="primary" <?php echo $header_bg; ?>>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="resources-content">
				<div class="resources-sidebar">
					<form id="filter-options" class="filter-options" method="get">
						<h2 class="filter-title">
							<span class="icon fas fa-filter" aria-hidden></span>
							<?php _e( 'Filters', 'csu-career-center' ); ?>
						</h2><!-- .filter-title -->

						<div class="filter-option">
							<label class="screen-reader-text" for="keyword"><?php _e( 'Keyword', 'csu-career-center' ); ?></label>
							<input type="text" id="keyword" class="search-field" placeholder="<?php _e( 'Keyword', 'csu-career-center' ); ?>" name="keyword" <?php if ( $keyword ) echo 'value="' . urldecode($keyword) . '"'; ?>>
						</div>

						<?php get_tax_filter_option( 'employment-type', $types_array ); ?>

						<?php get_tax_filter_option( 'emp-topic', $topics_array ); ?>
					</form><!-- .filter-options -->
				</div><!-- .resources-sidebar -->

				<div class="resources-results">
					<?php if ( $resources_tags ) : ?>
					<h2 class="screen-reader-text"><?php _e( 'Filters', 'csu-career-center' ); ?></h2>

					<ul class="resources-tags">
						<?php
						foreach( $resources_tags as $tag => $selections ) :
							if ( $tag == 'keyword' ) :
								foreach ( $selections as $selection ) :
							?>
								<li class="resource-tag">
									<button data-name="<?php echo esc_attr( $tag ); ?>" data-value="<?php echo esc_attr( $selection ); ?>">
										<span class="fas fa-times" aria-label="remove filter"></span>
										<?php echo urldecode( esc_attr( $selection ) ); ?>
									</button>
								</li>
							<?php
								endforeach;
							else :
								foreach ( $selections as $key => $value ) {
									$term = get_term_by( 'slug', $value, $tag );
									$selections[$key] = $term->term_id;
								}
								$terms = get_terms( array(
									'taxonomy' => $tag,
									'include' => $selections
								) );
								foreach ( $terms as $term ) :
							?>
								<li class="resource-tag">
									<button data-name="<?php echo esc_attr( $tag ); ?>" data-value="<?php echo esc_attr( $term->slug ); ?>">
										<span class="fas fa-times" aria-label="remove filter"></span>
										<?php echo esc_attr( $term->name ); ?>
									</button>
								</li>
							<?php
								endforeach;
							endif;
						endforeach;
						?>
					</ul><!-- .resources-tags -->
					<?php endif; ?>

					<?php if ( $resources->have_posts() ) : ?>
					<h2 class="screen-reader-text"><?php _e( 'Resources', 'csu-career-center' ); ?></h2>

					<div id="resources-grid" class="resources-grid">
						<div class="grid-gutter"></div>

						<?php
						while ( $resources->have_posts() ) : $resources->the_post();
							get_template_part( 'template-parts/content', 'resource' );
						endwhile;
						?>

					</div><!-- .resources-grid -->

					<?php if ( $resources->max_num_pages > 1 ) : ?>
					<div class="load-more" style="margin:1.25em 0 2.5em;text-align:center;">
						<button id="load-more-resources" class="load-more-resources" data-loading="<?php echo $loading_txt; ?>" data-loaded="<?php echo $loaded_txt; ?>"><?php echo $loaded_txt; ?></button>
					</div><!-- .load-more -->

					<?php endif; ?>

					<?php wp_reset_postdata(); ?>

					<?php else : ?>

					<div class="resources-empty">
						<p><?php _e( 'Sorry. No resources were found matching your criteria.', 'csu-career-center' ); ?></p>
					</div><!-- .resources-empty -->

					<?php endif; ?>
				</div><!-- .resources-results -->
			</div><!-- .resources-content -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
