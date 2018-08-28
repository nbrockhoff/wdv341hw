<?php
session_cache_limiter( 'none' ); //This prevents a Chrome error when using the back button to return to this page.
session_start();
try {

	if ( ( $_SESSION[ 'validUser' ] ) == "yes" ) //is this already a valid user?
	{
		$eventUser = ( $_SESSION[ 'eventUser' ] );
		//User is already signed on.  Skip the rest.

		$sessionMessage = ( $_SESSION[ 'sessionMessage' ] );
		$sessionMessage = "Hi there, " . $eventUser . "!";
		header( 'location:http://nbrockhoff.com/wdv341/eventSelect.php' );
		//Create greeting for VIEW area	

	} else {
		if ( isset( $_POST[ 'submitLogin' ] ) ) //Was this page called from a submitted form?
		{
			$loginUsername = ( $_POST[ 'loginUsername' ] ); //pull the username from the form
			echo $loginUsername;
			
			$loginPassword = ( $_POST[ 'loginPassword' ] ); //pull the password from the form
			echo $loginPassword;
			
			include 'dbconnect.php'; //Connect to the database

			$sql = "SELECT event_user_name, 
                            event_user_password
                    FROM event_user 
                    WHERE event_user_name = :loginUsername 
                    AND event_user_password = :loginPassword";

			$query = $DB->prepare( $sql )or die( "<p>SQL String: " . $sql . "</p>" ); //prepare the query

			// echo "lU=".$loginUsername."; lP=".$loginPassword;


			$query->bindParam( ":loginUsername", $loginUsername );
			$query->bindParam( ":loginPassword", $loginPassword ); //bind parameters to prepared statement
			//echo $query;
			$query->execute();
			$result = $query->fetchAll();

			foreach ( $result as $field ) {
				//echo test;
				$eventUsername = ( $field[ 'event_user_name' ] );
				$eventPassword = ( $field[ 'event_user_password' ] );
				//echo $loginUsername . "<br>";
				//echo $eventUsername . "<br>";
				//echo $validUser;

			}
			//echo  count($query);
			if ( count($query) === 1 ) //If this is a valid user there should be ONE row only
			{
				
				$_SESSION['validUser'] = "yes"; //this is a valid user so set your SESSION variable
				$eventUser = $field[ 'event_user_name' ];
				$_SESSION['sessionMessage'] = "Welcome Back,  " . $eventUser . "!";
				//Valid User can do the following things:
				header( 'location:http://nbrockhoff.com/wdv341/eventSelect.php' );
			} else {
				
				//error in processing login.  Logon Not Found...
				$_SESSION['validUser'] = "no";
				$errorUsername = ( $_POST[ 'loginUsername' ] );
				$sessionMessage = "Sorry, there was a problem with your username or password. Please try again.";
			}
		}


			//end if submitted
			else {
				$sessionMessage = "Please log in.";
			} //end else submitted

			//end else valid user
	}
		} catch ( PDOException $e ) {

			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	

		?>
		<!doctype html>
		<html>

		<head>
			<meta charset="utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			<title>N.Brockhoff | Event Login</title>
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

					<h1>Event Login</h1>

				</div>
			</div>

			<div class="row">
				<div class="small-12 columns">
					<h4 class="text-center">
						<?php echo $sessionMessage; ?>
					</h4>
				</div>

				<form name="userLogin" method="post" action="eventLogin.php">
					<div class="row">
						<div class="small-12 medium-1 columns">
							<p>Username:</p>
						</div>
						<div class="small-12 medium-5 columns">
							<input type="text" name="loginUsername" id="loginUsername" value="<?php echo $errorUsername; ?>">
						</div>
						<div class="small-12 medium-1  columns">
							<p>Password:</p>
						</div>
						<div class="small-12 medium-5 columns">
							<input type="text" name="loginPassword" id="loginPassword" value="">
						</div>
						<div class="row">
							<div class="medium-offset-2 small-12 medium-6 end columns">
								<input type="submit" name="submitLogin" id="submitLogin" value="Login">
								<input type="reset" name="reset" id="reset" value="Reset">
							</div>
						</div>
					</div>
				</form>


			</div>
		</body>

		</html>