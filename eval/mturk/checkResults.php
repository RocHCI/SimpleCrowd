<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

# VARS



$session = $_REQUEST["session"];


# Headers
echo("<h2>Responses from the crowd for answer session <u>$session</u>:</h2>");

# Get the image we want users to label
passthru(escapeshellcmd('wget -O answers.json http://labs.gierad.com/youtilities/api/votesForSession/?session_id=' . $session));
exec('cat answers.json', $ansAry);
passthru('rm -f answers.json');
$ansStr = implode(",", $ansAry);
$ans_jsonObj = json_decode($ansStr, true);

//echo($ansStr."<br>");

# Find the sensor that matches our image data
$dIdx = -1;
for( $i = 0; $i < sizeof($ans_jsonObj); $i++ ) {
	// Get the information to find the image link
	$device = $ans_jsonObj[$i]["device_id"];
	$sensor = $ans_jsonObj[$i]["sensor_id"];
	$datapoint = $ans_jsonObj[$i]["datapoint"];

	$imgURL = 'https://labs.gierad.com/youtilities/datastream/image/'.$device.'/'.$sensor.'/'.$datapoint;

	// Get the rest of the response
	$answer = $ans_jsonObj[$i]["answer"];
	$flag = $ans_jsonObj[$i]["flag"];
	$flag_data = $ans_jsonObj[$i]["flag_data"];
	$linkHTML = "<a href=\"$imgURL\" target=\"_blank\" style=\"padding-bottom:10px\"><img src=\"$imgURL\" style=\"width:25px; height:25px\">  $device-$sensor-$datapoint.jpg ($answer, $flag, $flag_data)</a><br>";

	echo($linkHTML."<br>");
} 

echo("Done.");

// Done.


?>
