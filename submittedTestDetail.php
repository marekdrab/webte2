<?php
require_once "partials/loginChecker.php";
require_once "partials/header.php";
require_once "inc/Database.php";
$conn = (new Database())->createConnection();

echo getHead('Odovzdané testy');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Otázka</th>
                    <th>Odpoveď študenta</th>
                    <th>Správna odpoveď</th>
                    <th>Hodnotenie</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getTest = $conn->prepare("select st.submitted_answers_id, t.question_id from submitted_tests st 
                                                join tests t on st.test_code = t.code where st.id = :id");
                $getTest->bindParam(':id', $_GET['id']);
                $getTest->execute();
                $resultTest = $getTest->fetch();

                $answers = explode(",", $resultTest['submitted_answers_id']);
                $questions = explode(",", $resultTest['question_id']);
                $getAnswer = $conn->prepare("select * from submitted_answers where id = :id");
                $getQuestion = $conn->prepare("select * from questions where id = :id");
                $getCorrectAnswer = $conn->prepare("select * from answers where id = :id");
                for ($i = 0; $i < sizeof($answers); $i++) {
                    $getAnswer->bindParam(':id', $answers[$i]);
                    $getAnswer->execute();
                    $resultAnswer = $getAnswer->fetch();
                    $getQuestion->bindParam(':id', $questions[$i]);
                    $getQuestion->execute();
                    $resultQuestion = $getQuestion->fetch();
                    $getCorrectAnswer->bindParam(':id', $resultQuestion['correct_answer_id']);
                    $getCorrectAnswer->execute();
                    $resultCorrectAnswer = $getCorrectAnswer->fetch();
                    ?>
                    <tr id="<?php echo $resultAnswer['id']; ?>">
                        <td><?php echo $resultQuestion['question']; ?></td>
                        <td><?php echo isset($resultCorrectAnswer['answer']) ? $resultCorrectAnswer['answer'] : '' ?></td>
                        <td><?php if ($resultQuestion['type_id'] == 4) {
                                ?> <img class="ansImg" alt="odpoved studenta"
                                        src="drawings/<?php echo $resultAnswer['input_answer']; ?>">
                            <?php } else if ($resultQuestion['type_id'] == 5) {
                                echo 'vypis latexu' . $resultAnswer['input_answer'];
                            } else
                                echo $resultAnswer['input_answer']; ?></td>
                        <td><input type="button" class="btn btn-login" value="<?php echo $resultAnswer['is_correct']; ?>" onclick="changePoints()" ></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
