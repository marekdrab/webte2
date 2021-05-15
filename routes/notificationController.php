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

else if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['closeWindow'] == '1'){
    $insert = $conn->prepare("UPDATE students SET active=2 WHERE id=:id");
    $insert->bindParam(':id', $_SESSION['student_id']);
    $insert->execute();
}
else if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $_GET['sendTest'] == '1'){
    $insert = $conn->prepare("UPDATE students SET active=3 WHERE id=:id");
    $insert->bindParam(':id', $_SESSION['student_id']);
    $insert->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $insert = $conn->prepare("SELECT * FROM students s left join tests t on t.code = s.test_number 
WHERE s.test_submit=0 and s.test_number = t.code and t.teacher_id = :teacher_id");
    $insert->bindParam(':teacher_id', $_SESSION['teacher_id']);
    $insert->execute();
    $result = $insert->fetchAll();
    echo json_encode($result);
}
