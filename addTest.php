<?php
require_once "partials/header.php";
require_once "partials/loginChecker.php";
echo getHead('Pridať test');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="container-login">
                <label for="name">Názov</label>
                <input class="form-control" type="text" id="name" name="name" required>
                <label for="timeLimit">Čas</label>
                <input class="form-control" type="number" id="timeLimit" name="timeLimit" required>
                <input class="btn btn-login btn-block" type="button" value="Potvrdiť" id="addTest">
            </div>
        </div>
    </div>

</div>
</body>
