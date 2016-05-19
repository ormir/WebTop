
<div>
<select name="cities">
<?php
	$cities = array('Beverly Hills' => 90210,
		'Silicon Valley' => 94207,
		'Miami' => 33101,
		'New York' => 10001,
		'Hollywood' => 33019
		);

	foreach ($cities as $key => $value) {
		echo "<option value='".$value"'>".$key."</option>";
	}
	// for ($i=0; $i < sizeof($cities); $i++) { 
	// 	echo "<option value='".$cities[$i]"'>".key($cities[$i])."</option>"; 
	// }
?>
</select>
</div>

