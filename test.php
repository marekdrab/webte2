<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "partials/loginChecker.php";
require_once "partials/header.php";
require_once "inc/Database.php";

$conn = (new Database())->createConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['code'])) {
        $stm = $conn->prepare("SELECT * FROM tests WHERE code = ?");
        $stm->execute([$_GET['code']]);
        $test = $stm->fetch(PDO::FETCH_ASSOC);
       //$time = clone $_SESSION['startTime'];
        //$finishTime = $time->add(new DateInterval('PT' . $test['time_limit'] . 'M'));
    }
}


echo getHead('Test');
echo getHeaderStudent($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]);

?>
<script defer src="assets/js/timer.js"></script>
<script src="assets/js/connections.js"></script>
<div id="countdownInfo">
    <b>Čas:</b>
    <div id="countdown"><?php echo $test['time_limit'].':00'; ?></div>
    <?php
    //$remain = $finishTime->diff(new DateTime());
    //echo $remain->i . ' minút a ' . $remain->s . ' sekúnd';
    //var_dump($remain);
    ?>
</div>
<div class="container conTest">
    <form action="testFinish.php?code=<?php echo $test['code'] ?>" method="post" id="testForm">
        <?php
        if (isset($test)){

        $question_ids = explode(",", $test['question_id']);
        $stmGetQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
        $stmGetAnswer = $conn->prepare("SELECT * FROM answers WHERE id = ?");
        echo "<p id='minutes' hidden>" . $test['time_limit'] . "</p>";
        ?>

        <?php
        $noQuestion = 1;

        foreach ($question_ids as $question_id) {
            $stmGetQuestion->execute([$question_id]);
            $question = $stmGetQuestion->fetch(PDO::FETCH_ASSOC);
            $questionType = $question['type_id'];

            switch ($questionType) {
                case "1":
                    ?>
                    <div class="marginTopBottom">
                        <div class="h-100 row align-items-center">
                            <div class="container-login">
                                <h2>Otázka <?php echo $noQuestion ?>:</h2>
                                <p><?php echo $question['question']; ?></p>
                                <label for="question<?php echo $noQuestion ?>">Odpoveď:</label>
                                <input class="form-control" type="text" value="" id="question<?php echo $noQuestion ?>"
                                       name="question<?php echo $question_id ?>"><br>
                            </div>
                        </div>
                    </div>

                    <?php
                    break;
                case "2":
                    $stmGetAnswer->execute([$question['correct_answer_id']]);
                    $correctAnswer = $stmGetAnswer->fetch(PDO::FETCH_ASSOC)['answer'];

                    $otherAnswersIds = explode(",", $question['all_answers_id']);
                    ?>
                <div class="marginTopBottom">
                    <div class="h-100 row align-items-center">
                        <div class="container-login">
                            <h2>Otázka <?php echo $noQuestion ?>:</h2>
                            <p><?php echo $question['question']; ?></p>
                            <?php
                            $radioButtonOptions = [];
                            foreach ($otherAnswersIds as $otherAnswersId) {
                                $stmGetAnswer->execute([$otherAnswersId]);
                                $otherAnswer = $stmGetAnswer->fetch(PDO::FETCH_ASSOC)['answer'];
                                array_push($radioButtonOptions, $otherAnswer);
                            }
                            array_push($radioButtonOptions, $correctAnswer);
                            shuffle($radioButtonOptions);
                                ?>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="question<?php echo $question_id ?>"
                                       value="<?php echo $radioButtonOptions[0] ?>"
                                       id="question<?php echo $noQuestion ?>1" checked>
                                <label class="form-check-label"
                                       for="question<?php echo $noQuestion ?>1"><?php echo $radioButtonOptions[0] ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="question<?php echo $question_id ?>"
                                       value="<?php echo $radioButtonOptions[1] ?>"
                                       id="question<?php echo $noQuestion ?>2">
                                <label class="form-check-label"
                                       for="question<?php echo $noQuestion ?>2"><?php echo $radioButtonOptions[1] ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="question<?php echo $question_id ?>"
                                       value="<?php echo $radioButtonOptions[2] ?>"
                                       id="question<?php echo $noQuestion ?>3">
                                <label class="form-check-label"
                                       for="question<?php echo $noQuestion ?>3"><?php echo $radioButtonOptions[2] ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                       name="question<?php echo $question_id ?>"
                                       value="<?php echo $radioButtonOptions[3] ?>"
                                       id="question<?php echo $noQuestion ?>4">
                                <label class="form-check-label"
                                       for="question<?php echo $noQuestion ?>4"><?php echo $radioButtonOptions[3] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                    break;
                case "3":
                    ?>
                    <div class="marginTopBottom">
                        <div class="h-100 row align-items-center">
                            <div class="container-login">
                                <h2>Otázka <?php echo $noQuestion ?>:</h2>
                                <p><?php echo $question['question']; ?></p>
                                <?php
                                $stmGetQuestion->execute([$question_id]);
                                //var_dump($question);

                                $stmGetAnswer->execute([$question['correct_answer_id']]);
                                $correctAnswer = $stmGetAnswer->fetch(PDO::FETCH_ASSOC);
                                //var_dump($correctAnswer);

                                $strQuestion = $question['question'];
                                $strPairs = $correctAnswer['answer'];

                                $arrPairs = explode("&", $strPairs);

                                $matches = explode("~", $arrPairs[0]);
                                //var_dump($matches);
                                $answers = explode("~", $arrPairs[1]);
                                //var_dump($answers);
                                ?>

                                <div class="containerPairs">
                                    <div class="container-login" id="page_connections">
                                        <div id="select-list-matches">
                                            <ul>
                                                <?php
                                                $changeColumn1 = rand(0, 1);
                                                if ($changeColumn1 == 0) {
                                                    $idCounter = 1;
                                                    foreach ($matches as $match) {
                                                        echo '<li id="match' . $idCounter . '">' . $match . '</li>';
                                                        $idCounter++;
                                                    }
                                                } else {
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
                                                $changeColumn2 = rand(0, 1);
                                                if ($changeColumn2 == 0) {
                                                    $idCounter = 1;
                                                    foreach ($answers as $answer) {
                                                        echo '<li id="answer' . $idCounter . '">' . $answer . '</li>';
                                                        $idCounter++;
                                                    }
                                                } else {
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
                                <div class="col-md-6">
                                    <input class="btn btn-login" type="button" value="Vymazať"
                                           onclick="clearConnections();">
                                    <input class="btn btn-login" type="button" value="Uložiť"
                                           onclick="points3rdQuestion();">

                                </div>

                                <input type="hidden" value="0" id="points-question3" name="points-question3">
                            </div>
                        </div>
                    </div>

                    <?php
                    break;
                case "4":
                    ?>
        <div class="marginTopBottom">
            <div class="h-100 row align-items-center">
                <div class="container-login" style="width: 100%; height: 700px;">
                    <h2>Otázka <?php echo $noQuestion ?>:</h2>
                    <p><?php echo $question['question']; ?></p>
                    <div id="board" style="height: 500px;" class="col-md-10"></div><br>
                    <button class="btn btn-login" type="button" onclick="sendCanva(this, '<?php echo $_SESSION['name']; ?>', '<?php echo $_SESSION['surname']; ?>')">Uložiť</button>

                </div>

                </div>
                <input type="hidden" value="0" id="points-question4" name="points-question4">

            </div>
                    <?php
                    break;
                case "5":
                    ?>
        <div class="marginTopBottom">
            <div class="h-100 row align-items-center">
                    <div class="container-login">
                        <h2>Otázka <?php echo $noQuestion ?>:</h2>
                        <p><?php echo $question['question']; ?></p>
                        <div id="keyboard" style="overflow: auto">
                            <div class="btn-group" role="group" aria-label="math functions">
                                <button type="button" class="btn btn-default" onClick='input("\\sqrt")'>√</button>
                                <button type="button" class="btn btn-default" onClick='input("\\sin")'>sin</button>
                                <button type="button" class="btn btn-default" onClick='input("\\cos")'>cos</button>
                                <button type="button" class="btn btn-default" onClick='input("\\tan")'>tan</button>
                                <button type="button" class="btn btn-default" onClick='input("\\subset")'>subset</button>
                                <button type="button" class="btn btn-default" onClick='input("\\sum")'>sum</button>
                                <button type="button" class="btn btn-default" onClick='input("\\int")'>integral</button>
                            </div>
                        </div>
                        <a href="assets/img/napoveda.png" target="_blank" class="mathHint"><img src="assets/img/mathHint.png"> nápoveda</a> <br>

                        <p>Tu napíšte vašu odpoveď: </p>
                        <div  id="some_id" class="form-control math" ></div>
                        <button class="btn btn-login" type="button" onclick="sendLatex(this); getText()">Uložiť</button>
                        <input type="hidden" value="0" id="points-question5" name="points-question5">
                    </div>
            </div>
        </div>
                    <?php
                    break;
            }
            $noQuestion++;
        }
        ?><?php
        ?>
        <button onclick="sendTest()" type="submit" class="btn btn-choice send">Odovzdať</button>
    </form>

            <br><br><br>
</div>

<script src="assets/js/draw.js"></script>
<script src="assets/js/math.js"></script>
<script src="assets/js/sendNotifications.js"></script>
    <div class="space"></div>

<?php
}
?>

<?php echo getFooter(); ?>

