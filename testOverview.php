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
        <div class="col-md-4">
            <label for="questionType">Vyber typ otázky:</label>

            <select name="questionType" id="questionType">
                <option value=""></option>
                <?php foreach ($types as $type) { ?>
                    <option value="<?php echo $type['id']?>"><?php echo $type['type']?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <label for="question">Znenie otázky</label>
            <input type="text" id="question" name="question" required>
            <div id="questionShort">
                <label for="answer-1">Spravna odpoved</label>
                <input type="text" id="answer-1" name="answer-1" required>
            </div>
            <div id="questionChoices">2</div>
            <div id="questionPairs">3</div>
            <div id="questionDrawing">4</div>
            <div id="questionMaths">5</div>
        </div>
    </div>
</div>



<?php echo getFooter(); ?>