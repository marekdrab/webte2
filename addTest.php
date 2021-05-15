<?php
require_once "partials/header.php";
require_once "partials/loginChecker.php";
echo getHead('Pridať test');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>

<body>
<div class="container addTest">
    <div class="h-100 row align-items-center">
        <div class="container-login">
            <label for="name">Názov</label>
            <input class="form-control" type="text" id="name" name="name" required>
            <span class="error" id="nameError"></span>
            <label for="timeLimit">Čas</label>
            <input class="form-control" type="number" id="timeLimit" name="timeLimit" required>
            <span class="error" id="timeError"></span>
            <input class="btn btn-login btn-block" type="button" value="Potvrdiť" id="addTest">
        </div>
    </div>
</div>
</body>
<?php echo getFooter();?>
