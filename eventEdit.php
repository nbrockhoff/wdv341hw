<?php

//get id from url



session_cache_limiter( 'none' ); //This prevents a Chrome error when using the back button to return to this page.
session_start();
if ( ( $_SESSION[ 'validUser' ] ) == "yes" ) //is this already a valid user?
{

	$sessionMessage = $_SESSION[ 'sessionMessage' ];
	$_SESSION[ 'sessionMessage' ] = null;
	//User is already signed on.  Skip the rest.
	
} else {
	$sessionMessage = "Please login to access that information.";
	header( 'location:http://nbrockhoff.com/wdv341/eventLogin.php' );
}

include 'dbconnect.php';



$getEventID = $_GET[ 'event_id' ];



//run query
try {

	$_SESSION[ 'sessionMessage' ]=null;
	//load event, fill variables


	if ( isset( $_POST[ 'submit' ] ) ) {
		//echo "and the second test";

		$event_id = $_GET[ 'event_id' ];
		//echo $event_id;
		$eventName = $_POST[ 'eventName' ];
		//echo $eventName;
		$eventDesc = $_POST[ 'eventDesc' ];
		//echo $eventDesc;
		$eventPresenter = $_POST[ 'eventPresenter' ];
		//echo $eventPresenter;
		$eventDate = $_POST[ 'eventDate' ];
		//echo $eventDate;
		$eventTime = $_POST[ 'eventTime' ];
		//echo $eventTime;

		//echo "and the third test";

		$q = 'UPDATE wdv341_event 
                    SET event_name=:eventName,
                        event_description=:eventDesc,
                        event_presenter=:eventPresenter,
                        event_date=:eventDate,
                        event_time=:eventTime 
                    WHERE event_id=:event_id';

		$stmt = $DB->prepare( $q );
		$stmt->bindParam( ':eventName', $eventName );
		$stmt->bindParam( ':eventDesc', $eventDesc );
		$stmt->bindParam( ':eventPresenter', $eventPresenter );
		$stmt->bindParam( ':eventDate', $eventDate );
		$stmt->bindParam( ':eventTime', $eventTime );
		$stmt->bindParam( ':event_id', $event_id );

		//echo "and the third";

		$stmt->execute();

		$result = $stmt;

		if ( $stmt->num_rows != 0 ) {

			foreach ( $result as $field ) {
				//
				//		//echo " I WENT TOO FAR.";
				//		
				$getEventID = $field[ 'event_id' ];
				$eventName = $field[ 'event_name' ];
				$eventDesc = $field[ 'event_description' ];
				$eventPresent = $field[ 'event_presenter' ];
				$eventDate = $field[ 'event_date' ];
				$eventTime = $field[ 'event_time' ];
			}
		}

	} else {

		$q = 'SELECT event_id,
                    event_name, 
                    event_description, 
                    event_presenter, 
                    event_date, 
                    event_time
                FROM wdv341_event 
                WHERE event_id = :event_id';

		$stmt = $DB->prepare( $q );

		$stmt->bindParam( ':event_id', $getEventID );
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach ( $result as $field ) {
			$getEventID = $field[ 'event_id' ];
			$eventName = $field[ 'event_name' ];
			$eventDesc = $field[ 'event_description' ];
			$eventPresenter = $field[ 'event_presenter' ];
			$eventDate = $field[ 'event_date' ];
			$eventTime = $field[ 'event_time' ];
		};
		
		if (count($stmt)>=0){
		$_SESSION[ 'sessionMessage' ]="Event Updated Successfully";
		//header('Location: http://nbrockhoff.com/wdv341/eventDisplay.php?event_id='.$getEventID);
		}
	}
} catch ( PDOException $e ) {
	$updateResult = "<h3>Something went wrong - please try to submit your changes again.</h3>";
	$updateResult .= "Error: " . $e->getMessage();
};


//update form





?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>N.Brockhoff | Edit Event</title>
	<link rel="stylesheet" href="css/app.css">
	<style>
		.hide-form {
			visibility: hidden;
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

			<h1>Edit Event</h1>

		</div>
	</div>
	<h4 class="text-center">
						<?php echo $sessionMessage; ?>
					</h4>
	<h5>
		<?php echo $updateResult; ?>
		
	</h5>

	<div class="row small-12 end column">
		<form name="updateEvent" method="post" action="eventEdit.php?event_id=<?echo $getEventID; ?>">
			<div class="row">
				<div class="row">
					<div class="small-12 large-offset-2 large-2 columns">
						<p>Event Name:</p>
					</div>
					<div class="small-12 large-8 columns">
						<input type="text" name="eventName" id="eventName" value="<?php echo $eventName; ?>">
					</div>
				</div>

				<div class="row">
					<div class="small-12 large-offset-2 large-2 columns">
						<p>Event Description:</p>
					</div>
					<div class="small-12 large-8 columns">
						<textarea name="eventDesc" id="eventDesc" value="" rows="3"><?php echo $eventDesc; ?>
						</textarea>
					</div>
				</div>


				<div class="row">
					<div class="small-12 large-offset-2 large-2 columns">
						<p>Event Educator: </p>
					</div>
					<div class="small-12 large-8 columns">
						<input type="text" name="eventPresenter" id="eventPresenter" value="<?php echo $eventPresenter; ?>">
					</div>
				</div>

				<div class="row">
					<div class="small-12 large-offset-4 large-3 columns">
						<p>Event Time: </p>
						<input type="text" name="eventTime" id="eventTime" value="<?php echo $eventTime; ?>">
					</div>

					<div class="small-12 large-offset-1 large-3 columns end">
						<p>Event Date: </p>
						<input type="text" name="eventDate" id="eventDate" value="<?php echo $eventDate; ?>">
					</div>

					<div class="row">
						<div class="large-offset-4 small-12 medium-6 large-2 columns">
							<input type="submit" name="submit" id="submit" value="Submit">
						</div>
						<div class="small-12 medium-6 large-2 columns end">
							<input type="reset" name="reset" id="reset" value="Reset">
						</div>
					</div>
					<div class="row">
						<div class="large-offset-4 small-12 large-8 columns">
							<h4><a href="eventSelect.php">Return to Event List</a></h4>
						</div>
					</div>
				</div>
			</div>
		</form>



	</div>
</body>

</html>