<?php
/**
 * Template Name: Calendar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

get_header();
?>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php csu_career_center_post_thumbnail(); ?>

			<div class="entry-content">
				<script type="text/javascript" src="//www.trumba.com/scripts/spuds.js"></script>

				<div class="mobile-calendar">
					<script type="text/javascript">
						$Trumba.addSpud({
							webName: "career-ram",
							spudType : "main" ,
							spudConfig : "mobile"
						});
					</script>
				</div><!-- .mobile-calendar -->

				<div class="full-calendar">
					<script type="text/javascript">
						$Trumba.addSpud({
							webName: "career-ram",
							spudType : "main"
						});
					</script>
				</div><!-- .full-calendar -->
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrapper -->
<?php
get_footer();
