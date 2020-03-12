<?php
/**
 * Template part for displaying resource content in resource-center.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

$protected = get_post_meta( $post->ID, '_csuweb_eid_protect_key' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'resource' ); ?>>
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
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</div><!-- entry-wrapper -->

		<?php
		if ( $protected ) :
			if ( $protected[0] == 'true' ) :
		?>
			<div class="entry-meta">
				<p>CSU eID and password required</p>
			</div><!-- .entry-meta -->
		<?php
			endif;
		endif;
		?>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
