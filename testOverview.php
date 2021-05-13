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
echo getHead('Test |');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 container-login">
                <label for="questionType"><b>Vyber typ otázky:</b></label>
                <select class="form-control" name="questionType" id="questionType">
                    <option value="">Vyber jednu z možností...</option>
                    <?php foreach ($types as $type) { ?>
                        <option value="<?php echo $type['id'] ?>"><?php echo $type['type'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 container-login">
                <label for="question"><b>Znenie otázky</b></label>
                <input class="form-control" type="text" id="question" name="question" required>
                <hr>
                <div id="questionShort">
                    <label for="answer-11"><b>Správna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-11" name="answer-11" required>
                </div>
                <div id="questionChoices">
                    <label for="answer-21"><b>Správna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-21" name="answer-21" required>
                    <label for="answer-22"><b>Nesprávna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-22" name="answer-22" required>
                    <label for="answer-23"><b>Nesprávna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-23" name="answer-23" required>
                    <label for="answer-24"><b>Nesprávna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-24" name="answer-24" required>
                </div>
                <div id="questionPairs">
                    <div class="col-md-6">
                        <label for="answer-31"><b>Match</b></label>
                        <input class="form-control" type="text" id="answer-31" name="answer-31" required>
                    </div>
                    <div class="col-md-6">
                        <label for="answer-32"><b>Answer</b></label>
                        <input class="form-control" type="text" id="answer-32" name="answer-32" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

<?php echo getFooter(); ?>