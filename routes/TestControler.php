<?php
require_once "../inc/Database.php";
$conn = (new Database())->createConnection();
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$table = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
$key = array_shift($request);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $table != 'question') {
    $code = rand(10000, 99999);
    $insert = $conn->prepare("insert into tests(name, time_limit,is_active,code, question_id) 
values (:name,:time_limit,:is_active,:code, '')");
    $insert->bindParam(':name', $_POST['name']);
    $insert->bindParam(':time_limit', $_POST['timeLimit']);
    $insert->bindParam(':code', $code);
    $is_active = 0;
    $insert->bindParam(':is_active', $is_active);
    $insert->execute();
    echo $code;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $table == 'question' && isset($key)) {
    switch ($key) {
        case 1:
            //pridanie odpovede
            $insertAnswer = $conn->prepare("insert into answers(answer, is_correct) values(:answer,1)");
            $insertAnswer->bindParam(':answer', $_POST['answer']);
            $insertAnswer->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $answerID = $getID->fetch();
            $answerID = $answerID['last_insert'];
            //pridanie otazky podla posledneho pridaneho id - id odpovede
            $insertQuestion = $conn->prepare("insert into questions(question, type_id,correct_answer_id) 
            values (:question, :type, :correct_answer_id)");
            $insertQuestion->bindParam(':question', $_POST['question']);
            $insertQuestion->bindParam(':type', $key);
            $insertQuestion->bindParam(':correct_answer_id', $answerID);
            $insertQuestion->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $questionID = $getID->fetch();
            $questionID = $questionID['last_insert'];

            //pridanie id otazok k testu
            $getQuestions = $conn->prepare("select question_id from tests where code=:code");
            $getQuestions->bindParam(':code',$_POST['code']);
            $getQuestions->execute();
            $rs = $getQuestions->fetch();
            $getQuestions = $rs['question_id'];
            $getQuestions = $getQuestions . $questionID .',';
            $updateTest = $conn->prepare("update tests set question_id = :question where code = :code");
            $updateTest->bindParam(':question',$getQuestions);
            $updateTest->bindParam(':code',$_POST['code']);
            $updateTest->execute();
            echo $getQuestions;
            break;
        case 2:
            $otherAnswerIDs = "";
            $insertAnswer = $conn->prepare("insert into answers(answer, is_correct) values(:answer,1)");
            $insertAnswer->bindParam(':answer', $_POST['correct_answer']);
            $insertAnswer->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $answerID = $getID->fetch();
            $correct_answerID = $answerID['last_insert'];


            for($i = 0; $i<3;$i++){
                $insertAnswer = $conn->prepare("insert into answers(answer, is_correct) values(:answer,0)");
                $insertAnswer->bindParam(':answer', $_POST['answer_'.$i]);
                $insertAnswer->execute();

                $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
                $getID->execute();
                $answerID = $getID->fetch();
                $answerID = $answerID['last_insert'];

                $otherAnswerIDs = $otherAnswerIDs.$answerID.',';
            }
            $otherAnswerIDs = substr($otherAnswerIDs, 0, -1);
            $insertQuestion = $conn->prepare("insert into questions(question, type_id,correct_answer_id,all_answers_id) 
            values (:question, :type, :correct_answer_id,:all_answers_id)");
            $insertQuestion->bindParam(':question', $_POST['question']);
            $insertQuestion->bindParam(':type', $key);
            $insertQuestion->bindParam(':correct_answer_id', $correct_answerID);
            $insertQuestion->bindParam(':all_answers_id', $otherAnswerIDs);
            $insertQuestion->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $questionID = $getID->fetch();
            $questionID = $questionID['last_insert'];

            $getQuestions = $conn->prepare("select question_id from tests where code=:code");
            $getQuestions->bindParam(':code',$_POST['code']);
            $getQuestions->execute();
            $rs = $getQuestions->fetch();
            $getQuestions = $rs['question_id'];
            $getQuestions = $getQuestions . $questionID .',';
            $updateTest = $conn->prepare("update tests set question_id = :question where code = :code");
            $updateTest->bindParam(':question',$getQuestions);
            $updateTest->bindParam(':code',$_POST['code']);
            $updateTest->execute();
            echo $getQuestions;
            break;
        case 3:
            $concatedMatches = $_POST['match_0'].'~'.$_POST['match_1'].'~'.$_POST['match_2'].'~'.$_POST['match_3'];
            $concatedAnswers = $_POST['answer_0'].'~'.$_POST['answer_1'].'~'.$_POST['answer_2'].'~'.$_POST['answer_3'];
            $answer = $concatedMatches.'&'.$concatedAnswers;
            $insertAnswer = $conn->prepare("insert into answers(answer) values(:answer)");
            $insertAnswer->bindParam(':answer',$answer);
            $insertAnswer->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $answerID = $getID->fetch();
            $answerID = $answerID['last_insert'];

            $insertQuestion = $conn->prepare("insert into questions(question, type_id,correct_answer_id) 
            values (:question, :type, :correct_answer_id)");
            $insertQuestion->bindParam(':question', $_POST['question']);
            $insertQuestion->bindParam(':type', $key);
            $insertQuestion->bindParam(':correct_answer_id', $answerID);
            $insertQuestion->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $questionID = $getID->fetch();
            $questionID = $questionID['last_insert'];

            $getQuestions = $conn->prepare("select question_id from tests where code=:code");
            $getQuestions->bindParam(':code',$_POST['code']);
            $getQuestions->execute();
            $rs = $getQuestions->fetch();
            $getQuestions = $rs['question_id'];
            $getQuestions = $getQuestions . $questionID .',';
            $updateTest = $conn->prepare("update tests set question_id = :question where code = :code");
            $updateTest->bindParam(':question',$getQuestions);
            $updateTest->bindParam(':code',$_POST['code']);
            $updateTest->execute();
            echo $getQuestions;
            break;
        case 4:
        case 5:
            //pridanie otazky podla posledneho pridaneho id - id odpovede
            $insertQuestion = $conn->prepare("insert into questions(question, type_id) 
            values (:question, :type)");
            $insertQuestion->bindParam(':question', $_POST['question']);
            $insertQuestion->bindParam(':type', $key);
            $insertQuestion->execute();

            $getID = $conn->prepare("SELECT LAST_INSERT_ID() 'last_insert'");
            $getID->execute();
            $questionID = $getID->fetch();
            $questionID = $questionID['last_insert'];

            //pridanie id otazok k testu
            $getQuestions = $conn->prepare("select question_id from tests where code=:code");
            $getQuestions->bindParam(':code',$_POST['code']);
            $getQuestions->execute();
            $rs = $getQuestions->fetch();
            $getQuestions = $rs['question_id'];
            $getQuestions = $getQuestions . $questionID .',';
            $updateTest = $conn->prepare("update tests set question_id = :question where code = :code");
            $updateTest->bindParam(':question',$getQuestions);
            $updateTest->bindParam(':code',$_POST['code']);
            $updateTest->execute();
            echo $getQuestions;
            break;
    }

}
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
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
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $stmt = $conn->prepare("delete from tests where code = :code");
    $stmt->bindParam(':code', $_GET['code']);
    $stmt->execute();
}