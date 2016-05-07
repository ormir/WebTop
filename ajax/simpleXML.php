<?php
$html = " ";

//variable that stores the value of the url that is the data feed whatever website happens to have running
$url= "http://starwars.wikia.com/wiki/Yoda/api/v1/Articles/Details/?ids=50&abstract=100&width=200&height=200)";

echo $url;

//returns xml object 
$xml = simplexml_load_file($url);

//choosing how many items (lines) we want, thus we need a loop - in our case: 10 lines
for ($i = 0; $i < 10; $i++){


}
echo $html;

?>