<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "inc/Database.php";

$conn = (new Database())->createConnection();

if(isset($_POST['latex'])){

    die();
}


define("DIR", "drawings/");

$img = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

//echo "<br><br>post: ".var_dump(INPUT_POST);
//echo "<br><br>img: ".var_dump($img);
//
//echo "<br><br>name: ".var_dump($name);
//TODO: zmenit name na ID studenta plus $date
$date = date("Y-M-D_H:i:s");
var_dump($date);
$name.= $date;

//see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
$img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
$data = base64_decode($img);

//echo "<br><br>img: ".var_dump($img);
//
//echo "<br><br>data: ".var_dump($data);

//create the image png file with the given name
try{
file_put_contents(DIR. str_replace(' ', '_', $name) .'.png', $data);
echo "Success";
}
catch (Exception $e){
    echo $e;
}

$id_studenta = 1;
$id_testu = 1;

$sql = "INSERT INTO canvas(id_studenta, id_testu, name) VALUES(?,?,?);";
$stm = $conn->prepare($sql);
$rows = $stm->execute([$id_studenta, $id_testu, $name]);
//$rows = $stm->fetchAll();

//exit();
?>

