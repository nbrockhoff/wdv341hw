<?php ?>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | PHP Basics</title>
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

        <h1>PHP Basics</h1>
        
    </div>
</div>
 

<div class="row medium-8 large-7 columns">
    <div class="blog-post">
        <p><strong>Create a variable called yourName.  Assign it a value of your name.</strong>
            <?php
                $yourName = "Noelle Brockhoff";
            ?>
        
        </p>

        <p><strong>Display the assignment name in an h1 element on the page. Include the elements in your output. </strong>
        <br>
            <?php
                echo "<h1>PHP Basics</h1>";
            ?>
        </p>

        <p><strong>Use HTML to put an h2 element on the page. Use PHP to display your name inside the element using the variable.</strong><br>
            <h2><?php echo $yourName; ?></h2>
        
        </p>

        <p><strong>Create the following variables:  number1, number2 and total.  Assign a value to them.
        </strong><br>
            <?php 
                $number1 = 7;
                $number2 = 42;
                $total = $number1+$number2;
             ?>
        
        </p>

        <p><strong>Display the value of each variable and the total variable when you add them together. </strong><br>
            <?php 
                echo $number1." + ".$number2." = ".$total 
            ?>
        </p>

        <p><strong>Use PHP to create a Javascript array with the following values: PHP, HTML, Javascript. Output this array using PHP. Create a script that will display the values of this array on your page.</strong><br>
            <?php
                echo "<script>";
                echo "var languageArray = ['PHP', 'HTML', 'Javascript'];";
                echo "</script>";
            ?>
        </p>

        <p id="displayLanguageArray"></p>

        <script>
            var arrayLength = languageArray.length;
            var printLanguageArray = "";
            for (var i = 0; i < arrayLength; i++) {
                    printLanguageArray += (languageArray[i])+"<br>";
                }


            document.getElementById("displayLanguageArray").innerHTML = printLanguageArray;
        </script>

    </div>
</div>
</body>
</html>
