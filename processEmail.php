<?php require_once 'email.php'; 

  if(isset($_POST['Submit']))
  {
    $newEmail = new Email();

    $newEmail->setSendToAddress('nkbrockhoff@dmacc.edu');

    $newEmail->setMessageLine($_POST['contact_comments']);

    $newEmail->setBody();
    $newEmail->setSenderAddress($_POST['contact_email']);
    $newEmail->setSubjectLine($_POST['contact_reason']);
    $newEmail->setBody();

    $newEmail->sendPHPEmail();
  } 
?>
    <!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Email Class </title>
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

        <h1>Email Class</h1>
        
    </div>
</div>
 <div class="row">
 <div class="small-10 small-offset-1 columns">

 <?php
 if(!isset($_POST['Submit']))
 {

  ?>

<form name="form1" method="post" action="processEmail.php">
  <p>&nbsp;</p>
  <p>
    <label>Your Name:
      <input type="text" name="contact_name" id="contact_name" value="<?php echo $name; ?>">
    </label>
  </p>
  <p>Your Email: 
    <input type="text" name="contact_email" id="contact_email">
  </p>
  <p>Reason for contact: 
    <label>
      <select name="contact_reason" id="contact_reason">
        <option value="default">Please Select a Reason</option>
        <option value="product">Product Problem</option>
        <option value="return">Return a Product</option>
        <option value="billing">Billing Question</option>
        <option value="technical">Report a Website Problem</option>
        <option value="other">Other</option>
      </select>
    </label>
  </p>
  <p>
    <label>Comments:
      <textarea name="contact_comments" id="contact_comments" cols="45" rows="5"></textarea>
    </label>
  </p>
  <p>
    <label>
      <input type="checkbox" name="contact_newsletter" id="contact_newsletter" checked>
      Please put me on your mailing list.</label>
  </p>
  <p>
    <label>
      <input type="checkbox" name="contact_more_products" id="contact_more_products" checked>
      Send me more information about your products. </label> </p>
  <p>
    <input type="hidden" name="contact_app_id" id="contact_app_id" value="application-id:US447">
  </p>
  <p>
    <input type="submit" name="Submit" id="button" value="Submit">
    <input type="reset" name="Reset" id="button2" value="Reset">
  </p>
<?php 
  } else
  {
    ?> <h2>Success - Your form has been emailed!
    <br><small>Thank you for your feedback.</small></h2>
    <?php
    echo "<br>Customer Email: ".$newEmail->getSenderAddress();
    echo "<br>Subject: ".$newEmail->getSubjectLine();
    echo "<br>Email: ".$newEmail->getMessageLine();
      }
  
  ?>
  
</form>
</div>

</div>
</body>
<p>&nbsp;</p>
</body>
</html>
