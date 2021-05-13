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
        $test = $stm->fetch();
    }
}



echo getHead('Test');
?>
<body>
<?php
if (isset($test)){
    var_dump($test);
    $question_ids = explode(",", $test['question_id']);

    $stmQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $stmQuestion->execute([$question_ids[0]]);
    $question = $stmQuestion->fetch();
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 containerQuestion">
                <div class="container-login">
                    <h2>Otázka 1:</h2>
                    <p><?php echo $question['question']; ?></p>';
                    <label for="question1">Odpoveď:</label>
                    <input class="form-control" type="text" id="question1" name="question1"><br>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 containerQuestion">
                <div class="container-login">
                    <h2>Otázka X:</h2>
                    <p><?php echo $question['question']; ?></p>';
                    <label for="question1">Odpoveď:</label>
                    <input class="form-control" type="text" id="question1" name="question1"><br>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 containerQuestion">
                <div class="container-login">
                    <h2>Otázka Y:</h2>
                    <p><?php echo $question['question']; ?></p>';
                    <label for="question1">Odpoveď:</label>
                    <input class="form-control" type="text" id="question1" name="question1"><br>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 containerQuestion">
                <div class="container-login">
                    <h2>Otázka Z:</h2>
                    <p><?php echo $question['question']; ?></p>';
                    <label for="question1">Odpoveď:</label>
                    <input class="form-control" type="text" id="question1" name="question1"><br>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("visibilitychange", function (){
            document.title = document.visibilityState;
            if (document.visibilityState == "hidden"){
                console.log("opustil");
            }
            //console.log(document.visibilityState);
        })
    </script>

    <?php
}
?>
<?php echo getFooter();?>
</body>
