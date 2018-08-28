<?php
require_once 'email.php';

        

  if (isset($_POST["submit"])){
    //variables
      $successMsg;
      $submittedData;
      $errorMsg;
      $customerName=($_POST['customerName']);
      $customerNameErrorMsg;
      $customerEmail=($_POST['customerEmail']);
      $customerEmailErrorMsg;
      $contactReason=($_POST['contactReason']);
      $contactReasonErrorMsg;
      $customerComments=($_POST['customerComments']);
      $customerCommentsErrorMsg;
      $mailingList=($_POST['mailingList']);
      $moreInfo=($_POST['moreInfo']);
      $valid;
      $formDisplay;
      $emailBody=$customerComments;


        if (empty(trim($customerName))==true){

            

        $valid = false;
        $customerNameErrorMsg="Please enter your name.";

        } elseif ($customerName != strip_tags($customerName)){
        
          $valid=false;
          $customerNameErrorMsg="Please use alphanumeric characters only to enter your name.";
          } else {
          $valid=true;
        };

          if (empty($customerEmail) == true){
          $valid = false;
          $customerEmailErrorMsg="Please enter your email.";
          } elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$customerEmail)){
          $valid = false;
          $customerEmailErrorMsg="Please enter a valid email.";

        } else {
          $valid=true;
      };


      if (!isset($contactReason)) {
        $valid=false;
        $contactReasonErrorMsg ="Please select a preferred method of contact";
      };

      if (($contactReason == "other") && (empty($customerComments))) {
        $valid=false;
        $customerCommentsErrorMsg ="Please add a message.";
      };

      if (preg_match("/(-\b)|(<)|(>)/", $customerComments)){
        $valid=false;
        $customerCommentsErrorMsg .= "Please use unformatted, alphanumeric characters.";
      }; 

      if($valid==true){
          $formDisplay = "hide-form";
          $successMsg = "Success! Your form has been submitted.";
          $submitTimestamp = date("M j, Y H:i:s");
          $formSubmitTime = date("H:i:s");
          $formSubmitDate = date("m/d/Y");
          $appID = ($_POST['appID']);

        if(isset($mailingList)){
          $mailingList = "Please put me on your mailing list about your cat.";
        };

        if(isset($moreInfo)){
          $moreInfo = "Please send me daily updates about your cats.";
        };

        


            $emailBody .= "<p>Submitted: ".$submitTimestamp." GMT </p>";

            $emailBody .= "<p>".$mailingList;
            $emailBody .= "<br>".$moreInfo;
            $emailBody .= "</p>";


          $submittedData .=  "Name: ".$customerName;
        $submittedData .=  "<br>Your Email: ".$customerEmail;
        $submittedData .=  "<br>Subject : ".$contactReason;
        $submittedData .=  "<p>Email: ".$emailBody;

          $newEmail = new Email();
          $newEmail->set_sendTo("nderrb@gmail.com");
          $newEmail->set_sender($customerEmail);
          $newEmail->set_message($emailBody);
          $newEmail->set_subject($contactReason);
          $newEmail->set_body();
          $newEmail->sendEmail();
          
            include('dbconnect.php'); 
          
          try {
          $stmt = $DB->prepare('INSERT INTO wdv341_customer_contacts (contact_name, contact_email, contact_reason, contact_comments, contact_newsletter, contact_more_products, contact_app_id, contact_date, contact_time) VALUES (:contact_name, :contact_email, :contact_reason, :contact_comments, :contact_newsletter, :contact_more_products, :contact_app_id, :contact_date, :contact_time)');

          $stmt->bindParam(":contact_name", $customerName);
          $stmt->bindParam(":contact_email", $customerEmail);
          $stmt->bindParam(":contact_reason", $contactReason);
          $stmt->bindParam(":contact_comments", $customerComments);
          $stmt->bindParam(":contact_newsletter", $mailingList);
          $stmt->bindParam(":contact_more_products", $moreInfo); 
          $stmt->bindParam(":contact_app_id", $appID); 
          $stmt->bindParam(":contact_date", $formSubmitDate);
          $stmt->bindParam(":contact_time", $formSubmitTime);

          $stmt->execute();

          echo $stmt->rowCount();
            } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
           }
        } else {
          $errorMsg = "We're sorry - the form did not submit. Please fill out all fields.";
        };
      };
   ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Contact Form with PHP Validation</title>
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
            <li><a href="index.html">WDV341</a></li>
        </ul>
    </div>
