<?php
session_cache_limiter( 'none' ); //This prevents a Chrome error when using the back button to return to this page.
session_start();
 if ( $_SESSION[ 'validUser' ] == "yes" ) //is this already a valid user?
{
	$sessionMessage = $_SESSION[ 'sessionMessage' ];
	//User is already signed on.  Skip the rest.

} else {
	$_SESSION[ 'sessionMessage' ] = "Please login to access that information.";
	header( 'location:http://nbrockhoff.com/wdv341/eventLogin.php' );
} 

include 'dbconnect.php';

try {
	
	$_SESSION[ 'sessionMessage' ]=null;
	
	$stmt = $DB->prepare( 'SELECT * FROM wdv341_event ORDER BY event_date DESC' );


	$stmt->execute();

	$result = $stmt->fetchAll();

    $today = getdate();


	foreach ( $result as $row ) {

        $eDate = date_create_from_format('Y-m-d', $row['event_date']);
        

		$displayResult .= "<tr>";
        $displayResult .= "<td><a href='eventDisplay.php?event_id=" . $row[ 'event_id' ] . "'>";
        
        
        if ($today[year]< $eDate->format('Y') || $today[year] == $eDate->format('Y') && $today[mon]< $eDate->format('m') ){
            $displayResult .= "<em>" . $row[ 'event_name' ] . "</em>";
            } elseif ($today[year] == $eDate->format('Y') && $today[mon] == $eDate->format('m')){
                $displayResult .= "<strong>" . $row[ 'event_name' ] . "</strong>";}
                else {
                    $displayResult .= $row[ 'event_name' ] ;
                }
            $displayResult .= "</a></td>";
        $displayResult .= "<td>" . $row[ 'event_description' ] . " </td>";
        $displayResult .= "<td>" . $row[ 'event_presenter' ] . "</td>";
        
		//$displayResult .= "<td>" . $row[ 'event_time' ] . "</td>";

        $displayResult .= "<td>" . $row[ 'event_date' ] . "</td>";
		$displayResult .= "<td><a href='eventEdit.php?event_id=" . $row[ 'event_id' ] . "'>Edit Event</a></td>";
		$displayResult .= "<td><a href='eventDelete.php?event_id=" . $row[ 'event_id' ] . "'>Delete Event</a></td>";
		$displayResult .= "</tr>";
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
    <style>
        strong {
            color: darkred;
            font-weight: bold;
        }
        </style>
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


			<h5 class="text-center">
				<?php echo $sessionMessage; ?>
			</h5>

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




	<table border='2'>
		<tr>
			<th>Event</th>
			<th>Description</th>
			<th>Educator</th>
			<th>Date</th>
			<!-- <th>Time</th> -->
			<th>Edit</th>
			<th>Delete</th>
		</tr>

		<?php echo $displayResult; ?>
	</table>
	
		
		<h4 class="center-text"><a href="eventCreate.php">Create a new event</a></h4>
		<h4 class="center-text"><a href="eventSelect.php">Return to your event records</a></h4>
	<h6 class="center-text"><a href="eventLogout.php">Log Out</a></h6>
	</div>
</body>

</html>