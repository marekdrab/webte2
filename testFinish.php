<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();

require_once "inc/Database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = (new Database())->createConnection();

    $stmSubmitAnswerWithInput = $conn->prepare("INSERT INTO submitted_answers(is_correct, input_answer) VALUES(?,?)");
    $stmSubmitAnswer = $conn->prepare("INSERT INTO submitted_answers(is_correct) VALUES(?)");
    $getLastInsert = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
    $stmSubmitTest = $conn->prepare("INSERT INTO submitted_tests(test_code, student_id, submitted_answers_id) VALUES(?,?,?)");

    $submittedAnswersIds = "";

    foreach ($_POST as $key => $item){
        if (substr($key, 0, 8) == "question") {
            $questionId = substr($key, "8");

            $stmGetQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
            $stmGetCorrectAnswer = $conn->prepare("SELECT answer FROM answers WHERE id = ?");

            $stmGetQuestion->execute([$questionId]);
            $question = $stmGetQuestion->fetch(PDO::FETCH_ASSOC);

            $stmGetCorrectAnswer->execute([$question['correct_answer_id']]);
            $correctAnswer = $stmGetCorrectAnswer->fetch(PDO::FETCH_ASSOC)['answer'];

            if ($item == $correctAnswer){
                $stmSubmitAnswerWithInput->execute([1, $item]);
            }
            else{
                $stmSubmitAnswerWithInput->execute([0, $item]);
            }
        }
        else if ($key == "points-question3"){
            $stmSubmitAnswer->execute([$item]);
        }
        //TODO QUESTION 4 AND 5
        else if ($key == "TODO QUESTION 4"){

        }
        else if ($key == "TODO QUESTION 5"){

        }

        $getLastInsert->execute();
        $submitAnswerId = $getLastInsert->fetch()['last_insert'];

        $submittedAnswersIds = $submittedAnswersIds . $submitAnswerId . ",";
    }
    $submittedAnswersIds = substr($submittedAnswersIds, 0, -1);

    echo '<br>' . $_GET['code'] . "---" . $_SESSION['student_id'] . "---" . $submittedAnswersIds . '<br>';
    $stmSubmitTest->execute([$_GET['code'], $_SESSION['student_id'], $submittedAnswersIds]);


    header("location: exit.php");

}
require_once "partials/header.php";
echo getHead('Test odovzdaný');
?>
<div class="finishTest">
    <button class="btn btn-choice btn-lg disabled" type="button" >
        Úspešne si odovzdal test, o výsledkoch budeš informovaný vyučujúcim</button>
</div>
<div class="finishTest2">
    <button onclick="window.location.href='index.php'" id="testInfo" class="btn">Späť na domovskú obrazovku</button>
</div>
<?php echo getFooter();?>


