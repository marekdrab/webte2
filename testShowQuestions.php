<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "partials/loginChecker.php";
require_once "inc/Database.php";
$conn = (new DatabasePeter())->createConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (isset($_GET['code'])){
        $stm = $conn->prepare("SELECT * FROM tests WHERE code = ?");
        $stm->execute([$_GET['code']]);
        $test = $stm->fetch();
    }
}

if (isset($test)){
    var_dump($test);
    $question_ids = explode(",", $test['question_id']);

    $stmQuestion = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $stmQuestion->execute([$question_ids[0]]);
    $question = $stmQuestion->fetch();
    ?>

    <h2>Otázka 1:</h2>
    <p><?php $question['question'] ?></p>';
    <label for="question1">Odpoveď:</label>
    <input type="text" id="question1" name="question1"><br>
    <?php
}

?>

<?php echo getFooter();?>
<body>


</body>
