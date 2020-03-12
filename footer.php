<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Career_Center
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="main-footer">
			<div class="wrapper">
				<div class="footer-widget footer-1">
					<?php
					if ( is_active_sidebar( 'footer-1' ) ) {
						dynamic_sidebar( 'footer-1' );
					}
					?>
				</div><!-- .footer-widget -->

				<div class="footer-widget footer-2">
					<?php
					if ( is_active_sidebar( 'footer-2' ) ) {
						dynamic_sidebar( 'footer-2' );
					}
					?>
				</div><!-- .footer-widget -->

				<div class="footer-widget footer-3">
					<?php
					if ( is_active_sidebar( 'footer-3' ) ) {
						dynamic_sidebar( 'footer-3' );
					}
					?>
				</div><!-- .footer-widget -->

				<div class="footer-widget footer-4">
					<section class="widget widget_giving">
						<div class="wrapper">
							<h2 class="widget-title">
								<img src="<?php echo get_template_directory_uri().'/images/StateYourPurpose.png'; ?>" alt="<?php _e( 'State Your Purpose - the campaign for Colorado State University', 'csu-career-center' ); ?>">
							</h2>
							<p><a class="give-link" href="//giving.colostate.edu/"><img src="<?php echo get_template_directory_uri().'/images/GiveNow.png'; ?>" alt="<?php _e( 'Give Now', 'csu-career-center' ); ?>"></a></p>
						</div><!-- .wrapper -->
					</section>
				</div><!-- .footer-widget -->

				<div class="footer-widget footer-5">
					<section class="widget widget_social">
						<h2 class="widget-title screen-reader-text"><?php _e( 'Connect on Social Media', 'csu-career-center' ); ?></h2>
						<ul class="social-links">
							<li class="social-link">
								<a href="//www.facebook.com/ColoStateCareerCenter/" target="_blank" rel="noopener" aria-label="<?php _e( 'Visit us on Facebook', 'csu-career-center' ); ?>">
									<span class="fab fa-facebook-f"></span>
								</a>
							</li>
							<li class="social-link">
								<a href="//www.instagram.com/csucareercenter/?hl=en" target="_blank" rel="noopener" aria-label="<?php _e( 'Visit us on Instagram', 'csu-career-center' ); ?>">
									<span class="fab fa-instagram"></span>
								</a>
							</li>
							<li class="social-link">
								<a href="//twitter.com/CSUCareerCenter" target="_blank" rel="noopener" aria-label="<?php _e( 'Visit us on Twitter', 'csu-career-center' ); ?>">
									<span class="fab fa-twitter"></span>
								</a>
							</li>
						</ul>
					</section>
				</div><!-- .footer-widget -->
			</div><!-- .wrapper -->
		</div><!-- .main-footer -->

		<div class="csu-footer">
			<div class="wrapper">
				<div class="footer-details">
					<div class="csu-nav">
						<ul class="menu">
							<li class="menu-item">
								<a href="//admissions.colostate.edu/" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Apply to CSU', 'csu-career-center' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-contact.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Contact CSU', 'csu-career-center' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-disclaimer.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Disclaimer', 'csu-career-center' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-equalop.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Equal Opportunity', 'csu-career-center' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-privacy.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Privacy Statement', 'csu-career-center' ); ?></a>
							</li><!-- .menu-item -->
						</ul><!-- .menu -->
					</div><!-- .csu-nav -->

					<div class="copyright">
						<span>&copy; <?php echo date('Y'); ?> <?php _e( 'Colorado State University', 'csu-career-center' ); ?></span>
					</div><!-- .copyright -->
				</div><!-- .footer-details -->

				<div class="footer-signature">
					<a href="//www.colostate.edu/" target="_blank" rel="noopener">
						<img src="<?php echo esc_url( get_template_directory_uri().'/images/wordmark-goldring-reversed.svg' ); ?>" alt="Colorado State University">
					</a>
				</div><!-- .footer-signature -->
			</div><!-- .wrapper -->
		</div><!-- .csu-footer -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<script>
	(function() {
		var cx = '001074770120494240330:6_luvukbd8g';
		var gcse = document.createElement('script');
		gcse.type = 'text/javascript';
		gcse.async = true;
		gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
		var q = document.getElementsByTagName('script')[0];
		q.parentNode.insertBefore(gcse, q);
	})();
</script>

<?php wp_footer(); ?>

</body>
</html>
