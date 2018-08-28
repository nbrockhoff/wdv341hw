
	<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Create Database Connection</title>
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

        <h1>Create Database Connection</h1>
        
    </div>
</div>
 <div class="row">
 <div class="small-10 small-offset-1 columns">
 <?php
	include_once('connection.php');

	echo $connection_status;
?>
</div>
</div>
</body>
</html>