<?php
require_once "partials/header.php";
require_once "partials/loginChecker.php";
echo getHeader('Domov');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
<body>
<div class="container">
    <div class="d-grid gap-2 col-6 mx-auto">
        <button onclick="window.location.replace('addTest.php')" class="btn" type="button">Pridať test</button>
        <button onclick="window.location.replace('tests.php')" class="btn" type="button">Všetky testy</button>
    </div>

</div>
<?php echo getFooter();?>
</body>