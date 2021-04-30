<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "../inc/databaseDavid.php";
$conn = (new Database())->createConnection();
require_once('../assets/PHPGangsta/GoogleAuthenticator.php');
$ga = new PHPGangsta_GoogleAuthenticator();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    header("location: https://wt51.fei.stuba.sk/webte2/homepage.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login student</title>
</head>
<body>
    <form action="loginStudent.php" method="POST">
        <div class="container">

            <h1>Prihlasenie</h1>

            <label for="name"><b>Meno a priezvisko</b></label>
            <input type="text" class="form-control" placeholder="Meno a priezvisko" name="name" id="name" required>


            <label for="code"><b>Kod testu</b></label>
            <input type="text" class="form-control" placeholder="Vlož kod" name="code" id="code" required>

            <button type="submit" class='btn btn-primary btn-block'>Prihlas sa</button>
        </div>
    </form>
</body>
</html>