<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "inc/Database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = (new Database())->createConnection();
    var_dump($_POST);

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
                echo "spravna odpoved";
            }
        }
        else if ($key == "points-question3"){
            //TODO pridat body do DB pre tretiu otazku
        }
    }

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


