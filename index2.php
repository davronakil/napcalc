<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NapCalc: Bedtime Calculator to help you calculate when to go to sleep and when to wake up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <meta name="description" content="NapCalc helps you calculate the best times to go to sleep and wake up feeling well rested.">
    <meta name="keywords" content="NapCalc, sleep calculator, wake up refreshed, Nap Calc bedtime calculator">
    <meta name="author" content="Davron Akil">

    <!-- iOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./icons/icon-180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./icons/icon-180.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./icons/icon-180.png">
    <link rel="manifest" href="./site.webmanifest">

    <!-- Updated jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7ieY22Y0HqHrN3T0/3Wk2J4wTc+E7ZKZ2HV" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1 style="color:#2D9C92">NapCalc <small>Wake Up Right</small></h1>
    </div>

    <form action="index2.php" method="POST">
        <div class="row">
            <h3 style="margin-left: 18px;"><small>If I go to sleep at (24H format) ...</small></h3><br/>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 col-xl-5">
                <select class="form-control" name="hour" id="hour">
                    <option id="hourSlot">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                var dt = new Date();
                                $("#hourSlot").html(dt.getHours());
                            });
                        </script>
                    </option>
                    <?php
                    for ($x = 0; $x < 24; $x++) {
                        echo "<option value=\"{$x}\"" . (($x == $_POST['hour']) && (isset($_POST['hour'])) ? " selected=\"selected\"" : "") . ">" . sprintf("%02d", $x) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 col-xl-5">
                <select class="form-control" name="minute" id="minute">
                    <option id="minuteSlot">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                var dt = new Date();
                                $("#minuteSlot").html(dt.getMinutes());
                            });
                        </script>
                    </option>
                    <?php
                    for ($x = 0; $x <= 55; $x += 5) {
                        echo "<option value=\"{$x}\"" . (($x == $_POST['minute']) && (isset($_POST['minute'])) ? " selected=\"selected\"" : "") . ">" . sprintf("%02d", $x) . "</option>";
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
    if (isset($_POST['hour']) && isset($_POST['minute'])) {
        $hour = $_POST['hour'];
        $minute = $_POST['minute'];
        $n = array(1, 2, 3, 4, 5, 6, 7); // Added one more sleep cycle
        $time_minutes = (($hour * 60) + $minute);
        $i = 0;
        echo "<br><h3><small>On average, it takes about 14 minutes to fall asleep, which is accounted for below. Set your alarm to one of these, depending on how many sleep cycles you wish to complete:</small></h3>";
        echo "<div class=\"row\">";
        while ($i < count($n)) {
            $wake_up_time_minutes[$i] = $time_minutes + 14 + ($n[$i] * 90);
            $wake_up_hour[$i] = floor($wake_up_time_minutes[$i] / 60);
            if ($wake_up_hour[$i] >= 24) {
                $wake_up_hour[$i] -= 24;
            }
            $wake_up_minute[$i] = $wake_up_time_minutes[$i] % 60;
            $wake_up_minute_padded[$i] = sprintf("%02d", $wake_up_minute[$i]);
            $wake_up_hour_padded[$i] = sprintf("%02d", $wake_up_hour[$i]);
            $color_array1 = array('#44c17b', '#3bb16f', '#349e63', '#2e8b57', '#28784b', '#21653f', '#1c4f33'); // Added one more color
            echo "<div style=\"text-align:center;\" class=\"col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2\">";
            echo "<h1 style=\"color:{$color_array1[$i]};\">{$wake_up_hour_padded[$i]}:{$wake_up_minute_padded[$i]}</h1>";
            echo "</div>";
            $i++;
        }
        echo "<br><br></div>";

        // Additional code for "fall asleep times" section if needed
    }
    ?>
</div>

<!-- prevent form submitting on refresh -->
<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
