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
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['loginType'] = "Teacher";
            header("location: https://wt41.fei.stuba.sk/final/domov.php");
          } else {
              echo 'Login failed';
          }
      }
    }
}


?>
<?php
require_once "partials/header.php";
echo getHeader('Login  učiteľ'); ?>
<body>
    <form action="loginTeacher.php" method="POST">
        <div class="container">

            <h1>Prihlásenie</h1>

            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" placeholder="Vlož Email" name="email" id="email" required>

            <label for="psw"><b>Heslo</b></label>
            <input type="password" class="form-control" placeholder="Vlož heslo" name="psw" id="psw" required>

            <label for="code"><b>Kod bez medzery</b></label>
            <input type="text" class="form-control" placeholder="Vlož kod" name="code" id="code" required maxlength="6" minlength="6">

            <button type="submit" class='btn btn-primary btn-block'>Prihlas sa</button>
        </div>

        <div class="container signin">
            <h2>Nemas ucet? <a href="register.php">Zaregistruj sa !</a></h2>
        </div>
    </form>
</body>
</html>