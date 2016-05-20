$(function(){
//Ajax request, receiving data
	$('#weather_drop_down').change(function(event){
		var value = $(this).find(":selected").val();
		$.ajax({
			url: 'ajax/weather_data.php',
			type: 'POST',
			data: {"cityZIP": value},
		})
		.done(function(response) {
			if(response.success == 1){
				$('#weather_city').html(response.message.City);
				$('#weather_desc').html(response.message.Description);
				$('#weather_temp').html(response.message.Temperature);
				$('#weathernow').attr("src", response.imgURL);

			}else{
				console.log(response.message);
			}
		});
	});

});

function retrieveData () {
	 //where the data from the web service is retrieved..?
}