<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../inc/Database.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['code'])){

        $fileName = "test" . $_GET['code'] . ".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $conn = (new Database())->createConnection();

        $stmStudents = $conn->prepare("SELECT * FROM students WHERE test_number = ? AND test_submit = ?");
        $stmSubmittedTest = $conn->prepare("SELECT * FROM submitted_tests WHERE test_code = ? AND student_id = ?");
        $stmSubmittedAnswers = $conn->prepare("SELECT * FROM submitted_answers WHERE id = ?");
        $stmPoints = $conn->prepare("SELECT is_correct FROM submitted_answers WHERE id = ?");

        $stmStudents->execute([$_GET['code'],1]);
        $students = $stmStudents->fetchAll(PDO::FETCH_ASSOC);

        $list = [];

        foreach ($students as $student){
            $studentArr = [];

            $stmSubmittedTest->execute([$student['test_number'], $student['id']]);
            $test = $stmSubmittedTest->fetch(PDO::FETCH_ASSOC);

            $submittedAnswersId = $test['submitted_answers_id'];
            $arrIds = explode(",", $submittedAnswersId);

            $points = 0;
            foreach ($arrIds as $id){
                $stmPoints->execute([$id]);
                $tmpPoints = $stmPoints->fetch(PDO::FETCH_ASSOC)['is_correct'];
                $points += floatval($tmpPoints);
            }
            $studentArr = [$student['id'], $student['first_name'], $student['last_name'], $points];
            array_push($list, $studentArr);
        }

        $fp = fopen('php://output', 'wb');

        foreach ($list as $line) {
            fputcsv($fp, $line, ",");
        }
        fclose($fp);
    }
}