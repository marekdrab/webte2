<?php
session_start();
require_once "../inc/Database.php";
$conn = (new Database())->createConnection();

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['visibility'] == 'hidden'){
    $insert = $conn->prepare("UPDATE students SET active=0 WHERE id=:id");
    $insert->bindParam(':id', $_SESSION['student_id']);
    $insert->execute();
}

else if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['visibility'] == 'visible'){
    $insert = $conn->prepare("UPDATE students SET active=1 WHERE id=:id");
    $insert->bindParam(':id', $_SESSION['student_id']);
    $insert->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $insert = $conn->prepare("SELECT * FROM students WHERE test_submit=0");
    $insert->execute();
    $result = $insert->fetchAll();
    echo json_encode($result);
}
