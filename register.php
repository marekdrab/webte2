<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "inc/Database.php";
$conn = (new Database())->createConnection();
require_once('assets/PHPGangsta/GoogleAuthenticator.php');
$ga = new PHPGangsta_GoogleAuthenticator();
$websiteTitle = "Registracia";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['psw']) && isset($_POST['psw-repeat'])) {
        if (strcmp(($_POST['psw-repeat']), ($_POST['psw'])) == 0) {
            try {
                $sql = "SELECT COUNT(*) AS num FROM `teachers` WHERE email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':email', ($_POST['email']));
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['num'] > 0) {
                    echo "Taky mail uz existuje";
                    //VRATI SPRAVU ZE UZ EXISTUJE 
                } else {
                    $username = $_POST['email'];
                    $stm = $conn->prepare("INSERT IGNORE INTO teachers (email,name,surname,password,secret) VALUES (?,?,?,?,?)");
                    $hash = password_hash($_POST['psw'],PASSWORD_DEFAULT);
                    $stm->execute([$_POST['email'],$_POST['name'],$_POST['surname'],$hash,$_POST['secret']]);
                    //ASI BUDE TREBA VYRIESIT AK TAM UZ TAKY JE
                    header("location: https://wt41.fei.stuba.sk/final/");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Hesla sa nezhoduju";
        }

    }
}

?>
<?php
require_once "partials/header.php";
echo getHead('Registrácia');
echo getHeaderHome() ?>

<div class="container addTest marginBottom">
    <div class="h-100 row align-items-center">
        <div class="container-login">
            <?php
            $secret = $ga->createSecret();
            $qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
            echo '<h4 class>Naskenuj QR kód: <br><img class="qrCode"  alt="qrCode" src="' . $qrCodeUrl . '" />' . "</h4>";
            ?>
        </div>
        <input type="hidden" name="secret" value="<?php echo isset($secret) ? $secret : null;?>">
        <form class="container-login" action="register.php" method="POST">
            <h1>Registrácia</h1>
            <br>
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>

            <label for="name"><b>Meno</b></label>
            <input type="text" class="form-control" placeholder="Meno" name="name" id="name" required>

            <label for="surname"><b>Priezvisko</b></label>
            <input type="text" class="form-control" placeholder="Priezvisko" name="surname" id="surname" required>

            <label for="psw"><b>Zadaj heslo</b></label>
            <input type="password" class="form-control" placeholder="Heslo" name="psw" id="psw" required>

            <label for="psw-repeat"><b>Zadaj heslo znova</b></label>
            <input type="password" class="form-control" placeholder="Heslo" name="psw-repeat" id="psw-repeat"
                   required>

            <button type="submit" class='btn btn-login btn-block'>Zaregistruj</button>
            <h5>Už máš účet? <a href="loginTeacher.php">Prihlás sa!</a></h5>
        </form>
    </div>
</div>


<?php echo getFooter(); ?>
