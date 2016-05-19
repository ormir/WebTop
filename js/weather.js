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

			}else{
				console.log(response.message);
			}
		});
	});

});

function retrieveData () {
	 //where the data from the web service is retrieved..?
}