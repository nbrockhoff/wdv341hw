<?php
        
        $getEventID=($_GET['event_id']);
          
            
            include ('dbconnect.php');
          try {
            //$deleteEventID = 'DELETE * FROM wdv341_event WHERE event_id = :getEventID';
          //$deleteEventID = "DELETE FROM wdv341_event WHERE event_id = :eventID";

           $q = "DELETE FROM wdv341_event WHERE event_id = :eventID";

          $stmt = $DB->prepare($q);
          // $param = [
          //   ":eventID"=>$getEventID
          //   ];
          $stmt-> bindParam(':eventID',$getEventID);

          //echo $stmt;

          $stmt->execute();


            if ( $stmt->execute() == 1){
              $statusMsg = "<h3>Event was successfully removed.</h3>";
              $statusMsg .= "<a href='eventSelect.php'>Return to your event records</a>";

            } else {
              $statusMsg = "<h3>error message</h3>";
              $statusMsg .= ($DB->errorInfo());
            }
              
          } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
           };
        
      
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
            <li><a href="index.html">WDV341</a></li>
        </ul>
    </div>
</div>
 
<div class="callout large primary">
    <div class="row column text-center">

        <h1>Delete Events</h1>
        
    </div>
</div>

 <div class="row">
  <div class="small-12 columns">


        <?php echo $statusMsg; ?>
     
    </div>
  </div>

    
</div>
        

<p>&nbsp;</p>
</body>
</html>
