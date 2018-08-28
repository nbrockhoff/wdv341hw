<?php

session_cache_limiter( 'none' ); //This prevents a Chrome error when using the back button to return to this page.
session_start();
if ( ($_SESSION[ 'validUser' ]) == "yes" ) //is this already a valid user?
{
	$sessionMessage = $_SESSION[ 'sessionMessage' ];
	//User is already signed on.  Skip the rest.

} else {
	$_SESSION[ 'sessionMessage' ] = "Please login to access that information.";
	header( 'location:http://nbrockhoff.com/wdv341/eventLogin.php' );
}


$getEventID = $_GET[ 'event_id' ];

include 'dbconnect.php' ;
//if ($DB->connect_error) {
// echo "Connection failed: " . $DB->connect_error;
// } else { echo "success";}
try {

	$q = 'SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_event WHERE event_id = :event_id';
	$stmt = $DB->prepare( $q );
	$stmt->bindParam( 'event_id', $getEventID );
	$stmt->execute();
	$result = $stmt->fetchAll();


	foreach ( $result as $row ) {
		$displayResult .= "<tr>";
		$displayResult .= "<td>" . $row[ 'event_name' ] . "</td>";
		$displayResult .= "<td>" . $row[ 'event_description' ] . " </td>";
		$displayResult .= "<td>" . $row[ 'event_presenter' ] . "</td>";
		$displayResult .= "<td>" . $row[ 'event_date' ] . "</td>";
		$displayResult .= "<td>" . $row[ 'event_time' ] . "</td>";
		$displayResult .= "<td><a href='eventEdit.php?event_id=" . $row[ 'event_id' ] . "'>Edit Event</a></td>";
		$displayResult .= "<td><a href='eventDelete.php?event_id=" . $row[ 'event_id' ] . "'>Delete Event</a></td>";
		$displayResult .= '</tr>';
	}




} catch ( PDOException $e ) {
	echo 'Error: ' . $e->getMessage();
}


?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>N.Brockhoff | Select Events</title>
	<link rel="stylesheet" href="css/app.css">
</head>

<body>

	<div class="top-bar">
		<div class="top-bar-left">
			<ul class="menu">
				<li class="menu-text">N.Brockhoff | Fall 2016</li>
				<li><a href="index.html">WDV341</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="callout large primary">
		<div class="row column text-center">

			<h1>Select Events</h1>

		</div>
	</div>

	<div class="row">
		<div class="small-12 columns">
			<h1 class="text-center">View Events</h1>


			<div id="success" class="success">
				<h5>
					<?php echo $successMsg; ?>
				</h5>
				<div class="submitted_data">
					<table>
						<?php echo $submittedData; ?>
					</table>
				</div>
			</div>

			<div id="error" class="error">
				<h5>
					<?php echo $errorMsg; ?>
				</h5>
			</div>
		</div>
	</div>




	<div class="row">
		<table border='2'>
			<tr>
				<th>Event</th>
				<th>Description</th>
				<th>Educator</th>
				<th>Date</th>
				<th>Time</th>

				<th>Edit</th>
				<th>Delete</th>
			</tr>

	<?php echo $displayResult;
          ?>
          
          
		</table>
	</div>
	<div class="row">
	
		<h4 class="center-text"><a href="eventCreate.php">Create a new event</a></h4>
		<h4 class="center-text"><a href="eventSelect.php">Return to your event records</a></h4>
	</div>



</body>

</html>