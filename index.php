<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>NapCalc: Bedtime Calculator to help you calculate when to go to sleep and when to wake up refreshed!</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">

	<div class="page-header">
	  <h1>NapCalc <small>Wake Up Refreshed</small></h1>
	</div>

		<form action="index.php" method="POST">
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 col-xl-5">
				<select class="form-control" name="hour" id="hour">
			<?php
			for($x = 0; $x < 24; $x++) {
				echo "<option value=\"".$x."\">".sprintf("%02d", $x)."</option>";
			}
			?>

				</select>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 col-xl-5">
				<select class="form-control" name="minute" id="minute">
			<?php
			for($x = 0; $x <= 55; $x = $x + 5) {
				echo "<option value=\"".$x."\">".sprintf("%02d", $x)."</option>";
			}
			?>
	
				</select>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
				<input type="submit" name="sleep" value="Calculate" class="form-control btn-success">
			</div>
		</div>
		</form>
	



<?php

///////////////////
// WAKE UP TIMES //
///////////////////

$hour = $_POST['hour'];
$minute = $_POST['minute'];
$n = array(1,2,3,4,5,6);
$time_minutes = (($hour * 60) + $minute);
$i = 0;

echo "<div class=\"row\">";
while( $i < count($n) )
{
	$wake_up_time_minutes[$i] = $time_minutes + 14 + ($n[$i] * 90);
	$wake_up_hour[$i] = floor($wake_up_time_minutes[$i] / 60);

	if ( $wake_up_hour[$i] > 24 )
	{
		$wakeup_hour[$i] = $wake_up_hour[$i] - 24;
	}
	else
	{
		$wakeup_hour[$i] = $wake_up_hour[$i];
	}

	if ( $wakeup_hour[$i] == 24 )
	{
		$wakeup_hour[$i] = 0;
	}

	$wake_up_minute[$i] = abs( ($wake_up_hour[$i] - (floor($wake_up_time_minutes[$i]) / 60)) * 60 );
	$wake_up_minute_padded[$i] = sprintf("%02d", $wake_up_minute[$i]);
	$wakeup_hour_padded[$i] = sprintf("%02d", $wakeup_hour[$i]);
	$color_array1 = array('#44c17b', '#3bb16f', '#349e63', '#2e8b57', '#28784b', '#21653f');
	
	echo "<div style=\"text-align:center;\" class=\"col-sm-2 col-md-2 col-lg-2 col-xl-2\">";
	echo "<h1 style=\"color:".$color_array1[$i].";\">".$wakeup_hour_padded[$i].":".$wake_up_minute_padded[$i]."</h1>";
	echo "</div>";
	
	$i = $i + 1;
}
echo "</div>";


///////////////////////
// FALL ASLEEP TIMES //
///////////////////////

$hour = $_POST['hour2'];
$minute = $_POST['minute2'];
$n = array(7,6,5,4,3);
$time_minutes = (($hour * 60) + $minute);
$i = 0;



while( $i < count($n) )
{
	$bed_time_minutes[$i] = $time_minutes - ($n[$i] * 90);

	if ( $bed_time_minutes[$i] < 0 )
	{
		$bedtime_minutes[$i] = 1440 + $bed_time_minutes[$i];
	}
	else
	{
		$bedtime_minutes[$i] = $bed_time_minutes[$i];
	}

	$bed_time_hour[$i] = floor($bedtime_minutes[$i] / 60);
	$bed_time_minute[$i] = (($bedtime_minutes[$i] / 60) - floor($bedtime_minutes[$i] / 60))*60;
	$bed_time_minute_padded[$i] = sprintf("%02d", $bed_time_minute[$i]);

	// echo $bed_time_hour[$i];
	// echo ":";
	// echo $bed_time_minute_padded[$i];
	// echo "<br>";
	

	$i = $i + 1;
}

//echo "*** The bedtime values directly above represent the times you should aim to be asleep.  On average it takes ~14 minutes to fall asleep.  Plan accordingly.";

?>






</div>


</body>
</html>









