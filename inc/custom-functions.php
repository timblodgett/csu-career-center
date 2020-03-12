<?php
// custom thumbnail sizes
add_image_size( 'lcd-slide', 1920, 1080, true );
add_image_size( 'home-slide', 1920, 768, true );
add_image_size( 'header-bg', 1920, 540, true );
add_image_size( 'post-thumb', 1200, 480, true );
add_image_size( 'resource-thumb', 700, 450, true );
add_image_size( 'post-card', 350, 140, true );
add_image_size( 'team-member', 400, 400, true );



// custom text for resource cards
function get_resource_button_text( $type ) {
	switch ( $type->slug ) {
		case 'article':
			return 'Read Article';
			break;
		case 'document':
			return 'View Document';
			break;
		case 'podcast':
			return 'Listen to Podcast';
			break;
		case 'video':
			return 'Watch Video';
			break;
		case 'webinar':
			return 'View Webinar';
			break;
		case 'website':
			return 'Visit Website';
			break;
		default:
			return 'Open Resource';
	}
}


// add ACF theme options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'Theme Options',
		'menu_title' => 'Theme Options',
		'menu_slug'  => 'theme-options',
		'capability' => 'edit_pages',
		'redirect'   =>  false
	));
}


// customize queries
function csu_career_center_modify_queries( $query ) {
	if ( $query->is_post_type_archive('resource') && $query->is_main_query() && !is_admin() ) {
		$query->set( 'posts_per_page', 20 );
	}

	if ( $query->is_post_type_archive('success-story') && $query->is_main_query() && !is_admin() ) {
		$query->set( 'posts_per_page', 999 );
	}
}
add_action( 'pre_get_posts', 'csu_career_center_modify_queries');


function filter_resources_by_career_interest( $args, $field, $post_id ) {
	$args['tax_query'] = array( array(
		'taxonomy' => 'career-interest',
		'field' => 'term_id',
		'terms' =>  11
	) );

	return $args;
}


// get Taxonomy filter options for Resource Center
function get_tax_filter_option( $tax_name, $selections = array() ) {
	if ( !is_wp_error( $terms = get_terms( $tax_name ) ) ) {
?>
	<div class="filter-option filter-list" role="group" aria-labelledby="terms-<?php echo $tax_name; ?>">
		<h3 class="filter-cat" id="term-title-<?php echo $tax_name; ?>">
			<button type="button" aria-expanded="false" aria-controls="terms-<?php echo $tax_name; ?>"><?php echo get_taxonomy( $tax_name )->label; ?></button>
		</h3>
		<div class="terms-wrapper" id="terms-<?php echo $tax_name; ?>" aria-hidden="true">
			<?php foreach ( $terms as $term ) : ?>
			<div class="filter-cat-option">
				<input class="screen-reader-text" type="checkbox" name="<?php echo esc_attr( $tax_name ); ?>" id="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>" <?php checked( in_array( $term->slug, $selections ) ); ?>>
				<label for="<?php echo esc_attr( $term->slug ); ?>">
					<span><?php echo esc_attr( $term->name ); ?></span>
				</label>
			</div><!-- .filter-cat-option -->
			<?php endforeach; ?>
		</div><!-- .terms-wrapper -->
	</div><!-- .filter-option -->
<?php
	}
}


// parse query string for Resource Center
function parse_query_str( $query_string ) {
	$results = array(); // result array
	$pairs = explode( '&', $query_string ); // split on outer delimiter

	foreach ( $pairs as $i ) {
		list( $key, $value ) = explode( '=', $i, 2 ); // split into key and value

		$results[$key][] = $value;
	}

	return $results;
}


function career_center_load_more_resources_handler() {
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	query_posts( $args );

	if ( have_posts() ) :
		while( have_posts() ): the_post();
			get_template_part( 'template-parts/content', 'resource' );
		endwhile;
	endif;

	wp_die(); // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadmore', 'career_center_load_more_resources_handler');
add_action('wp_ajax_nopriv_loadmore', 'career_center_load_more_resources_handler');


function is_cc_home_page_slide_expired( $today, $expiration ) {
	$expired = true;

	if ( !($expiration) ) {
		$expired = false; // if no expiration set, slide cannot expire
	} elseif ( $expiration >= $today ) {
		$expired = false;
	}

	return $expired;
}
