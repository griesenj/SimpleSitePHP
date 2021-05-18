<html>
<head>
	<title>League Roster</title>
</head>

<link rel="stylesheet" href="styles/styles.css">

<div class = "navbar">
	<a href="index.html">Disc Golf Information</a>
	<a href="howtoplay.html">How to Play</a>
	<a href="courses.html">Local Courses</a>
	<a href="gear.html">Buy Gear</a></h2></a>
	<a href="mailing.html">Mailing List</a>
	<a class = "right" href="registration.html">Registration</a>
	<a class = "active right" href="roster.php">League Roster</a>
</div>

<body>
	<div class = "pagecontainer">
		<h1>League Roster</h1>

		<?php
			$roster = fopen("scripts/db/roster.txt", "r") or die("Unable to access roster. Please try again later.");
			$playerdata = array();

			while (!feof($roster)) {
				$line = fgets($roster);
				$array = explode(",",$line);
				array_push($playerdata, $array);
			}

			// Removes final newline row from array data
			$playerdata = array_slice($playerdata, 0, count($playerdata) - 1);
		?>

		<! Create HTML table from league roster data !>
		<?php
			function create_table($playerdata) {
			$html = '<table>';
			$html .= '<tr>';
			
			// Set up headers
			$html .= '<th>' . "First Name" . '</th>';
			$html .= '<th>' . "Last Name" . '</th>';
			$html .= '<th>' . "Email" . '</th>';
			$html .= '<th>' . "Phone" . '</th>';

			// Enter data into rows
			foreach($playerdata as $key=>$value) {
				$html .= '<tr>';
				foreach($value as $key2=>$value2) {
					$html .= '<td>' . htmlspecialchars($value2) . '</td>';
				}
				$html .= '</tr>';
			}	

			$html .= '</table>';

			return $html;
			}

		echo create_table($playerdata);
		?>

		<br> 
		<div class = "footer">
			CIS 501 Project One - 2021 (Jon Griesen)
		</div>

	</div>
</body>
</html>
