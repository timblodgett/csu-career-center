<?php
$api_url = 'https://www.trumba.com/calendars/career-ram.json';

if ( is_tax('career-interest') ) {
	$widget_title = __( 'Related Events', 'csu-career-center' );
	$no_events_msg = __( 'No related events scheduled at this time.', 'csu-career-center' );
	$feed_url = '?filterview='.get_queried_object()->slug;
} else {
	$widget_title = __( 'Upcoming Events', 'csu-career-center' );
	$no_events_msg = __( 'No events scheduled at this time.', 'csu-career-center' );
	$feed_url = '';
}

$is_error = is_wp_error( $request = wp_remote_get( $api_url . $feed_url ) );
$response_code = wp_remote_retrieve_response_code( $request );
?>

<section id="related-events" class="widget widget_events">
	<h2 class="widget-title"><?php echo $widget_title; ?></h2>

	<div class="widget-content">
		<?php
		if ( (! $is_error) && ($response_code == 200) ) :
			$body = wp_remote_retrieve_body( $request );

			if ( ! empty( $data = json_decode( $body ) ) ) : $count = 0;
		?>
			<div class="event-list">
				<?php
				foreach ( $data as $event ) :
					$permalink = $event->permaLinkUrl;
					$title = $event->title;
					$location = strip_tags( $event->location );
					$start_date_time = $event->startDateTime;
					$date = DateTime::createFromFormat( 'Y-m-d\TH:i:s', $start_date_time );
					$all_day = $event->allDay;
				?>
				<div class="event">
					<time class="event-start">
						<span class="date">
							<abbr class="month" title="<?php echo $date->format('F'); ?>"><?php echo $date->format('M'); ?></abbr>
							<span class="day"><?php echo $date->format('j'); ?></span>
						</span>
						<span class="time">
							<?php
							if ( $all_day ) {
								_e( 'All Day', 'csu-career-center' );
							} elseif ( $date->format('g:i') == '12:00' ) {
								_e( 'Noon', 'csu-career-center' );
							} elseif ( $date->format('i') == '00' ) {
								echo $date->format('ga');
							} else {
								echo $date->format('g:ia');
							}
							?>
						</span>
					</time><!-- event-start -->

					<div class="event-details">
						<h3 class="event-title"><a href="<?php echo esc_url( $permalink ); ?>" target="_blank" rel="noopener"><?php echo esc_attr( $title ); ?></a></h3>
						<p class="event-location"><?php echo $location; ?></p>
					</div><!-- .event-details -->
				</div><!-- .event -->
				<?php
					if ( ++$count == 5 ) break; // limit to first 5 job postings
				endforeach;
				?>
			</div><!-- .event-list -->
			<?php else : ?>
			<p class="not-found"><?php echo $no_events_msg; ?></p>
			<?php endif; ?>
		<?php else : ?>
		<p class="not-found"><?php echo $no_events_msg; ?></p>
		<?php endif; ?>
		<p class="view-all-link">
			<a class="button" href="<?php echo esc_url( home_url().'/events' ); ?>"><?php _e( 'View All Events', 'csu-career-center' ); ?></a>
		</p>
	</div><!-- .widget-content -->
</section><!-- .widget_jobs -->
