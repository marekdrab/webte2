<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//Pridanie 6 otazok (3 pre prvy a druhy typ) do DB staci spustit raz
//Nezabudni prepisat $conn pre vlastnu DB

require_once "inc/DatabasePeter.php";
$conn = (new DatabasePeter())->getConnection();

//vyhlada otazku podla ID
$stmGetQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
//vyhlada odpoved podla ID
$stmGetAnswer = $conn->prepare("SELECT * FROM answers WHERE id = ?");

//zatial pevne definovane
$stmGetQuestion->execute([7]);
$question = $stmGetQuestion->fetch(PDO::FETCH_ASSOC);
//var_dump($question);

$stmGetAnswer->execute([$question['correct_answer_id']]);
$correctAnswer = $stmGetAnswer->fetch(PDO::FETCH_ASSOC);
//var_dump($correctAnswer);

$strQuestion = $question['question'];
$strPairs = $correctAnswer['answer'];

$arrPairs = explode("$", $strPairs);

$matches = explode(",", $arrPairs[0]);
var_dump($matches);
$answers = explode(",", $arrPairs[1]);
var_dump($answers);
require_once "partials/header.php";
echo getHead('test');
?>
<style>
    ul {
        width: 150px;
        padding: 0;
        margin-left: 100px;
        float: left;
    }
    li {
        margin-bottom: 20px;
        list-style: none;
        background-color: #ededed;
        height: 40px;
        padding: 5px;
    }


    .jtk-connector
    path {
        stroke: #e03571;
        stroke-width: 3;
    }


    .jtk-endpoint
    circle {
        fill: #e03571;
    }
</style>
<div class="container">
    <div id="page_connections" >
        <p><?php echo $strQuestion ?></p>
        <div id="select-list-matches">
            <ul>
                <?php
                $changeColumn1 = rand(0,1);
                if ($changeColumn1 == 0){
                    $idCounter = 1;
                    foreach ($matches as $match) {
                        echo '<li id="match' . $idCounter . '">' . $match . '</li>';
                        $idCounter++;
                    }
                }
                else {
                    $idCounter = 4;
                    foreach (array_reverse($matches) as $match) {
                        echo '<li id="match' . $idCounter . '">' . $match . '</li>';
                        $idCounter--;
                    }
                }
                ?>
            </ul>
        </div>
        <div id="select-list-answers">
            <ul>
                <?php
                $changeColumn2 = rand(0,1);
                if ($changeColumn2 == 0) {
                    $idCounter = 1;
                    foreach ($answers as $answer) {
                        echo '<li id="answer' . $idCounter . '">' . $answer . '</li>';
                        $idCounter++;
                    }
                }
                else{
                    $idCounter = 4;
                    foreach (array_reverse($answers) as $answer) {
                        echo '<li id="answer' . $idCounter . '">' . $answer . '</li>';
                        $idCounter--;
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<input type="button" value="reset" onclick="clearConnections();">
<input type="button" value="done" onclick="points3rdQuestion();">

<input type="hidden" value="0" id="points-question3" name="points-question3">
<?php echo getFooter(); ?>