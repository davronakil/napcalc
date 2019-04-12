<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>NapCalc: Bedtime Calculator to help you calculate when to go to sleep and when to wake up refreshed!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="//code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	
	
</head>
<body>

<div class="container">

	<div class="page-header">
	  <h1 style="color:#2D9C92">NapCalc <small>Wake Up Right</small></h1>
	</div>

		<form action="index.php" method="POST">
		<div class="row">
			<h3 style="margin-left: 18px;"><small>If I go to sleep at (24H format) ...</small></h3><br />
		</div>
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 col-xl-5">
				<select class="form-control" name="hour" id="hour">
					<option id="hourSlot">
						
						<script type="text/javascript">
							(function($) { 
							  $(function() {
							    // more code using $ as alias to jQuery
							    var dt = new Date();
								var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();


							    $("#hourSlot").html(dt.getHours());

							  });
							})(jQuery);


							// prevent Submit on refresh.
							if ( window.history.replaceState ) {
						        window.history.replaceState( null, null, window.location.href );
						    }

						</script>	
					</option>
					
	
			<?php
			for($x = 0; $x < 24; $x++) {
				echo "<option value=\"".$x."\"";
				if (($x == $_POST['hour']) && (isset($_POST['hour']))) 
				{
					echo " selected=\"selected\"";
				}
				echo ">".sprintf("%02d", $x)."</option>";
			}
			?>

				</select>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 col-xl-5">
				<select class="form-control" name="minute" id="minute">
				
				<option id="minuteSlot">
						
						<script type="text/javascript">
							(function($) { 
							  $(function() {
							    // more code using $ as alias to jQuery
							    var dt = new Date();
								var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();


							    $("#minuteSlot").html(dt.getMinutes());

							  });
							})(jQuery);
						</script>	
					</option>


			<?php
			for($x = 0; $x <= 55; $x = $x + 5) 
			{
				echo "<option value=\"".$x."\"";
				if (($x == $_POST['minute']) && (isset($_POST['minute']))) 
				{
					echo " selected=\"selected\"";
				}
				echo ">".sprintf("%02d", $x)."</option>";
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

if (!(isset($_POST['hour']))) {
	exit();
}

$hour = $_POST['hour'];
$minute = $_POST['minute'];
$n = array(1,2,3,4,5,6);
$time_minutes = (($hour * 60) + $minute);
$i = 0;
echo "<br><h3><small>On average, it takes about 14 minutes to fall asleep, which is accounted for below. Set your alarm to one of these, depending on how many sleep cycles you wish to complete:</small></h3>";


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

echo "<br><br></div>";


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





