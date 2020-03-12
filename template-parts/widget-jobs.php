<?php
$api_url = 'https://wsnet2.colostate.edu/cwis0/careercenter/api/Parse/GetRSSFeed?url=';

if ( is_tax('career-interest') ) {
	$feed_url = urlencode( get_field( 'tax_rel_jobs', get_queried_object() ) );
	$widget_title = __( 'Related Jobs', 'csu-career-center' );
	$no_jobs_msg = __( 'No related jobs at this time.', 'csu-career-center' );
} elseif ( is_front_page() ) {
	$feed_url = urlencode( get_field( 'front_page_jobs' ) );
	$widget_title = __( 'Featured Jobs', 'csu-career-center' );
	$no_jobs_msg = __( 'No jobs posted at this time.', 'csu-career-center' );
}

$is_error = is_wp_error( $request = wp_remote_get( $api_url . $feed_url ) );

$response_code = wp_remote_retrieve_response_code( $request );
?>


<section id="handshake-jobs" class="widget widget_jobs">
	<h2 class="widget-title"><?php echo $widget_title; ?></h2>

	<div class="widget-content">
		<?php
		if ( (! $is_error) && ($response_code == 200) ) :
			$body = wp_remote_retrieve_body( $request );

			if ( ! empty( $data = json_decode( $body ) ) ) : $count = 0;
		?>
			<div class="job-list">
				<?php foreach ( $data as $job ) : ?>
				<div class="job-posting">
					<div class="job-details">
						<h3 class="job-title"><a href="<?php echo esc_url( $job->JobUrl ); ?>" target="_blank" rel="noopener"><?php echo esc_attr( $job->JobTitle ); ?></a></h3>
						<p class="job-company"><?php echo esc_attr( $job->CompanyName ); ?></p>
					</div>
				</div><!-- .job-posting -->
				<?php
					if ( ++$count == 5 ) break; // limit to first 5 job postings
				endforeach;
				?>
			</div><!-- .job-list -->
			<?php else : ?>
			<p class="not-found"><?php echo $no_jobs_msg; ?></p>
			<?php endif; ?>
		<?php else : ?>
		<p class="not-found"><?php echo $no_jobs_msg; ?></p>
		<?php endif; ?>
		<p class="view-all-link">
			<a class="button" href="https://colostate.joinhandshake.com/" target="_blank" rel="noopener"><?php _e( 'View All Jobs', 'csu-career-center' ); ?></a>
		</p>
	</div><!-- .widget-content -->
</section><!-- .widget_jobs -->
