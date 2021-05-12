<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//Pridanie 6 otazok (3 pre prvy a druhy typ) do DB staci spustit raz
//Nezabudni prepisat $conn pre vlastnu DB

require_once "inc/DatabasePeter.php";
$conn = (new DatabasePeter())->getConnection();

$question1 = "Aké je hlavné mesto Nemecka?";
$correctAnswer1 = "Berlin";
$type1 = 1;

$question2 = "Koľko je odmocnina z 81?";
$correctAnswer2 = "9";
$type2 = 1;

$question3 = "V ktorom roku skončila 2. svetová vojna?";
$correctAnswer3 = "1945";
$type3 = 1;

$question4 = "V ktorom roku začala 2. svetová vojna?";
$correctAnswer4 = "1939";
$otherAnswers4 = ["1940", "1945", "1943"];
$type4 = 2;

$question5 = "Koľko farieb obsahuje slovenská vlajka?";
$correctAnswer5 = "3";
$otherAnswers5 = ["4", "2"];
$type5 = 2;

$question6 = "Aký vek sa pokladá za dospelosť na Slovensku?";
$correctAnswer6 = "18";
$otherAnswers6 = ["21", "17", "19", "20"];
$type6 = 2;

$question7 = "2+2,4*4,5+8,6+12";
$correctAnswer7 = "4,16,13,18";
$type7 = 3;

$question8 = "Slovensko,Rusko,Nemecko,Rakúsko";
$correctAnswer8 = "Bratislava,Moskva,Berlín,Viedeň";
$type8 = 3;

//vlozi otazku prveho typu - kratka odpoved
$stmQuestion1 = $conn->prepare("INSERT INTO questions(question, type_id, correct_answer_id) VALUES(?,?,?)");
//vlozi otazku druheho typu - moznosti
$stmQuestion2 = $conn->prepare("INSERT INTO questions(question, type_id, correct_answer_id, all_answers_id) VALUES(?,?,?,?)");
//vlozi otazku tretieho typu - parovanie
$stmQuestion3 = $conn->prepare("INSERT INTO questions(question, type_id, correct_answer_id) VALUES(?,?,?)");
//vlozi odpovede do tabulky
$stmAnswer = $conn->prepare("INSERT INTO answers(answer, is_correct) VALUES(?,?)");
//ziska ID odpovede
$stmGetAnswerID = $conn->prepare("SELECT id FROM answers WHERE answer = ?");

//vlozi spravne odpovede
$stmAnswer->execute([$correctAnswer1, 1]);
$stmAnswer->execute([$correctAnswer2, 1]);
$stmAnswer->execute([$correctAnswer3, 1]);
$stmAnswer->execute([$correctAnswer4, 1]);
$stmAnswer->execute([$correctAnswer5, 1]);
$stmAnswer->execute([$correctAnswer6, 1]);
$stmAnswer->execute([$correctAnswer7, 1]);
$stmAnswer->execute([$correctAnswer8, 1]);

//ziskanie id ostatnych odpovedi - vo fore sa dopisuju do tychto stringov
$otherAnswersID4 = "";
$otherAnswersID5 = "";
$otherAnswersID6 = "";

//vlozi vsetky ostatne odpovede pre otazku druheho typu - moznosti
foreach ($otherAnswers4 as $answer){
    $stmAnswer->execute([$answer, 0]);
    $stmGetAnswerID->execute([$answer]);
    $tmpID = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);
    $otherAnswersID4 = $otherAnswersID4 . $tmpID['id'] . ",";
}
$otherAnswersID4 = substr($otherAnswersID4, 0, -1);

foreach ($otherAnswers5 as $answer){
    $stmAnswer->execute([$answer, 0]);
    $stmGetAnswerID->execute([$answer]);
    $tmpID = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);
    $otherAnswersID5 = $otherAnswersID5 . $tmpID['id'] . ",";
}
$otherAnswersID5 = substr($otherAnswersID5, 0, -1);

foreach ($otherAnswers6 as $answer){
    $stmAnswer->execute([$answer, 0]);
    $stmGetAnswerID->execute([$answer]);
    $tmpID = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);
    $otherAnswersID6 = $otherAnswersID6 . $tmpID['id'] . ",";
}
$otherAnswersID6 = substr($otherAnswersID6, 0, -1);

//ziskanie id spravnych odpovedi
$stmGetAnswerID->execute([$correctAnswer1]);
$correctAnswerID1 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer2]);
$correctAnswerID2 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer3]);
$correctAnswerID3 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer4]);
$correctAnswerID4 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer5]);
$correctAnswerID5 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer6]);
$correctAnswerID6 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer7]);
$correctAnswerID7 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

$stmGetAnswerID->execute([$correctAnswer8]);
$correctAnswerID8 = $stmGetAnswerID->fetch(PDO::FETCH_ASSOC);

//vlozenie otazok do tabulky - prvy a druhy typ
$stmQuestion1->execute([$question1, $type1, $correctAnswerID1['id']]);
$stmQuestion1->execute([$question2, $type2, $correctAnswerID2['id']]);
$stmQuestion1->execute([$question3, $type3, $correctAnswerID3['id']]);

$stmQuestion2->execute([$question4, $type4, $correctAnswerID4['id'], $otherAnswersID4]);
$stmQuestion2->execute([$question5, $type5, $correctAnswerID5['id'], $otherAnswersID5]);
$stmQuestion2->execute([$question6, $type6, $correctAnswerID6['id'], $otherAnswersID6]);

$stmQuestion3->execute([$question7, $type7, $correctAnswerID7['id']]);
$stmQuestion3->execute([$question8, $type8, $correctAnswerID8['id']]);

