<?php
require_once "partials/header.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<?php echo getHeader('Login'); ?>
<body>
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12"><h1>TODO</h1></div>
    </div>
    <div class="row">
        <div class="col-md-4"><a href="loginStudent.php">Student - login</a></div>
        <div class="col-md-4"> <a href="loginTeacher.php">Teacher - login</a></div>
        <div class="col-md-4"><a href="register.php">Teacher - register</a></div>
    </div>
</div>
</body>
</html>