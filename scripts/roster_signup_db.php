<html>
<head>
	<title>Roster Registration Confirmation</title>
</head>

<link rel="stylesheet" href="../styles/styles.css">

<div class = "navbar">
	<a href="../index.html">Disc Golf Information</a>
	<a href="../howtoplay.html">How to Play</a>
	<a href="../courses.html">Local Courses</a>
	<a href="../gear.html">Buy Gear</a></h2></a>
	<a href="../mailing.html">Mailing List</a>
	<a class = "right" href="../registration.html">Registration</a>
	<a class = "right" href="../roster.php">League Roster</a>
</div>

<body>
	<div class = "pagecontainer">
		<?php
			$playeradded = False;
			if(isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['phone'])) {
				$data = $_POST['first'] . ',' . $_POST['last'] . ',' . $_POST['email'] . ',' . $_POST['phone'] . "\r\n";

				$filename = "db/roster.txt";
				$ret = file_put_contents($filename, $data, FILE_APPEND);

				if($ret == false) {
					die('Could not add player information to roster.');
				}
				else {
					$playeradded = True;
				}
			}
			else {
				die('No data to process');
			}
		?>

		<?php if ($playeradded == True): ?>
			<h1>Success</h1>
			Thanks for signing up for our disc golf league, <b><?php echo $_POST["first"]; ?></b>!<br>
		<?php endif; ?>

		<?php if ($playeradded == False): ?>
			<h1>Failure</h1>
			Sorry, we were unable to add you to our disc golf league, <b><?php echo $_POST["first"]; ?></b>.<br>
		<?php endif; ?>

		<br>

		<b><a href="../roster.php">Click here to view the current league roster!</a></b><br><br>


		<div class = "footer">
			CIS 501 Project One - 2021 (Jon Griesen)
		</div>

	</div>
</body>
</html>