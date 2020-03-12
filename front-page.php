<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if ( have_rows('front_page_slides') ) :
				$slides = get_field('front_page_slides');
				shuffle($slides);
			?>
			<div class="home-page-slides">
				<div class="slides">
					<?php
					foreach ( $slides as $slide ) :
						$expired = is_cc_home_page_slide_expired( date('Ymd'), $slide['expiration'] );

						// if not expired, show slide
						if ( !($expired) ) :
					?>
						<div class="slide">
						<?php
						$slide_img = $slide['img'];
						$img = wp_get_attachment_image( $slide_img['ID'], 'home-slide' );

						if ( $link = $slide['link'] ) {
							$target = ( $link['target'] ) ? ' target="_blank" rel="noopener"' : '';
							$url = $link['url'];
							echo '<a href="'.esc_url( $url ).'"'.$target.'>'.$img.'</a>';
						} else {
							echo $img;
						}
						?>
						</div><!-- .slide -->
					<?php
						endif;
					endforeach;
					?>
				</div><!-- .slides -->
			</div><!-- .home-page-slides -->
			<?php endif; ?>

			<div class="resources-and-jobs">
				<div class="wrapper">
					<div class="resource-list">
					<?php
					$args = array(
						'posts_per_page' => 6,
						'post_type'      => 'resource',
						'orderby'        => 'rand',
						'meta_query'     =>  array( array(
							'key'     => '_career_center_featured',
							'value'   =>  1,
							'orderby' => 'rand'
						) )
					);

					$the_query = new WP_Query( $args );

					if ( $the_query->have_posts() ) :
						while ( $the_query->have_posts() ) : $the_query->the_post();
					?>
						<div class="resource-item">
							<div class="resource-image">
								<?php the_post_thumbnail('resource-thumb'); ?>
							</div><!-- .resource-image -->

							<div class="resource-details">
								<h2 class="resource-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

								<div class="resource-excerpt">
									<?php the_excerpt(); ?>
								</div><!-- .resource-excerpt -->
							</div><!-- .resource-detail -->
						</div><!-- .resource-item -->
					<?php
						endwhile; wp_reset_postdata();
					endif;
					?>
					</div><!-- .resource-list -->

					<aside id="secondary" class="widget-area">
						<?php get_template_part( 'template-parts/widget', 'events' ); ?>
						<?php get_template_part( 'template-parts/widget', 'jobs' ); ?>
					</aside>
				</div><!-- .wrapper -->
			</div><!-- .resources-and-jobs -->

			<?php if ( have_rows('front_page_stats') ) : ?>
			<div class="stats-module">
				<div class="stats wrapper">
					<?php while ( have_rows('front_page_stats') ) : the_row(); ?>
					<div class="stat">
						<?php if ( $graphic = get_sub_field('graphic') ) : ?>
						<div class="stat-image">
							<?php echo wp_get_attachment_image( $graphic, 'large' ); ?>
						</div><!-- .stat-image -->
						<?php endif; ?>

						<div class="stat-data">
							<p>
								<span><?php the_sub_field('statistic'); ?></span>
								<?php the_sub_field('desc'); ?>
							</p>
						</div><!-- .stat-data -->
					</div><!-- .stat -->
					<?php endwhile; ?>
				</div><!-- .stats .wrapper -->
			</div><!-- .stats-module -->
			<?php endif; ?>

			<?php get_template_part( 'template-parts/featured', 'success-story' ); ?>

			<?php
			$args = array(
				'post_type'      => 'partner',
				'posts_per_page' =>  6,
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
			<div class="partners-section">
				<div class="wrapper">
					<?php if ( $heading = get_field('partners_heading') ) : ?>
					<h2 class="partners-section__title"><?php echo esc_attr($heading); ?></h2>
					<?php endif; ?>

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

					<?php if ( ( $link = get_field('partners_cta_link') ) && ( $text = get_field('partners_cta_text') ) ) : ?>
					<div class="partners-section__cta">
						<a class="button partners-section__button" href="<?php echo esc_url($link); ?>"><?php echo esc_attr($text); ?></a>
					</div><!-- .partners-section__cta -->
					<?php endif; ?>
				</div><!-- .wrapper -->
			</div><!-- .partners-section -->
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
