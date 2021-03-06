<?php
require_once "../partials/loginChecker.php";
require_once "../inc/Database.php";
include_once "../inc/FPDF/fpdf.php";
include_once "../inc/FPDF/helveticab.php";
$conn = (new Database())->createConnection();

class PDF extends FPDF
{
}

$display_heading = array('first_name' => 'Meno', 'last_name' => 'Priezvisko', 'question' => 'Otázka', 'answer' => 'Odpoveď');
$pdf = new PDF();

$getTests = $conn->prepare("select st.student_id, t.question_id, st.submitted_answers_id from submitted_tests st join tests t on st.test_code = t.code where st.test_code = :code");
$getTests->bindParam(':code', $_GET['code']);
$getTests->execute();
$rs = $getTests->fetchAll(PDO::FETCH_ASSOC);


$getQuestion = $conn->prepare("select question, type_id from questions where id = :id");
$getAnswer = $conn->prepare("select input_answer from submitted_answers where id=:id");

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
foreach ($rs as $row) {
    $answers = explode(",", $row['submitted_answers_id']);
    $questions = explode(",", $row['question_id']);
    $pdf->Ln();
    $pdf->Cell(28, 8, "| ID Studenta:");
    $pdf->Cell(40,8,$row['student_id']);

    $pdf->Ln();
    for ($i = 0; $i < sizeof($answers); $i++) {
        $getQuestion->bindParam(':id', $questions[$i]);
        $getQuestion->execute();
        $resultQuestion = $getQuestion->fetch(PDO::FETCH_ASSOC);
        $getAnswer->bindParam(':id', $answers[$i]);
        $getAnswer->execute();
        $resultAnswer = $getAnswer->fetch(PDO::FETCH_ASSOC);
        $pdf->Cell(40,8,$resultQuestion['question']);
        $pdf->Ln();
        $pdf->Cell(40,8,$resultAnswer['input_answer']);
        $pdf->Ln();
        $pdf->Ln();
    }
    $pdf->Cell(100, 8 ,"-------------------------------------------------------------------------------------");

}
$pdf->Output('I','Test '.$_GET['code'].'.pdf',true);