<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "inc/Database.php";
$conn = (new Database())->createConnection();

$getTypes = $conn->prepare("select * from no_question_type");
$getTypes->execute();
$types = $getTypes->fetchAll();

require_once "partials/header.php";
echo getHead('Úprava testu');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
    <div class="container addTest">
        <div class="row">
            <div class="container-login">
                <div class="h-100 row align-items-center greenBack">
                    <label for="questionType"><b>Vyber typ otázky:</b></label>
                    <select class="form-control" name="questionType" id="questionType">
                        <option value="">Vyber jednu z možností...</option>
                        <?php foreach ($types as $type) { ?>
                            <option value="<?php echo $type['id'] ?>"><?php echo $type['type'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="container-login">
                <div class="h-100 row align-items-center greenBack">
                    <label for="question"><b>Znenie otázky</b></label>
                    <div><span class="error" id="questionError"></span></div>
                    <input class="form-control" type="text" id="question" name="question" required>

                    <hr>
                    <div id="questionShort">
                        <label for="answer-1-1"><b>Správna odpoveď</b></label>
                        <div><span class="error" id="answer-1-1-error"></span></div>
                        <input class="form-control" type="text" id="answer-1-1" name="answer-1-1" required>

                    </div>
                    <div id="questionChoices">
                        <label for="answer-2-1"><b>Správna odpoveď</b></label>
                        <div><span class="error" id="answer-2-1-error"></span></div>
                        <input class="form-control" type="text" id="answer-2-1" name="answer-2-1" required>

                        <label for="answer-2-2"><b>Nesprávna odpoveď</b></label>
                        <div><span class="error" id="answer-2-2-error"></span></div>
                        <input class="form-control" type="text" id="answer-2-2" name="answer-2-2" required>

                        <label for="answer-2-3"><b>Nesprávna odpoveď</b></label>
                        <div><span class="error" id="answer-2-3-error"></span></div>
                        <input class="form-control" type="text" id="answer-2-3" name="answer-2-3" required>


                        <label for="answer-2-4"><b>Nesprávna odpoveď</b></label>
                        <div><span class="error" id="answer-2-4-error"></span></div>
                        <input class="form-control" type="text" id="answer-2-4" name="answer-2-4" required>

                    </div>
                    <div id="questionPairs">
                        <div class="col-md-6">
                            <label for="match-3-1"><b>Možnosť</b></label>
                            <div><span class="error" id="match-3-1-error"></span></div>
                            <input class="form-control" type="text" id="match-3-1" name="match-3-1" required>

                            <label for="match-3-2"><b>Možnosť</b></label>
                            <div><span class="error" id="match-3-2-error"></span></div>
                            <input class="form-control" type="text" id="match-3-2" name="match-3-2" required>

                            <label for="match-3-3"><b>Možnosť</b></label>
                            <div><span class="error" id="match-3-3-error"></span></div>
                            <input class="form-control" type="text" id="match-3-3" name="match-3-3" required>

                            <label for="match-3-4"><b>Možnosť</b></label>
                            <div><span class="error" id="match-3-4-error"></span></div>
                            <input class="form-control" type="text" id="match-3-4" name="match-3-4" required>
                        </div>
                        <div class="col-md-6">
                            <label for="answer-3-1"><b>Odpoveď</b></label>
                            <div><span class="error" id="answer-3-1-error"></span></div>
                            <input class="form-control" type="text" id="answer-3-1" name="answer-3-1" required>

                            <label for="answer-3-2"><b>Odpoveď</b></label>
                            <div><span class="error" id="answer-3-2-error"></span></div>
                            <input class="form-control" type="text" id="answer-3-2" name="answer-3-2" required>

                            <label for="answer-3-3"><b>Odpoveď</b></label>
                            <div><span class="error" id="answer-3-3-error"></span></div>
                            <input class="form-control" type="text" id="answer-3-3" name="answer-3-3" required>

                            <label for="answer-3-4"><b>Odpoveď</b></label>
                            <div><span class="error" id="answer-3-4-error"></span></div>
                            <input class="form-control" type="text" id="answer-3-4" name="answer-3-4" required>

                        </div>
                    </div>
                    <input type="button" class="btn btn-login" value="Pridať otázku" id="addQuestion">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table" id="questionsOverview">
                    <thead>
                    <tr>
                        <th>Otázka</th>
                        <th>Typ otázky</th>
                        <th>Správna odpoveď</th>
                        <th>Ostatné odpovede</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $test = $conn->prepare("select * from tests where code = :code");
                    $test->bindParam(':code', $_GET['code']);
                    $test->execute();
                    $test = $test->fetch();
                    if ($test['question_id'] != "") {
                        $question_ids = explode(",", $test['question_id']);
                        $stmGetQuestion = $conn->prepare("SELECT q.*,qt.type FROM questions q 
    join no_question_type qt on q.type_id = qt.id
    WHERE q.id = :id");
                        $stmGetAnswer = $conn->prepare("SELECT * FROM answers WHERE id = :id");
                        foreach ($question_ids as $id) {
                            $stmGetQuestion->bindParam(':id', $id);
                            $stmGetQuestion->execute();
                            $question = $stmGetQuestion->fetch();
                            $questionType = $question['type_id'];

                            switch ($questionType) {
                                case "1":
                                    $stmGetAnswer->bindParam(':id', $question['correct_answer_id']);
                                    $stmGetAnswer->execute();
                                    $correctAnswer = $stmGetAnswer->fetch();
                                    ?>
                                    <tr id="<?php echo $question['id']; ?>">
                                        <td><?php echo $question['question']; ?></td>
                                        <td><?php echo $question['type']; ?></td>
                                        <td><?php echo $correctAnswer['answer']; ?></td>
                                        <td><?php ?></td>
                                        <td><input type="button" class="btn btn-login btn-table" value="Vymazať" onclick="deleteQuestion()"></td>
                                    </tr>
                                    <?php
                                    break;
                                case "2":
                                    $stmGetAnswer->bindParam(':id', $question['correct_answer_id']);
                                    $stmGetAnswer->execute();
                                    $correctAnswer = $stmGetAnswer->fetch();
                                    $otherAnswersIds = explode(",", $question['all_answers_id']);
                                    $otherAnswers = array();
                                    foreach ($otherAnswersIds as $answerId) {
                                        $stmGetAnswer->bindParam(':id', $answerId);
                                        $stmGetAnswer->execute();
                                        $answer = $stmGetAnswer->fetch();
                                        array_push($otherAnswers, $answer['answer']);
                                    }

                                    ?>
                                    <tr id="<?php echo $question['id']; ?>">
                                        <td><?php echo $question['question']; ?></td>
                                        <td><?php echo $question['type']; ?></td>
                                        <td><?php echo $correctAnswer['answer']; ?></td>
                                        <td><?php foreach ($otherAnswers as $answer) {
                                                echo $answer . ', ';
                                            } ?></td>
                                        <td><input type="button" class="btn btn-login btn-table" value="Vymazať" onclick="deleteQuestion()"></td>
                                    </tr>
                                    <?php
                                    break;
                                case "3":
                                    $stmGetAnswer->bindParam(':id', $question['correct_answer_id']);
                                    $stmGetAnswer->execute();
                                    $correctAnswer = $stmGetAnswer->fetch();

                                    $arrPairs = explode("&", $correctAnswer['answer']);
                                    $matches = explode("~", $arrPairs[0]);
                                    $answers = explode("~", $arrPairs[1]);
                                    ?>
                                    <tr id="<?php echo $question['id']; ?>">
                                        <td><?php echo $question['question']; ?></td>
                                        <td><?php echo $question['type']; ?></td>
                                        <td><?php for ($i = 0; $i < sizeof($matches); $i++) echo $matches[$i] . '+' . $answers[$i] . ';'; ?></td>
                                        <td><?php ?></td>
                                        <td><input type="button" class="btn btn-login btn-table" value="Vymazať" onclick="deleteQuestion()"></td>
                                    </tr>
                                    <?php
                                    break;
                                case "4":
                                case "5":
                                    ?>
                                    <tr id="<?php echo $question['id']; ?>">
                                        <td><?php echo $question['question']; ?></td>
                                        <td><?php echo $question['type']; ?></td>
                                        <td><?php ?></td>
                                        <td><?php ?></td>
                                        <td><input type="button" class="btn btn-login btn-table" value="Vymazať" onclick="deleteQuestion()"></td>
                                    </tr>
                                    <?php
                                    break;


                            }
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div class="space"></div>
<?php echo getFooter(); ?>