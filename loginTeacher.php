<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
session_start();

require_once "inc/Database.php";
$conn = (new Database())->createConnection();
require_once('assets/PHPGangsta/GoogleAuthenticator.php');
$ga = new PHPGangsta_GoogleAuthenticator();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT * FROM teachers WHERE email=?";
    $stm = $conn->prepare($sql);
    $stm->execute([$_POST['email']]);
    $user= $stm->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_POST['psw'],$user['password'])){
      if (isset($_POST['code'])) {
          $code = $_POST['code'];
          $ga = new PHPGangsta_GoogleAuthenticator();
          $result = $ga->verifyCode($user['secret'], $code);
          if ($result == 1) {
              $_SESSION['teacher_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['loginType'] = "Teacher";
            header("location: domov.php");
          } else {
              echo 'Login failed';
          }
      }
    }
}


?>
<?php
require_once "partials/header.php";
echo getHead('Login  učiteľ');
echo getHeaderHome()?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form action="loginTeacher.php" method="POST">
                <div class="container-login">

                    <h1>Prihlásenie</h1>

                    <label for="email"><b>Email</b></label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>

                    <label for="psw"><b>Heslo</b></label>
                    <input type="password" class="form-control" placeholder="Heslo" name="psw" id="psw" required>

                    <label for="code"><b>Kód bez medzery</b></label>
                    <input type="text" class="form-control" placeholder="Kód" name="code" id="code" required maxlength="6" minlength="6">

                    <button type="submit" class='btn btn-login btn-block'>Prihlásiť</button>
                    <h5>Nemáš účet? <a href="register.php">Zaregistruj sa !</a></h5>
                </div>

            </form>
        </div>
    </div>
</div>


<?php echo getFooter();?>