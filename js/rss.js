$(function() {

	// Get add RSS from DB
	$.ajax({
		url: 'ajax/rss.php',
		type: 'post',
		data: {"getAllRss": true},
	})
	.done(function(elementList) {
		// console.log(elementList);
		$.each(elementList, function(index, val) {
			// addToMyRss(val.id, val.title, val.description, val.link, val.date);
			addToMyRss(val);
		});
	});
	

	// Add new RSS to DB
	$('#addRssBtn').click(function(event) {
		$.ajax({
		url: 'ajax/rss.php',
		type: 'post',
		data: {"addNewRss": 
			{
				"title": $("#addRssTitle").val(), 
				"link": $("#addRssLink").val(), 
				"date": $("#addRssDate").val(), 
				"description": $("#addRssDesctiption").val()
			}},
		success: function (responce) {
				if (responce.success == 1){
					addToMyRss(responce.rss);
					$("#addRssTitle").val("");
					$("#addRssLink").val("");
					$("#addRssDate").val("");
					$("#addRssDesctiption").val("");
				} else {
					console.log(responce.sql);
				}
			}
		});
	});

	// Edit RSS
	$('#myRss').on('click', '.rss-edit-btn', function() {

		var rssInputList = $(this).parent().find('.rss-edit-input');

		$.each(rssInputList, function(index, input) {
			var sib = $(input).siblings();
			$(input).val(sib.html());
			sib.hide();
			$(input).show();
		});

		$(this).siblings('.rss-save-btn').show();
		$(this).siblings('.rss-cancel-btn').show();
		$(this).siblings('.rss-delete-btn').hide();
		$(this).hide();
	});

	// Save edited RSS
	$('#myRss').on('click', '.rss-save-btn', function() {

		rssInputList = $(this).parent().find('.rss-edit-input');
		var rssChanges = {"id": $(this).parent().attr('data-id')};

		$.each(rssInputList, function(index, input) {
			// Save changed inputs
			if ($(input).val() != ""){
				rssChanges[$(input).attr('data-type')] = $(input).val();
				var sib = $(input).siblings();
				sib.html($(input).val());	
			}

			sib.show();
			$(input).hide();
		});

		// Send changes
		$.ajax({
			url: 'ajax/rss.php',
			type: 'post',
			data: {"rss_edit": rssChanges},
			success: function (responce) {
				if (responce.success == 1){
					// Show saved values
				} else {
					console.log(responce);
				}
			}
		});

		$(this).siblings('.rss-edit-btn').show();
		$(this).siblings('.rss-delete-btn').show();
		$(this).siblings('.rss-cancel-btn').hide();
		$(this).hide();
	});

	// Cancel edit
	$('#myRss').on('click', '.rss-cancel-btn', function() {

		var rssInputList = $(this).parent().find('.rss-edit-input');

		$.each(rssInputList, function(index, input) {
			$(input).siblings().show();
			$(input).val("");
			$(input).hide();
		});

		$(this).siblings('.rss-edit-btn').show();
		$(this).siblings('.rss-delete-btn').show();
		$(this).siblings('.rss-save-btn').hide();
		$(this).hide();
	});

	// Delete RSS
	$('#myRss').on('click', '.rss-delete-btn', function() {
		var thisRss = $(this).parent();
		$.ajax({
			url: 'ajax/rss.php',
			type: 'post',
			data: {"rss_delete": thisRss.attr('data-id')},
			success: function (responce) {
				if (responce.success == 1){
					// Remove element
					thisRss.remove();
				} else {
					console.log(responce);
				}
			}
		});
	});

	function addToMyRss (rssEl) {
		$.get('template/rss.template.html', function(data) {
			var dataFilter = $(data).filter('#template');
			var dataHtml = dataFilter.html();
			$('#myRss').append(Mustache.render(dataHtml, rssEl));
		});
	}
});