</div>
 
<div class="callout large primary">
    <div class="row column text-center">

        <h1>Contact Form with PHP Validation</h1>
        
    </div>
</div>

 <div class="row">
  <div class="small-12 columns">
    <h1 class="text-center">Customer Contact Form</h1>


    <div id="success" class="success">
     <h5><?php echo $successMsg; ?></h5>
     <div class="submitted_data">
      <table>
        <?php echo $submittedData; ?>
      </table>
    </div>
  </div>

    <div id="error" class="error">
      <h5><?php echo $errorMsg; ?></h5>
    </div>
  </div>
</div>


<div class="row small-12 medium-offset-1 medium-10 end column <?php echo $formDisplay; ?>">
<form name="form1" method="post" action="contactForm.php">
  <div class="row">
    <div class="small-8 large-2 columns">
      <p>Your Name:</p>
    </div>
    <div class="small-8 large-6 columns">
        <input type="text" name="customerName" id="customerName" value="<?php echo $customerName; ?>">
    </div>
    <div class="error small-8 large-4 columns">
      <p><?php echo $customerNameErrorMsg; ?>&nbsp;</p>
    </div>
 </div>


  <div class="row">
    <div class="small-8 large-2 columns">
      <p>Your Email: </p>
    </div>
    <div class="small-8 large-6 columns">
      <input type="text" name="customerEmail" id="customerEmail" value="<?php echo $customerEmail; ?>">
    </div>
    <div class="error small-12 large-4 columns">
      <p><?php echo $customerEmailErrorMsg; ?>&nbsp;</p>
    </div>
  </div>

  <div class="row">
    <div class="small-8 large-2 columns">
        <p>Reason for contact: </p>
    </div>
    <div class="small-8 large-6 columns end">
        <select name="contactReason" id="contactReason">
          <option disabled selected>Please Select a Reason</option>
          <option value="product">Product Problem</option>
          <option value="return">Return a Product</option>
          <option value="billing">Billing Question</option>
          <option value="technical">Report a Website Problem</option>
          <option value="other">Other</option>
        </select>
    </div>
    <div class="error small-12 large-4 columns">
      <p><?php echo $contactReasonErrorMsg; ?>&nbsp;</p>
    </div>
    </div>

  <div class="row">
    <div class="small-12 large-2 columns">
      <lp>Comments:</p>
    </div>
    <div class="small-12 large-6 columns">
      <textarea name="customerComments" id="customerComments" cols="45" rows="5"><?php echo $customerComments; ?></textarea>
    </div>
    <div class="error small-12 large-4 columns">
      <p><?php echo $customerCommentsErrorMsg; ?>&nbsp;</p>
    </div>
  </div>

    <div class="row">
      <div class="large-offset-2 small-12 medium-6 columns end">
        <label>
         <input type="checkbox" name="mailingList" id="mailingList" checked>
          Please put me on your mailing list.
         </label>
      </div>
      <div class="large-offset-2 small-12 medium-6 columns end">
        <label>
          <input type="checkbox" name="moreInfo" id="moreInfo" checked>
          Send me more information about your products. 
        </label>
      </div>
    </div>
    <input type="hidden" name="appID" id="appID" value="application-id:US447">


  <div class="row">
    <p>
      <div class="large-offset-2 small-12 medium-6 large-5 columns">
        <input type="submit" name="submit" id="submit" value="Submit">
      </div>
      <div class="small-12 medium-6 large-5 columns end">
        <input type="reset" name="reset" id="reset" value="Reset">
      </div>
    </div>
  </div>
</form>

  
    
</div>
</div>
<p>&nbsp;</p>
</body>
</html>
