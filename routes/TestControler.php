<?php
require_once "../inc/Database.php";
$conn = (new Database())->createConnection();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $code = rand(10000,99999);
    $insert = $conn->prepare("insert into tests(name, time_limit,is_active,code) values (:name,:time_limit,:is_active,:code)");
    $insert->bindParam(':name', $_POST['name']);
    $insert->bindParam(':time_limit', $_POST['timeLimit']);
    $insert->bindParam(':code', $code);
    $is_active = 0;
    $insert->bindParam(':is_active', $is_active);
    $insert->execute();
    echo $code;
}
if($_SERVER['REQUEST_METHOD']=='PUT'){
    $stmt = $conn->prepare("update tests set is_active= :activity where code = :code");
    $stmt->bindParam(':code', $_GET['code']);
    $stmt->bindParam(':activity', $_GET['activity']);
    $stmt->execute();
    $get = $conn->prepare("select is_active from tests where code = :code");
    $get->bindParam(':code', $_GET['code']);
    $get->execute();
    $rs = $get->fetch();
    echo $rs['is_active'];
}