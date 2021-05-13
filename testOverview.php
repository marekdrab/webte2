<?php
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
?>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 container-login">
                <label for="questionType"><b>Vyber typ otázky:</b></label>
                <select class="form-control" name="questionType" id="questionType">
                    <option value="">Vyber jednu z možností...</option>
                    <?php foreach ($types as $type) { ?>
                        <option value="<?php echo $type['id']?>"><?php echo $type['type']?></option>
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
                    <label for="answer-1"><b>Správna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-1" name="answer-1" required>
                </div>
                <div id="questionChoices">
                    <label for="answer-2"><b>Správna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-2" name="answer-2" required>
                    <label for="answer-3"><b>Nesprávna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-3" name="answer-3" required>
                    <label for="answer-4"><b>Nesprávna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-4" name="answer-4" required>
                    <label for="answer-5"><b>Nesprávna odpoveď</b></label>
                    <input class="form-control" type="text" id="answer-5" name="answer-5" required>
                </div>
                <div id="questionPairs">3</div>
            </div>
        </div>
    </div>
</body>

<?php echo getFooter(); ?>