<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once("classes/helper/config.php");
require_once("classes/helper/Database.php");
$conn = (new Database())->createConnection();


if(isset($_POST['latex'])){
try {
    var_dump($_POST);
    $id_testu = 1;
    $id_studenta = 1;
    $sql = "INSERT INTO latex(id_studenta, id_testu, value) VALUES(?,?,?);";
    $stm = $conn->prepare($sql);
    $rows = $stm->execute([$id_studenta, $id_testu, $_POST['latex']]);
    die();
}
catch (PDOException $e){
    echo $e;
}
}