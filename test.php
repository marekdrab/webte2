<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "partials/loginChecker.php";
require_once "partials/header.php";
require_once "inc/Database.php";

$conn = (new Database())->createConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (isset($_GET['code'])){
        $stm = $conn->prepare("SELECT * FROM tests WHERE code = ?");
        $stm->execute([$_GET['code']]);
        $test = $stm->fetch(PDO::FETCH_ASSOC);
    }
}


echo getHead('test');
?>


<body>
    <div id="countdownInfo">
        <b>Čas:</b>
        <div id="countdown"></div>
    </div>
<div class="container">
<?php
if (isset($test)){

    $question_ids = explode(",", $test['question_id']);
    $stmGetQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $stmGetAnswer = $conn->prepare("SELECT * FROM answers WHERE id = ?");
    echo "<p id='minutes' hidden>". $test['time_limit']."</p>";
    ?>

    <?php
    $noQuestion = 1;

    foreach ($question_ids as $question_id){
        $stmGetQuestion->execute([$question_id]);
        $question = $stmGetQuestion->fetch(PDO::FETCH_ASSOC);
        $questionType = $question['type_id'];

        switch ($questionType){
            case "1":
                ?>
                <div class="row justify-content-center">
                    <div class="col-md-8 containerQuestion">
                        <div class="container-login">
                            <h2>Otázka <?php echo $noQuestion ?>:</h2>
                            <p><?php echo $question['question']; ?></p>
                            <label for="question<?php echo $noQuestion ?>">Odpoveď:</label>
                            <input class="form-control" type="text" id="question<?php echo $noQuestion ?>" name="question<?php echo $noQuestion ?>"><br>
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
                <div class="row justify-content-center">
                    <div class="col-md-8 containerQuestion">
                        <div class="container-login">
                            <h2>Otázka <?php echo $noQuestion ?>:</h2>
                            <p><?php echo $question['question']; ?></p>
                            <?php
                            $noRadioAnswer = 1;
                            foreach ($otherAnswersIds as $otherAnswersId){
                                $stmGetAnswer->execute([$otherAnswersId]);
                                $otherAnswer = $stmGetAnswer->fetch(PDO::FETCH_ASSOC)['answer'];
                                //var_dump($otherAnswer);
                                //var_dump($stmGetAnswer);
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="question<?php echo $noQuestion . $noRadioAnswer ?>" id="question<?php echo $noQuestion . $noRadioAnswer ?>" value="<?php echo $correctAnswer ?>">
                                    <label class="form-check-label" for="question<?php echo $noQuestion . $noRadioAnswer ?>"><?php echo $otherAnswer ?></label>
                                </div>

                                <?php
                            }

                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="question<?php echo $noQuestion . $noRadioAnswer ?>" id="question<?php echo $noQuestion . $noRadioAnswer ?>" value="<?php echo $correctAnswer ?>">
                                <label class="form-check-label" for="question<?php echo $noQuestion . $noRadioAnswer ?>"><?php echo $correctAnswer ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
            case "3":
                ?>
                <div class="row justify-content-center">
                    <div class="col-md-8 containerQuestion container-login">
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
                                <div id="page_connections" >
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
                            <input class="btn btn-login" type="button" value="Vymazať" onclick="clearConnections();">
                            <input class="btn btn-login" type="button" value="Uložiť" onclick="points3rdQuestion();">

                            <input type="hidden" value="0" id="question<?php echo $noQuestion . $noRadioAnswer ?>" name="question<?php echo $noQuestion . $noRadioAnswer ?>">
                        </div>
                    </div>
                </div>
                <?php
                break;
        }
        $noQuestion++;
    }
    ?>
    <!--     Krelsiaca otazka -->
    <div class="row justify-content-center">
        <div class="col-md-8 containerQuestion">
            <div class="container-login" style="width: 300px; height: 500px;">
                <h2>Otázka KRESLENIE:</h2>
                <form class="drawing-form" action="sendCanva.php" method="post">

                    <!-- this will be the drawingboard container -->
                    <div id="board" style="width: 100%; height: 100%;"></div>

                    <!-- this will be the input used to pass the drawingboard content to the server -->
                    <input type="hidden" name="image" value="">
                    <label>Name <input type="text" name="name" /></label>
                    <button>Submit</button>
                </form>
                <!--        <input class="form-control" type="text" id="question1" name="question1"><br>-->
            </div>
        </div>
    </div>

    <!--   Matematicka otazka   -->
    <div class="row justify-content-center">
        <div class="col-md-8 containerQuestion">
            <div class="container-login">
                <h2>Otázka MATH:</h2>
                <p><?php echo $question['question']; ?></p>';
                <script>
                    var MQ = MathQuill.getInterface(2);
                </script>
                <div id="keyboard">
                    <div class="btn-group" role="group" aria-label="math functions">
                        <button type="button" class="btn btn-default" onClick='input("\\sqrt")'>√</button>
                        <button type="button" class="btn btn-default" onClick= 'input("\\sin")'>sin</button>
                        <button type="button" class="btn btn-default" onClick='input("\\cos")'>cos</button>
                        <button type="button" class="btn btn-default" onClick='input("\\tan")'>tan</button>
                        <button type="button" class="btn btn-default" onClick='input("\\subset")'>subset</button>
                        <button type="button" class="btn btn-default" onClick='input("\\sum")'>sum</button>
                        <button type="button" class="btn btn-default" onClick='input("\\int")'>integral</button>
                    </div>
                </div>
                <a href="assets/img/napoveda.png" target="_blank" >nápoveda</a> <br>
                <form class="latex-form" action="" method="post">
                    <p>Type math here:
                    </p>
                    <div id="some_id"></div>
                    <button>Submit</button>
                </form>
                <input class="form-control" type="text" id="question1" name="question1"><br>
            </div>
        </div>
    </div>


    <button class="btn btn-choice send">Odovzdať</button>
    <br><br><br>
    </div>
    <script>
        let searchParams = new URLSearchParams(window.location.search)
        document.addEventListener("visibilitychange", function (){
            if (document.visibilityState == "hidden"){
                $.ajax({
                    type: 'PUT',
                    url: 'routes/notificationController.php/?code=' + searchParams.get('code') + '&visibility=hidden',
                    success: function (result){
                        console.log("zavolal som hidden")
                    }
                })
            }
            else if (document.visibilityState == "visible") {
                $.ajax({
                    type: 'PUT',
                    url: 'routes/notificationController.php/?code=' + searchParams.get('code') + '&visibility=visible',
                    success: function (result){
                        console.log("zavolal som visible")
                    }
                })
            }
        })
    </script>

    <?php
}
?>
    <script src="assets/js/draw.js"></script>
    <script src="assets/js/math.js"></script>
<?php echo getFooter();?>

