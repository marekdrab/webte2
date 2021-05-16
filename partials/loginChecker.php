<?php

session_start();
if (isset($_SESSION['loginType'])) {
    if ((empty($_SESSION['name']) || empty($_SESSION['surname'])) && ($_SESSION['loginType'] == "Študent")) {
        header("location: https://wt41.fei.stuba.sk/final/index.php");
    }
}


