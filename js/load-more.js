jQuery(document).ready(function($) {

	// load more functionality for Resource Center
	$('.load-more-resources').click(function() {
		var button = $(this);
		var data = {
			'action' : 'loadmore',
			'query'  :  career_center_loadmore_params.resources_results,
			'page'   :  career_center_loadmore_params.resources_current_page
		};

		$.ajax({
			url        :  career_center_loadmore_params.ajaxurl,
			data       :  data,
			type       : 'POST',
			beforeSend :  function(xhr) {
				button.text('Loading...');
			},
			success    :  function(data) {
				if (data) {
					$('#resources-grid').append(data);
					$('#resources-grid').reloadItems();

					career_center_loadmore_params.resources_current_page++;

					if (career_center_loadmore_params.resources_current_page == career_center_loadmore_params.resources_max_page) {
						button.remove();
					}
				} else {
					button.prev().remove();
				}
			}
		});
	});

});
