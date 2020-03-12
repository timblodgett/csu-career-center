<?php
/**
 * Template Name: LCD Slides
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

get_header();

// get speed settings and convert to milliseconds
$autoplay_speed = get_field('lcd_slides_autoplay_speed')
                ? round( floatval( get_field('lcd_slides_autoplay_speed') ) * 1000 )
					 : '10000';
$slide_speed    = get_field('lcd_slides_speed')
					 ? round( floatval( get_field('lcd_slides_speed') ) * 1000 )
					 : '500';
// get true/false value for fade animation
$fade           = get_field('lcd_slides_fade')
					 ? 'true'
					 : 'false';

$args = array(
	'post_type'      => 'lcd-slide',
	'posts_per_page' =>  99,
	'meta_query'     =>  array( array(
		'key'     => '_thumbnail_id',
		'compare' => 'EXISTS'
	) )
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div id="slideshow" class="lcd-slides" data-autoplay-speed="<?php echo $autoplay_speed; ?>" data-slide-speed="<?php echo $slide_speed; ?>" data-fade="<?php echo $fade; ?>">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php the_post_thumbnail('lcd-slide'); ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div><!-- .lcd-slides -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
} else {
?>

<div class="lcd-slides-error">
	<h1>No slides found</h1>
</div>

<?php
}

get_footer();
