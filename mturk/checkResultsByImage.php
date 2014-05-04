<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

# VARS



$session = $_REQUEST["session"];


# Headers
echo("<h2>Responses from the crowd for answer session <u>$session</u>:</h2><br>");

# Get the image we want users to label
passthru(escapeshellcmd('wget -O answers.json http://labs.gierad.com/youtilities/api/votesForSession/?session_id=' . $session));
exec('cat answers.json', $ansAry);
passthru('rm -f answers.json');
$ansStr = implode(",", $ansAry);
$ans_jsonObj = json_decode($ansStr, true);

//echo($ansStr."<br>");

# Find the sensor that matches our image data
$dIdx = -1;
$elemAry = array();
$aggrAns = array();
for( $i = 0; $i < sizeof($ans_jsonObj); $i++ ) {
	// Get the information to find the image link
	$device = $ans_jsonObj[$i]["device_id"];
	$sensor = $ans_jsonObj[$i]["sensor_id"];
	$datapoint = $ans_jsonObj[$i]["datapoint"];

	$imgURL = 'https://labs.gierad.com/youtilities/datastream/image/'.$device.'/'.$sensor.'/'.$datapoint;

	if( !array_key_exists("$device-$sensor-$datapoint", $elemAry) ) {
		$elemAry["$device-$sensor-$datapoint"] = array("link" => $imgURL, "responses" => array());
	}

	// Get the rest of the response
	$answer = $ans_jsonObj[$i]["answer"];
	$flag = $ans_jsonObj[$i]["flag"];
	$flag_data = $ans_jsonObj[$i]["flag_data"];
	//$linkHTML = "<a href=\"$imgURL\" target=\"_blank\" style=\"padding-bottom:10px\"><img src=\"$imgURL\" style=\"width:25px; height:25px\">  $device-$sensor-$datapoint.jpg ($answer, $flag, $flag_data)</a><br>";

	passthru(escapeshellcmd('wget -O finans.dat http://roc.cs.rochester.edu/LegionAR/Labeling/CrowdSensors/answers.php?device_id=' . $device . '&sensor_id=' . $sensor . '&datapoint=' . $datapoint . '&session_id=' . $session));
	$finAry = array();
	exec('cat finans.dat', $finAry);
	passthru('rm -f finans.dat');
	$aggrAns["$device-$sensor-$datapoint"] = $finAry[0];
	array_push($elemAry["$device-$sensor-$datapoint"]["responses"], "($answer, $flag, $flag_data)");
}

$keySet = array_keys($elemAry);
for( $i = 0; $i < sizeof($keySet); $i++ ) {
	$curKey = $keySet[$i];
	$curElem = $elemAry[$curKey];
	$curAggr = $aggrAns[$curKey];

	$htmlContent = "<div style='height: 200px;'><img src=" . $curElem['link'] . " style=\"width:200px; height:150px; float:left; margin-right: 20px\"><div style='font-size:24px; font-weight:bold;'>$curKey</div>";
	$htmlContent = $htmlContent . "<b>Final Answer:  " . $curAggr . "</b><br>";
	$htmlContent = $htmlContent . "Image URL:  <a href='" . $curElem['link'] . "' target='_blank'>" . $curElem['link'] . "</a></b><br>";
	for( $k = 0; $k < sizeof($curElem['responses']); $k++ ) {
		if( $k > 0 ) {
			//$htmlContent = $htmlContent . ",";
		}
		$htmlContent = $htmlContent . "Worker #" . $k . ": " . $curElem['responses'][$k] . "<br>";
	}
	$htmlContent = $htmlContent . "</div>";


	echo($htmlContent."<br>");
}

echo("Done.");

// Done.


?>
