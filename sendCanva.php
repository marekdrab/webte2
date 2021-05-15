<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "inc/Database.php";

$conn = (new Database())->createConnection();

if(isset($_POST['latex'])){

    die();
}
if(isset($_POST['surname'])) {
    $student_username = $_POST['name'];
    $student_surname = $_POST['surname'];
}

define("DIR", "drawings/");

$img = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);
//$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

//TODO: zmenit name na ID studenta plus $date
$date = date("Y-M-D_H:i:s");
//var_dump($date);
$name = $date;
$name = $student_username."_".$student_surname.$name;

//see http://j-query.blogspot.fr/2011/02/save-base64-encoded-canvas-image-to-png.html
$img = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $img));
$data = base64_decode($img);

//create the image png file with the given name
try{
    file_put_contents(DIR. str_replace(' ', '_', $name) .'.png', $data);
    echo $name.".png";
}
catch (Exception $e){
    echo $e;
}

?>

