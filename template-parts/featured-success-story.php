<?php
$args = array(
	'posts_per_page' =>  1,
	'post_type'      => 'success-story',
	'orderby'        => 'rand'
);

if ( is_tax('career-interest') ) {
	$args['tax_query'] = array( array(
		'taxonomy' => 'career-interest',
		'field'    => 'term_id',
		'terms'    => get_queried_object()->term_id
	) );
}

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$feat_img = wp_get_attachment_image_url( get_post_thumbnail_id($post->ID), 'lcd-slide' );
		$bg = 'style="background-image:url(' . $feat_img . ');"';
		$f_name = get_field( 'success_first_name' );
	?>
<div class="featured-success-story" <?php echo $bg; ?>>
	<div class="story wrapper">
		<div class="story-content">
			<div class="story-excerpt">
				<?php the_excerpt(); ?>
			</div>
			<div class="story-person">
				<p class="story-name"><?php the_title(); ?>, '<?php echo substr( get_field( 'success_grad_year' ), -2 ); ?></p>
				<p class="story-degree"><?php the_field( 'success_degree' ); ?></p>
			</div>
			<div class="story-career">
				<p class="story-role"><?php the_field( 'success_role' ); ?></p>
				<p class="story-org"><?php the_field( 'success_organization' ); ?></p>
			</div>
			<div class="story-links">
				<p><a class="this-story" href="<?php the_permalink(); ?>">Read <?php echo esc_attr( $f_name ); ?>'<?php echo ( substr( $f_name, -1) == 's' ) ? '' : 's' ; ?> Story</a></p>
				<p><a class="more-stories" href="<?php echo esc_url( home_url().'/success-stories' ); ?>">More Success Stories</a></p>
			</div>
		</div><!-- .story-content -->
	</div><!-- .story .wrapper -->
</div><!-- .featured-success-story -->
<?php
	endwhile;
	wp_reset_postdata();
endif;
?>
