<html>
<head>
	<title>Unsubscribe Confirmation</title>
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
			$filename = "db/mailing_list.txt";
			$mailinglist = fopen($filename, "r") or die("Unable to access mailing list. Please try again later.");
			$mailingarray = array();

			$isduplicate = False;
			while (!feof($mailinglist)) {
				$line = fgets($mailinglist);
				$linestripped = str_replace("\r\n","",$line);

				if ($_POST['remove'] == $linestripped) {					
					$isduplicate = True;
				}
				else {
					array_push($mailingarray, $line);
				}
			}

			$emailremoved = False;
			if(isset($_POST['remove']) && $isduplicate == True) {

				// REMOVE NEWLINE ROW FROM ARRAY
				$mailingarray = array_slice($mailingarray, 0, count($mailingarray) - 1);

				// CLEAR EXISTING FILE CONTENTS
				file_put_contents($filename, "");
				
				// WRITE CONTENTS OF ARRAY TO FILE
				foreach($mailingarray as $key=>$value) {
					$ret = file_put_contents($filename, $value, FILE_APPEND);
					if($ret == false) {
						die('Error adding email to mailing list.');
					}
				}
				$emailremoved = True;
			}
		?>

		<?php if ($isduplicate == True): ?>
			<h1>Success</h1>
		<?php endif; ?>

		<?php if ($isduplicate == False): ?>
			<h1>Failure</h1>
		<?php endif; ?>

		<?php if ($emailremoved == True): ?>
			Your email address has been removed from our mailing list.</br><br>
			You will no longer receive content at: <b><?php echo $_POST["remove"]; ?></b></br>
		<?php endif; ?>

		<?php if ($emailremoved == False): ?>
			We were unable to find the provided email address in our mailing list.<br><br>
			The following email address is not currently receiving content: <b><?php echo $_POST["remove"]; ?></b></br>
		<?php endif; ?>

		<br>
		<b><a href="../index.html">Click here to return to our homepage!</a></b><br><br>

		<div class = "footer">
			CIS 501 Project One - 2021 (Jon Griesen)
		</div>

	</div>
</body>
</html>