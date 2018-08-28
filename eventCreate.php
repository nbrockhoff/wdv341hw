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

if(isset($_POST["submit"]))
  { 

 include 'connection.php';
    //The form has been submitted and needs to be processed
    
    //include 'connection.php';  //connects to the database  
    //echo $result_message;
    //Validate the form data here!
  
    //Get the name value pairs from the $_POST variable into PHP variables
    //This example uses PHP variables with the same name as the name atribute from the HTML form
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_presenter = $_POST['event_presenter'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
  
    //Create the SQL command string
    $sql = "INSERT INTO wdv341_event (";
    $sql .= "event_name, ";
    $sql .= "event_description, ";
    $sql .= "event_presenter, ";
    $sql .= "event_date, ";
   $sql .= "event_time "; //Last column does NOT have a comma after it.
    $sql .= ") VALUES (?, ?, ?, ?, ?);"; //? Are placeholders for variables 
  
    //Display the SQL command to see if it correctly formatted.
   echo "<p>$sql</p>";   
  
     $result = $connection->prepare($sql);  //Prepares the query statement 


    //Binds the parameters to the query.  
    //The ssssis are the data types of the variables in order.    
    $result->bind_param("sssss",$event_name,$event_description,$event_presenter,$event_date,$event_time);
   echo "<p>$sql</p>"; 
    //Run the SQL prepared statements
    if ( $result->execute() )
    {
      $_SESSION[ 'sessionMessage' ] = "Your event has been successfully added to the database.";
	  header('location:http://nbrockhoff.com/wdv341/eventSelect.php');
    }
    else
    {
      $result_message = "<h1>You have encountered a problem.</h1>";
      $result_message .= "<h2 style='color:red'>" . mysqli_error($link) . "</h2>"; //remove this for production purposes
    }
  
    $result->close();
    $connection->close(); //closes the connection to the database once this page is complete.
    
  }// ends if submit 
  else
  {
  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Events Form</title>
<link rel="stylesheet" href="css/app.css">
    
</head>
<body>
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text">N.Brockhoff | Fall 2016</li>
            <li><a href="index.html">WDV341</a></li>
        </ul>
    </div>
</div>
 
<div class="callout large primary">
    <div class="row column text-center">

        <h1>Create A New Event</h1>
        
    </div>
</div>
 <div class="row">
 <div class="small-10 small-offset-1 columns">
 
 <form id="eventsForm" name="eventsForm" method="post" action="eventCreate.php">
  <h3>Add a new Event</h3>
  <p>Event Name: 
    <input type="text" name="event_name" id="event_name" />
  	<p>Event Description: 
    <input type="text" name="event_description" id="event_description" />
    <p>Event Presenter: 
    <input type="text" name="event_presenter" id="event_presenter" />
    <p>Event Date: 
    <input type="date" name="event_date" id="event_date" />
    <p>Event Time: 
    <input type="time" name="event_time" id="event_time" />

  <p>
    <input type="submit" name="submit" id="submit" value="Add Event" />
    <input type="reset" name="button2" id="button2" value="Clear Form" />
  </p>
</form>
<?php }
if(isset($_POST['submit']))
{
  $result_message = "Your event has been submitted and will be entered into the database.";
} else {

  $result_message = "Please enter your event information via the form.";
 
}
?>

  <h4>Return to your <a href="eventLogin.php"> Administrative Area</a></h4>
  </div></div></body></html> 
 