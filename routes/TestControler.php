<?php
require_once "../inc/Database.php";
$conn = (new Database())->createConnection();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $code = rand(10000,99999);
    $insert = $conn->prepare("insert into tests(name, time_limit,code) values (:name,:time_limit,:code)");
    $insert->bindParam(':name', $_POST['name']);
    $insert->bindParam(':time_limit', $_POST['timeLimit']);
    $insert->bindParam(':code', $code);
    $insert->execute();
}