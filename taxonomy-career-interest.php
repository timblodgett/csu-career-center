<?php
/**
 * Career Interest taxonomy template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */
$tax = get_queried_object();
$tax_name = $tax->name;
$tax_desc = $tax->description;
get_header();
?>

	<header class="entry-header" style="background-image:url(<?php echo wp_get_attachment_url( get_field( 'tax_feat_img', $tax ), 'large' ); ?>)">
		<div class="wrapper">
			<div class="header-content">
				<h1 class="entry-title"><?php echo esc_attr( $tax_name ); ?></h1>

				<?php if( !empty( $tax_desc ) ) : ?>
					<div class="entry-desc">
						<?php echo apply_filters( 'the_content', $tax_desc ); ?>
					</div><!-- .entry-desc -->
				<?php endif; ?>
			</div><!-- .header-content -->
		</div><!-- .wrapper -->
	</header><!-- .entry-header -->

	<div class="content-container">
		<div class="wrapper">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<article id="career-interest-<?php echo $tax->term_id; ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php if ( $posts = get_field( 'tax_feat_resources', $tax) ) : ?>
							<div class="resource-list">
								<?php foreach( $posts as $post ) : ?>
								<div class="resource-item">
									<div class="resource-image">
										<?php
										if ( has_post_thumbnail() ) :
											the_post_thumbnail('resource-thumb');
										else :
											echo '<img src="'.get_template_directory_uri().'/images/defaults/post_thumb_md.jpg" alt="">';
										endif;
										?>
									</div><!-- .resource-image -->

									<div class="resource-details">
										<h2 class="resource-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

										<div class="resource-excerpt">
											<?php the_excerpt(); ?>
										</div><!-- .resource-excerpt -->
									</div><!-- .resource-detail -->
								</div><!-- .resource-item -->
								<?php endforeach; ?>
							</div><!-- .resource-list -->
							<?php endif; ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
				</main><!-- #main -->
			</div><!-- #primary -->

			<!-- BEGIN sidebar() -->
			<aside id="secondary" class="widget-area">
				<?php get_template_part( 'template-parts/widget', 'events' ); ?>
				<?php get_template_part( 'template-parts/widget', 'jobs' ); ?>
			</aside>
			<!-- END sidebar() -->
		</div><!-- .wrapper -->
	</div><!-- .content-container -->

	<?php get_template_part( 'template-parts/featured', 'success-story' ); ?>

<?php
get_footer();
