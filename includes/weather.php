<div>
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