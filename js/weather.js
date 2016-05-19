$(function(){

	$('#weather_drop_down').change(function(event){
		var value = $(this).find(":selected").val();
		$.ajax({
			url: 'includes/weather.php',
			type: 'POST',
			data: {"cityZIP": value},
			success: function (response) {
				if (response.success == 1){
					
				} else {
					console.log(response);
				}
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

});

function retrieveData ($(this)) {
	 //where the data from the web service is retrieved..?
}