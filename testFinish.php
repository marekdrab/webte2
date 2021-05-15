<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();

require_once "inc/Database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = (new Database())->createConnection();

    $stmSubmitAnswerOnlyInput = $conn->prepare("INSERT INTO submitted_answers(input_answer) VALUES(?)");
    $stmSubmitAnswerWithInput = $conn->prepare("INSERT INTO submitted_answers(is_correct, input_answer) VALUES(?,?)");
    $stmSubmitAnswer = $conn->prepare("INSERT INTO submitted_answers(is_correct) VALUES(?)");
    $getLastInsert = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
    $stmSubmitTest = $conn->prepare("INSERT INTO submitted_tests(test_code, student_id, submitted_answers_id) VALUES(?,?,?)");

    $submittedAnswersIds = "";

    foreach ($_POST as $key => $item) {
        if (substr($key, 0, 8) == "question") {
            $questionId = substr($key, "8");

            $stmGetQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
            $stmGetCorrectAnswer = $conn->prepare("SELECT answer FROM answers WHERE id = ?");

            $stmGetQuestion->execute([$questionId]);
            $question = $stmGetQuestion->fetch(PDO::FETCH_ASSOC);

            $stmGetCorrectAnswer->execute([$question['correct_answer_id']]);
            $correctAnswer = $stmGetCorrectAnswer->fetch(PDO::FETCH_ASSOC)['answer'];

            if ($item == $correctAnswer) {
                $stmSubmitAnswerWithInput->execute([1, $item]);
            } else {
                $stmSubmitAnswerWithInput->execute([0, $item]);
            }
        } else if ($key == "points-question3") {
            $pointsQuestion3 = explode("|", $item)[0];
            $submittedPairs = explode("|", $item)[1];

            echo $pointsQuestion3 . '<br>' . $submittedPairs . '<br>';

            $stmSubmitAnswerWithInput->execute([$pointsQuestion3, $submittedPairs]);
        } //TODO QUESTION 4 AND 5
        else if ($key == "points-question4") {
            $stmSubmitAnswerWithInput->execute([0, $item]);
        } else if ($key == "points-question5") {
            $stmSubmitAnswerWithInput->execute([0,$item]);
        }

        $getLastInsert->execute();
        $submitAnswerId = $getLastInsert->fetch()['last_insert'];

        $submittedAnswersIds = $submittedAnswersIds . $submitAnswerId . ",";
    }

    $submittedAnswersIds = substr($submittedAnswersIds, 0, -1);

    $stmSubmitTest->execute([$_GET['code'], $_SESSION['student_id'], $submittedAnswersIds]);

    session_destroy();
    header("Location: exit.php");
}