<?php
/**
 * Template part for displaying page content in flexible.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Career_Center
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="wrapper">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div><!-- .wrapper -->
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php
	if ( have_rows( 'layout_blocks' ) ) :
		while ( have_rows( 'layout_blocks' ) ) : the_row();
			$bg_color = get_sub_field('bg_color');

			if ( get_row_layout() == 'basic' ) :
	?>

			<div class="layout-block basic-content bg-<?php echo $bg_color; ?>">
				<div class="wrapper">
					<?php the_sub_field('content'); ?>
				</div>
			</div>

	<?php
			elseif ( get_row_layout() == 'side_img' ) :
				$img = get_sub_field('img');
				$img_pos = get_sub_field('img_pos');
	?>

			<div class="layout-block side-image image-<?php echo $img_pos; ?> bg-<?php echo $bg_color; ?>">
				<div class="wrapper">
					<div class="image">
						<?php echo wp_get_attachment_image( $img, 'large' ); ?>
					</div>
					<div class="content">
						<?php the_sub_field('content'); ?>
					</div>
				</div>
			</div>

	<?php
			elseif ( get_row_layout() == '3_col' ) :
	?>

			<div class="layout-block three-col bg-<?php echo $bg_color; ?>">
				<div class="wrapper">
				<?php if ( $block_heading = get_sub_field('heading') ) : ?>
					<h2 class="block-heading"><?php the_sub_field('heading'); ?></h2>
				<?php endif; ?>

				<?php if ( have_rows( 'columns' ) ) : ?>
					<div class="columns">
					<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
						<div class="column">
							<?php
							if ( $img = get_sub_field('img') ) :
								echo wp_get_attachment_image( $img, 'full' );
							endif;
							?>

							<?php
							if ( $col_heading = get_sub_field('heading') ) :
								if ( $block_heading ) :
							?>
								<h3 class="column-heading"><?php echo $col_heading; ?></h3>
								<?php else : ?>
								<h2 class="column-heading"><?php echo $col_heading; ?></h2>
							<?php
								endif;
							endif;
							?>

							<?php echo apply_filters( 'the_content', get_sub_field( 'content' ) ); ?>

							<?php if ( $button = get_sub_field('button') ) : ?>
							<p><a class="button" href="<?php echo esc_url( $button['url'] ); ?>" <?php echo ( $button['target'] ) ? 'target="_blank" rel="noopener"' : ''; ?>><?php echo $button['title']; ?></a></p>
							<?php endif; ?>
						</div><!-- .column -->
					<?php endwhile; ?>
					</div><!-- .columns -->
				<?php endif; ?>
				</div>
			</div><!-- .three-col -->

	<?php
			elseif ( get_row_layout() == '2_col' ) :
	?>

			<div class="layout-block two-col bg-<?php echo $bg_color; ?>">
				<div class="wrapper">
				<?php if ( have_rows( 'columns' ) ) : ?>
					<div class="columns">
					<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
						<div class="column">
							<?php the_sub_field( 'content' ); ?>
						</div><!-- .column -->
					<?php endwhile; ?>
					</div><!-- .columns -->
				<?php endif; ?>
				</div><!-- .wrapper -->
			</div><!-- .two-col -->

	<?php
			endif;
		endwhile;
	endif;
	?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
