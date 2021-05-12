<?php
require_once "partials/header.php";
require_once "partials/loginChecker.php";
echo getHeader('Domov');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
<body>
<div class="container">
    <div class="d-grid gap-2 col-6 mx-auto">
        <button onclick="window.location.href='addTest.php'" class="btn" id="testInfo" type="button">Pridať test</button>
        <button onclick="window.location.href='tests.php'" class="btn" id="testInfo" type="button">Všetky testy</button>
    </div>

</div>
<?php echo getFooter();?>
</body>