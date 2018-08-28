

<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Contact Form with Email</title>
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

        <h1>Contact Form with Email</h1>
        
    </div>
</div>

<div class="row">
	<div class="small-10 small-offset-1 columns">
<?php

//It will create a table and display one set of name value pairs per row
	//echo "<table border='1'>";
	//echo "<tr><th>Field Name</th><th>Value of field</th></tr>";
	//foreach($_POST as $key => $value)
	//{
		//echo '<tr class=colorRow>';
		//echo '<td>',$key,'</td>';
		//echo '<td>',$value,'</td>';
		//echo "</tr>";
	//} 
	//echo "</table>";
	//echo "<p>&nbsp;</p>";

//This code pulls the field name and value attributes from the Post file
//The Post file was created by the form page when it gathered all the name value pairs from the form.
//It is building a string of data that will become the body of the email

//          CHANGE THE FOLLOWING INFORMATION TO SEND EMAIL FOR YOU //  

	$toEmail = 'nkbrockhoff@gmail.com'.', '.$_POST['CustomerEmail'];	//CHANGE within the quotes. Place email address where you wish to send the form data. 
										//Use your DMACC email address for testing. 
										//Example: $toEmail = "jhgullion@dmacc.edu";		
	
	$subject = "Contact Form";	//CHANGE within the quotes. Place your own message.  For the assignment use "WDV101 Email Example" 

	$fromEmail = $_POST['CustomerEmail'];		//CHANGE within the quotes.  Use your DMACC email address for testing OR
										//use your domain email address if you have Heartland-Webhosting as your provider.
										//Example:  $fromEmail = "contact@jhgullion.org";  

//   DO NOT CHANGE THE FOLLOWING LINES  //

	$emailBody = "Form Data\n\n ";			//stores the content of the email
	foreach($_POST as $key => $value)		//Reads through all the name-value pairs. 	$key: field name   $value: value from the form									
	{
		$emailBody.= $key."=".$value."\n";	//Adds the name value pairs to the body of the email, each one on their own line
	} 
	
	$headers = "From: $fromEmail" . "\r\n";				//Creates the From header with the appropriate address

 	if (mail($toEmail,$subject,$emailBody,$headers)) 	//puts pieces together and sends the email to your hosting account's smtp (email) server
	{	
   		echo("<h3>Message successfully sent!</h3>
   			<p>Thank you for your feedback.</p>");
  	} 
	else 
	{
   		echo("<h3>Message delivery failed...</h3>");
  	}

?>
</div>
</div>

</body>
</html>
