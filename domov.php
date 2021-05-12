<?php
require_once "partials/header.php";
require_once "partials/loginChecker.php";
echo getHeader('Domov'); ?>
<body>
<div class="container">
    <?php 
    echo $_SESSION['name'] . " " . $_SESSION['surname'] . " - " . $_SESSION["loginType"];
    ?>
    <a href="logout.php">Odhlasenie</a>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary" href="addTest.php">Pridat test</a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-primary" href="tests.php">Testy</a>
        </div>
        
        <div class="col-md-3">

        </div>

        <div class="col-md-3">
            
        </div>
    </div>
</div>
</body>