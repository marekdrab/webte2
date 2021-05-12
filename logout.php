<?php


session_start();
      
//Destroy entire session
session_destroy();


//Redirect to homepage      
header("Location:index.php");
?>

<h1>THIS IS LOGOUT</h1>
