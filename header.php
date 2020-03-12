<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything
 * up until <div id="content">.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Career_Center
 */

$identifier = __( 'Career Center', 'csu-career-center' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
	if( is_page_template('lcd-slides.php') ) {
		// get page refresh rate (in sec) and convert to minutes - default 1 hour
		$refresh_rate = get_field( 'lcd_slides_page_refresh_speed', get_the_ID() );
		$refresh_rate = $refresh_rate
						  ?  round( floatval( $refresh_rate ) * 60 )
						  : $refresh_rate = '3600';
		echo "<meta http-equiv='refresh' content='$refresh_rate'>";
	}
	?>

	<link rel="profile" href="//gmpg.org/xfn/11">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-57x57.png'; ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-60x60.png'; ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-72x72.png'; ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-76x76.png'; ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-114x114.png'; ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-120x120.png'; ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-144x144.png'; ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-152x152.png'; ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-180x180.png'; ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri().'/images/favicon/android-icon-192x192.png'; ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri().'/images/favicon/favicon-32x32.png'; ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri().'/images/favicon/favicon-96x96.png'; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri().'/images/favicon/favicon-16x16.png'; ?>">
	<link rel="manifest" href="<?php echo get_template_directory_uri().'/images/favicon/manifest.json'; ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri().'/images/favicon/ms-icon-144x144.png'; ?>">
	<meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a href="#content" class="skip-link screen-reader-text"><?php esc_html_e( 'Skip to content', 'csu-career-center' ); ?></a>

	<header id="masthead" class="site-header" aria-owns="content">
		<div class="header-top">
			<div class="wrapper">
				<div class="site-branding">
					<div class="csu-signature">
						<a href="//www.colostate.edu/" class="signature-link" target="_blank" rel="noopener">
							<span class="screen-reader-text"><?php _e( 'Colorado State University', 'csu-career-center' ); ?></span>
						</a>
					</div><!-- .csu-signature -->

					<?php if ( is_front_page() ) : ?>
						<h1 class="secondary-identifier">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="identifier-link" rel="home"><?php echo $identifier; ?></a>
						</h1><!-- .secondary-identifier -->
					<?php else : ?>
						<div class="secondary-identifier">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="identifier-link" rel="home"><?php echo $identifier; ?></a>
						</div><!-- .secondary-identifier -->
					<?php endif; ?>
				</div><!-- .site-branding -->

				<div class="top-nav">
					<a class="nav-item" href="<?php echo esc_url( home_url().'/resumes' ); ?>">
						<span class="nav-item-icon fas fa-file-alt"></span>
						<span class="nav-item-text"><?php _e( 'Resumes', 'csu-career-center' ); ?></span>
					</a>
					<a class="nav-item" href="<?php echo esc_url( home_url().'/connect-1-on-1' ); ?>">
						<span class="nav-item-icon fas fa-hands-helping"></span>
						<span class="nav-item-text"><?php _e( 'Connect 1:1', 'csu-career-center' ); ?></span>
					</a>
					<a class="nav-item" href="<?php echo esc_url( home_url().'/jobs' ); ?>">
						<span class="nav-item-icon fas fa-id-card-alt"></span>
						<span class="nav-item-text"><?php _e( 'Jobs', 'csu-career-center' ); ?></span>
					</a>
				</div><!-- .top-nav -->
			</div><!-- .wrapper -->
		</div><!-- .header-top -->

		<nav id="site-navigation" class="header-nav main-navigation">
			<div class="wrapper">
				<form role="search" method="get" class="search-form" action="<?php echo home_url( '/search-results/' ); ?>">
					<label class="search-label">
						<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
						<input type="search" class="search-field gsc-input" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="q" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" autocomplete="off" spellcheck="false" /><!-- .search-field -->
					</label><!-- .search-label -->
					<button type="submit" class="search-submit">
						<span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button' ) ?></span>
						<span class="fas fa-search"></span>
					</button><!-- .search-submit -->
				</form><!-- .search-form -->

				<button id="primary-menu-toggle" class="menu-toggle" aria-controls="primary-menu">
					<span class="fas fa-bars"></span>
					<?php esc_html_e( 'Menu', 'csu-career-center' ); ?>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'depth'          =>  2
				) );
				?>
			</div><!-- .wrapper -->
		</nav><!-- .main-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
