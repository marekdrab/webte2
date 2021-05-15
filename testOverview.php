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
<div class="container addTest">
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
<div class="space"></div>
<?php echo getFooter(); ?>