<?php
require_once "partials/header.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<?php echo getHead('Login');
?>
<div class="container margin-top-15">
    <div class="d-grid gap-2 col-6 mx-auto ">
        <button onclick="window.location.href='loginStudent.php'" class="btn btn-choice btn-lg" type="button">Študent</button>
        <button onclick="window.location.href='loginTeacher.php'" class="btn btn-choice btn-lg" type="button">Učiteľ</button>
    </div>
</div>
<?php echo getFooter();?>
