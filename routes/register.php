<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "/inc/databaseDavid.php";
$conn = (new Database())->createConnection();
require_once('/assets/PHPGangsta/GoogleAuthenticator.php');
$ga = new PHPGangsta_GoogleAuthenticator();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method="POST">
    <div class="container">

        <h1>Registrácia</h1>

        <label for="email"><b>Email</b></label>
        <input type="text" class="form-control" placeholder="Vlož Email" name="email" id="email" required>

        <label for="name"><b>Meno</b></label>
        <input type="text" class="form-control" placeholder="Vlož meno" name="name" id="name" required>

        <label for="surname"><b>Priezvisko</b></label>
        <input type="text" class="form-control" placeholder="Vlož priezvisko" name="surname" id="surname" required>

        <label for="psw"><b>Heslo</b></label>
        <input type="password" class="form-control" placeholder="Vlož heslo" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Heslo znova</b></label>
        <input type="password" class="form-control" placeholder="Zopakuj heslo" name="psw-repeat" id="psw-repeat" required>

    <br>
        <?php
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
        echo '<h2>Toto si naskenuj :<img src="'.$qrCodeUrl.'" />' . "</h2>";
        ?>

        <input type="hidden" name="secret" value="<?php echo isset($secret) ? $secret : null;?>">
        <hr>

        <button type="submit" class='btn btn-primary btn-block'>Zaregistruj</button>
    </div>

    <div class="container signin">
        <h2>Už máš účet? <a href="login.php">Prihlás sa!</a></h2>
    </div>
    </form>
</body>
</html>

