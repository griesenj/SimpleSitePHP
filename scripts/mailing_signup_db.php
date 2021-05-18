<html>
<head>
	<title>Mailing List Confirmation</title>
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
			$mailinglist = fopen("db/mailing_list.txt", "r") or die("Unable to access mailing list. Please try again later.");

			$isduplicate = False;
			while (!feof($mailinglist) && !$duplicate) {
				$line = fgets($mailinglist);
				$linestripped = str_replace("\r\n","",$line);

				if ($_POST['email'] == $linestripped) {
					$isduplicate = True;
				}			
			}
		?>

		<?php if ($isduplicate == False): ?>
			<h1>Success</h1>
		<?php endif; ?>

		<?php if ($isduplicate == True): ?>
			<h1>Failure</h1>
		<?php endif; ?>

		<?php
			$emailwritten = False;
			if(isset($_POST['email']) && $isduplicate == False) {
				$data = $_POST['email'] . "\r\n";

				$filename = "db/mailing_list.txt";
				$ret = file_put_contents($filename, $data, FILE_APPEND);

				if($ret == false) {
					die('Error adding email to mailing list.');
				}
				else {
					$emailwritten = True;
				}
			}
		?>
	
		<?php if ($emailwritten == True): ?>
			Thanks for signing up for our mailing list!</br><br>
			You will receive content at: <b><?php echo $_POST["email"]; ?></b></br>
		<?php endif; ?>

		<?php if ($emailwritten == False): ?>
			It looks like your email address is already on our mailing list!<br><br>
			You are currently receiving content at: <b><?php echo $_POST["email"]; ?></b></br>
		<?php endif; ?>

		<br>
		<b><a href="../index.html">Click here to return to our homepage!</a></b><br><br>

		<div class = "footer">
			CIS 501 Project One - 2021 (Jon Griesen)
		</div>

	</div>
</body>
</html>