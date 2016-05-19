$(function(){

	$('#weather_drop_down').change(function(event){
		var value = $(this).find(":selected").val();
		$.ajax({
			url: 'ajax/weather_data.php',
			type: 'POST',
			data: {"cityZIP": value},
		})
		.done(function(response) {
			console.log(response);
		});
	});

});

function retrieveData () {
	 //where the data from the web service is retrieved..?
}