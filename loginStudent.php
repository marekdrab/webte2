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
    $conn = (new Database())->createConnection();
    $stmt = $conn->prepare("select case when exists (select * from tests where code = :code and is_active = 1) then 1 else 0 end 'exists'");
    $stmt->bindParam(':code', $_POST['code']);
    $stmt->execute();
    $rs = $stmt->fetch();
    if ($rs['exists'] == 1){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['surname'] = $_POST['surname'];
        $_SESSION['loginType'] = "Student";
        header("location: https://wt41.fei.stuba.sk/final/test.php?code=" . $_POST['code']);
    }  
    else
        echo 'tento test neexistuje'; //TODO pls dorobte error page
}
?>
<?php
require_once "partials/header.php";
echo getHead('Login študent');
echo getHeaderHome()?>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
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
</div>

<?php echo getFooter();?>

</body>
</html>