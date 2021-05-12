<?php

session_start();
 if(empty($_SESSION['name']) || empty($_SESSION['surname']) ) {
    header("location: https://wt41.fei.stuba.sk/final/index.php");
 }    


