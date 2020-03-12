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
	$author_bio = get_field('author_bio');
} else {
	$author_name = get_the_author_meta( 'display_name' );
	$author_bio = get_the_author_meta( 'user_description' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="featured-image">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('post-thumb');
			else :
				echo '<img src="'.get_template_directory_uri().'/images/defaults/post_thumb_lg.jpg" alt="">';
			endif;
			?>
		</div><!-- .featured-image -->

		<div class="author-info">
			<div class="author-avatar">
				<?php echo ($author_img) ? wp_get_attachment_image( $author_img, 'team-member' ) : get_avatar( get_the_author_meta('ID'), 160 ); ?>
			</div>

			<p class="author-name"><?php echo esc_attr( $author_name ); ?></p>
		</div><!-- .author-info -->

		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( $subtitle= get_field('post_subtitle') ) {
			echo '<p class="entry-subtitle">'.esc_attr($subtitle).'</p>';
		}
		?>

		<div class="entry-meta">
			<p class="entry-date"><?php echo get_the_date(); ?></p>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'csu-career-center' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>

		<?php if ( $author_bio ) : ?>
		<div class="author-bio">
			<h2 class="screen-reader-text">About the Author</h2>

			<?php echo apply_filters( 'the_content', $author_bio ); ?>
		</div><!-- .author-bio -->
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
