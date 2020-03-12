<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		$args = array(
			'post_type'      => 'partner',
			'posts_per_page' =>  60,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'meta_query'     =>  array( array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS'
			) )
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :
		?>
		<div class="partners-section__grid">
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$post_ID = get_the_ID();
				$logo = get_the_post_thumbnail_url( $post_ID, 'medium' );

				if ( $url = get_field('partner_url') ) :
				?>

					<a class="partners-section__grid-item partners-section__grid-link" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
						<div class="partners-section__grid-logo" style="background-image:url(<?php echo esc_url($logo); ?>);">
							<span class="screen-reader-text"><?php the_title(); ?></span>
						</div>
					</a><!-- .partners-section__grid-item -->

				<?php else : ?>

					<div class="partners-section__grid-item">
						<div class="partners-section__grid-logo" style="background-image:url(<?php echo esc_url($logo); ?>);">
							<span class="screen-reader-text"><?php the_title(); ?></span>
						</div>
					</div><!-- .partners-section__grid-item -->

			<?php
				endif;
			endwhile;
			wp_reset_postdata();
			?>
		</div><!-- .partners-section__grid -->
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
