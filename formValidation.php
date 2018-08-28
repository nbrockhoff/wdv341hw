
<?php
         //Validate the form data  (at least sanitize the input fields to prevent SQL injection)

         //If valid data

  //               If query is successful 

  //                   Create confirmation to the user that their data has been successful processed

  //                   Provide links to home page or ?

  //              else

  //                   Create error message to user "Sorry there was a problem adding the record"

  //                   Provide links to home page or to the Add Form page (try again)

  //         else (data is invalid)

  //              Create error messages for invalid fields

  //              Display form with error messages to the user

  // ELSE ( the form has NOT been seen by the user)

  //      Display the form for data entry
?>

<?php

if(isset($_POST['submit'])){

$custName = $_POST['inName'];
$socSecurity = $_POST['inEmail'];
$prefContact = $_POST['prefContact'];
$valid;

// echo $prefContact;
// echo $_POST['prefContact'];

  if (strlen(trim($custName))==0){
      $errorNameMsg="Please enter your name.";
      $valid=false;    
  };

  if (!preg_match("/([0-9]{9})\d/",$socSecurity)){
    $valid = false;
    $errorNumberMsg;
      if (!preg_match("/(\w9)/", $socSecurity)){
        $errorNumberMsg = "Please enter 9 numbers. ";
      };
      if (preg_match("/(-\b)|(\()|(\))/", $socSecurity)){
        $errorNumberMsg .= "Please only use numeric characters.";
      }; 
  };
  if (!isset($prefContact)) {
    $valid=false;
    $errorContactMsg ="Please select a preferred method of contact";
  };

  if((null !== $valid) || ($valid==true)){
    $errorMsg = "<h3>Success! Your form has been submitted.</h3>";
  } else {
    $errorMsg = "I'm sorry - the form did not submit. Please fill out all fields.";
  };
};
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Form Validation</title>
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

        <h1>Form Validation</h1>
        
    </div>
</div>
 <div class="row">
 <div class="small-10 small-offset-1 columns"> 
  <form id="form1" name="form1" method="post" action="formValidation.php">
  <h3>Customer Registration Form</h3>
  <h5 class="error"><?php echo $errorMsg ?></h5>
  <table width="587" border="0">
    <tr>
      <td width="117">Name:</td>
      <td width="246"><input type="text" name="inName" id="inName" size="40" value="<?php echo $custName ?>"/></td>
      <td width="210" class="error"><?php echo $errorNameMsg; ?></td>
    </tr>
    <tr>
      <td>Social Security</td>
      <td><input type="text" name="inEmail" id="inEmail" size="40" value="<?php echo $socSecurity ?>" /></td>
      <td class="error"><?php echo $errorNumberMsg; ?></td>
    </tr>
    <tr>
      <td>Preferred method of contact:</td>
      <td><p>
        <label>
          <input type="radio" name="prefContact" id="phone" value="phone">
          Phone</label>
        <br>
        <label>
          <input type="radio" name="prefContact" id="email" value="email">
          Email</label>
        <br>
        <label>
          <input type="radio" name="prefContact" id="postal" value="postal">
          US Mail</label>
        <br>
      </p></td>
      <td class="error"><?php echo $errorContactMsg; ?></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="submit" id="register" value="Register" />
    <input type="reset" name="button2" id="button2" value="Clear Form" />
  </p>
</form>
</div>
</body>
</html>