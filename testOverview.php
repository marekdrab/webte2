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

$stmGetQuestion->execute([7]);
$question = $stmGetQuestion->fetch(PDO::FETCH_ASSOC);
//var_dump($question);

$stmGetAnswer->execute([$question['correct_answer_id']]);
$correctAnswer = $stmGetAnswer->fetch(PDO::FETCH_ASSOC);
//var_dump($correctAnswer);

$strQuestion = $question['question'];
$strAnswer = $correctAnswer['answer'];

$matches = explode(",", $strQuestion);
//var_dump($matches);
$answers = explode(",", $strAnswer);
//var_dump($answers);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="assets/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.5/js/jsplumb.min.js"></script>
    <script src="assets/js/script.js"></script>
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
</head>
<body>
<div id="page_connections">
    <div id="select_list_lebensbereiche">
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
    <div id="select_list_wirkdimensionen">
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
<input type="button" value="reset" onclick="clearConnections();">
<input type="button" value="done" onclick="points3rdQuestion();">

<input type="hidden" value="0" id="points-question3" name="points-question3">

</body>
</html>