<div>
<div id="city_drop_down">
<select name="cities" id="weather_drop_down">
<?php
	$cities = array('Beverly Hills' => 90210,
		'Silicon Valley' => 94207,
		'Miami' => 33101,
		'New York' => 10001,
		'Hollywood' => 33019
		);
	foreach ($cities as $key => $value) {
		echo "<option value='".$value."'>".$key."</option>";
	}
?>
</select>
</div>
<div id="weather_info">
	<img id="weathernow" src="images/weather.png"/>
	<h2 id="weather_city">City Name</h2>
	<h3 id="weather_desc">Description</h3>
	<h3 id="weather_temp">Temperature</h3>
</div>

</div> 