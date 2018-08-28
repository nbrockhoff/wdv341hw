<?php
    
        $date = new DateTime($_POST["date"]);
        $string = $_POST["string"];
        $number = $_POST["number"];
        $money = $_POST["money"];


        function formatDate($date, $format){

        echo $date->format($format);
        };

        function stringCharCount($string)
            {
                return  strlen($string);  //Provides the number of characters in the input string
            };

        function formatString($string){
            $string = trim($string);
            $string = strtolower($string);
            echo $string;
        };

        function wordSearch($string, $keyword){
            $keyword = strtolower($keyword);
            $string = strtolower($string);

            if(stristr($string, $keyword) === FALSE) {
                echo 'does not mention';
            } else {
                echo 'does mention';
            }
        };

        function formatNumber($number){
            echo number_format($number);
        };

        function formatMoney($money){
            $money = floatval($money);
            echo money_format("%i", $money);
        }
?>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | PHP Functions</title>
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

        <h1>PHP Functions</h1>
        
    </div>
</div>

<div class="row">
    <div class="small-10 small-offset-1 columns">

        <p>You were born on <strong> <?php formatDate($date, 'm/d/Y'); ?> </strong>(or <em><?php formatDate($date, 'd/m/Y'); ?> </em>if you're from across the pond). It was a <?php formatDate($date, 'l'); ?>.

        <p>Your message was:
        <br><center>"<?php formatString($string); ?>"</center>.
        <br>It contains <strong><?php echo stringCharCount($string); ?></strong> characters, and <em><?php wordSearch($string, DMACC); ?></em> DMACC - fascinating.
        </p>

        <p>There are <strong><?php formatNumber($number); ?></strong> bottles of beer on the wall.</p>

        <p>I bought <strong>&#36;<?php formatMoney($money); ?></strong> worth of useless things on Amazon.com late last night. </p>
    </div>
</div>  
</body>
</html>
