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
	
	<script type="text/javascript">
		var date = new Date;

		var seconds = date.getSeconds();
		var minutes = date.getMinutes();
		var hour = date.getHours();

		var year = date.getFullYear();
		var month = date.getMonth(); // beware: January = 0; February = 1, etc.
		var day = date.getDate();

		var dayOfWeek = date.getDay(); // Sunday = 0, Monday = 1, etc.
		var milliSeconds = date.getMilliseconds();

		document.write(hour);

	</script>

</div>


</body>
</html>
