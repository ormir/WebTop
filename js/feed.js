$(function() {
	$('#feed-btn').click(function() {
		console.log("Read feed: '" + $('#feed-link').val() + "'");

		// Get add RSS from DB
		$.ajax({
			url: 'ajax/feed.php',
			type: 'post',
			data: {"feed_read": $('#feed-link').val()},
		})
		.done(function(response) {
			console.log(response);
			if (response.success == 1) {
				$.each(response.feed, function(index, val) {
					addToMyFeed(val);
				});
			}
		});
	});
	function addToMyFeed (feedEl) {
		$.get('template/rss.template.html', function(data) {
			var dataFilter = $(data).filter('#template');
			var dataHtml = dataFilter.html();
			$('#feed-show').append(Mustache.render(dataHtml, feedEl));
		});
	}
});