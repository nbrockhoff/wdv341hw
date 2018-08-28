<?php 
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

if (($_SESSION['validUser']) == "yes"){
    
    session_destroy();
    unset($validUser);
    $_SESSION['validUser']="null";
    
    $sessionMessage="Sorry to see you go- have a great day!";
    
	header("Location: http://nbrockhoff.com/wdv341/eventLogin.php");
}
?>