<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */
if ( get_field('guest_author') ) {
	$author_name = get_field('author_name');
	$author_img = get_field('author_img');
} else {
	$author_name = get_the_author_meta( 'display_name' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a class="post-link" href="<?php echo esc_url( get_permalink() ); ?>">
		<div class="post-image">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('post-card');
			else :
				echo '<img src="'.get_template_directory_uri().'/images/defaults/post_thumb_sm.jpg" alt="">';
			endif;
			?>
		</div><!-- .post-image -->

		<div class="post-details">
			<div class="post-author">
				<div class="author-avatar">
					<?php echo ($author_img) ? wp_get_attachment_image( $author_img, 'team-member' ) : get_avatar( get_the_author_meta('ID') ); ?>
				</div>

				<p class="author-name"><?php echo esc_attr($author_name); ?></p>
			</div><!-- .author-info -->

			<header class="post-header">
			<h2 class="post-title"><?php the_title(); ?></h2>
			</header><!-- .post-header -->

			<div class="post-meta">
				<p class="post-date"><?php echo get_the_date(); ?></p>
			</div><!-- .post-meta -->
		</div><!-- .post-summary -->
	</a><!-- .post-link -->
</article><!-- #post-<?php the_ID(); ?> -->
