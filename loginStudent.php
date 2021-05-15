<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "inc/Database.php";
$conn = (new Database())->createConnection();
//require_once('assets/PHPGangsta/GoogleAuthenticator.php');
//$ga = new PHPGangsta_GoogleAuthenticator();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("select case when exists (select * from tests where code = :code and is_active = 1) then 1 else 0 end 'exists'");
    $stmt->bindParam(':code', $_POST['code']);
    $stmt->execute();
    $rs = $stmt->fetch();
    if ($rs['exists'] == 1){
        $insertStudent = $conn->prepare("insert into students (first_name,last_name,active, test_number, test_submit) values (:first_name,:last_name,1,:test_number, 0)");
        $insertStudent->bindParam(':first_name',$_POST['name']);
        $insertStudent->bindParam(':last_name',$_POST['surname']);
        $insertStudent->bindParam(':test_number',$_POST['code']);
        $insertStudent->execute();
        $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
        $getID->execute();
        $answerID = $getID->fetch();
        $_SESSION['student_id'] = $answerID['last_insert'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['surname'] = $_POST['surname'];
        $_SESSION['loginType'] = "Student";
        $_SESSION['startTime'] = $objDateTime = new DateTime('NOW');
        header("location: test.php?code=" . $_POST['code']);
    }  
    else
        echo 'tento test neexistuje'; //TODO pls dorobte error page
}
?>
<?php
require_once "partials/header.php";
echo getHead('Login študent');
echo getHeaderHome()?>
<div class="container addTest">
    <div class="h-100 row align-items-center">
        <form action="loginStudent.php" method="POST">
            <div class="container-login">
                <h1>Prihlásenie</h1>

                <label for="name"><b>Meno</b></label>
                <input type="text" class="form-control" placeholder="Meno" name="name" id="name" required>

                <label for="surname"><b>Priezvisko</b></label>
                <input type="text" class="form-control" placeholder="Priezvisko" name="surname" id="surname" required>

                <label for="code"><b>Kód testu</b></label>
                <input type="text" class="form-control" placeholder="Vlož kód" name="code" id="code" required>

                <button type="submit" class='btn btn-login btn-block'>Prihlásiť</button>
            </div>
        </form>
    </div>
</div>

<?php echo getFooter();?>
