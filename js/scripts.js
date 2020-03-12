jQuery(document).ready(function($) {

	// Home page Slides
	if( $('.home-page-slides .slides').length > 0 ) {
		$('.home-page-slides .slides').slick({
			infinite: false,
			prevArrow: '<button type="button" class="slick-prev"><span class="screen-reader-text">Previous</span><span class="fas fa-chevron-left"></span></button>',
			nextArrow: '<button type="button" class="slick-next"><span class="screen-reader-text">Next</span><span class="fas fa-chevron-right"></span></button>'
		});

		// add click track event for home page slides
		$('.home-page-slides .slide a').click(function(e) {
			ga('send', {
				hitType: 'event',
				eventCategory: 'Home Page Slides',
				eventAction: 'click',
				eventLabel: $(this).attr('href')
			});
		});
	};

	// add click track event for Partner links
	if( $('.partners-section__grid').length > 0 ) {
		$('.home .partners-section__grid-item').click(function(e) {
			ga('send', {
				hitType: 'event',
				eventCategory: 'Partner [Home page]',
				eventAction: 'click',
				eventLabel: $(this).attr('href')
			});
		});

		$('.page-template-partners .partners-section__grid-item').click(function(e) {
			ga('send', {
				hitType: 'event',
				eventCategory: 'Partner [Partners page]',
				eventAction: 'click',
				eventLabel: $(this).attr('href')
			});
		});
	};

	// Resources Filter Form
	if( $('.filter-cat').length > 0 ) {
		$('.filter-cat button').click(function() {
			$(this).attr('aria-expanded', function(i, attr) {
				$(this).parent().next().attr('aria-hidden', attr);
				return attr == 'true' ? 'false' : 'true';
			});
		});
	};

	// Resubmit Resources Filter Form After Option Selected
	if( $('.filter-options').length > 0 ) {
		$('.filter-options').submit(function() {
			$(this).find(':input').filter(function() { return !this.value; }).attr('disabled', 'disabled');
			return true;
		});

		$('.filter-options').find(':input').prop('disabled', false);

		$('.filter-cat-option input[type=checkbox]').change(function() {
			$('.filter-options').submit();
		});

		if( $('.resources-tags').length > 0 ) {
			$('.resource-tag button').click(function() {
				filterName = $(this).data('name');
				filterValue = $(this).data('value');
				if ( filterName == 'keyword' ) {
					$('.filter-options input[name="'+filterName+'"]').prop('value', '');
				} else {
					$('.filter-options input[name="'+filterName+'"][value="'+filterValue+'"]').prop('checked', false);
				}
				$('.filter-options').submit();
			});
		}
	};

	// Resources Masonry
	if( $('.resources-grid').length > 0 ) {
		// initialize Masonry grid
		var $resourcesGrid = $('#resources-grid').masonry({
			columnWidth: '.resource',
			gutter: '.grid-gutter',
			itemSelector: '.resource'
		});

		// layout grid once images are loaded
		$resourcesGrid.imagesLoaded().progress( function() {
			$resourcesGrid.masonry('layout');
		});

		// load more functionality
		$('.load-more-resources').click(function() {
			var button = $(this);
			var loadmoreParams = career_center_loadmore_params;
			var data = {
				'action' : 'loadmore',
				'query'  :  loadmoreParams.posts,
				'page'   :  loadmoreParams.current_page
			};

			$.ajax({
				url        :  loadmoreParams.ajaxurl,
				data       :  data,
				method     : 'POST',
				beforeSend :  function(xhr) {
					button.text( button.data('loading') );
				},
				success    :  function(data) {
					var dataObj = $(data);

					nextPost = $(dataObj[0]);
					nextPostID = '#'+$(nextPost).attr('id');

					$resourcesGrid.append(dataObj);
					$resourcesGrid.imagesLoaded(function() {
						$resourcesGrid.masonry( 'appended', dataObj );
					});

					if (dataObj) {
						setTimeout( function() {
							button.text( button.data('loaded') );
							$(nextPostID).children('a').focus();
						}, 750);
						loadmoreParams.current_page++;

						if (loadmoreParams.current_page == loadmoreParams.max_page) {
							button.remove();
						}
					} else {
						button.prev().remove();
					}
				}
			});
		});
	};

	// add click track event for single resources
	if( $('.resource-template-default .entry-actions a').length > 0 ) {
		$('.resource-template-default .entry-actions a').click(function(e) {
			ga('send', {
				hitType: 'event',
				eventCategory: 'Resources',
				eventAction: 'click',
				eventLabel: $(this).attr('href')
			});
		});
	};

	// add click track event for single employer resources
	if( $('.emp_resource-template-default .entry-actions a').length > 0 ) {
		$('.emp_resource-template-default .entry-actions a').click(function(e) {
			ga('send', {
				hitType: 'event',
				eventCategory: 'Employer Resources',
				eventAction: 'click',
				eventLabel: $(this).attr('href')
			});
		});
	};

	// Accordion controls
	if ( $('.accordion-group').length > 0 ) {
		$('.accordion-group').each(function() {
			$(this).addClass('active');
		});

		$('.accordion-title').each(function() {
			$accordionTitle = $(this).html();

			$(this).html('<button aria-expanded="false">'+$accordionTitle+'<span class="fas fa-chevron-down"></span></button>');
		});

		$('.accordion-content').each(function() {
			$(this).attr('aria-hidden', 'true');
		});

		$('.accordion-title button').click(function() {
			$(this).attr('aria-expanded', function(i, attr) {
					$(this).parent().next().attr('aria-hidden', attr);
					return attr == 'true' ? 'false' : 'true';
			});
		});
	};

	// Accordion controls
	if ( $('.report-button').length > 0 ) {

		$('.report-button').click(function() {
			// $(this).attr('disabled', true);
			$(this).attr('aria-expanded', true);

			reportForm = $(this).next('.report-form');
			reportForm.attr('aria-hidden', 'false');
		});
	};

});
