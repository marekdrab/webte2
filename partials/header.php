<?php
function getHead($pageTitle)
{
    return <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$pageTitle}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.5/js/jsplumb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="assets/js/script.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/partials/margins.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
    <script src="assets/drawingboard.js-master/dist/drawingboard.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/drawingboard.js-master/dist/drawingboard.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.js" type="text/javascript"></script>

</head>
<body>
HTML;
}

function getHeaderTeacher($name, $surname, $typeLogin){
    return <<<HTML
<header>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="domov.php"><b>Domov</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:history.back()">Sp????</a>
        </li>
    </ul>
    <ul class="nav">
        <li class="nav-item navRight">
            <span id="noHover" class="nav-link"><b>$typeLogin |</b> $name $surname</span>
        </li>
        <li class="nav-item navRight">
            <a class="nav-link" href="logout.php">Odhl??si??</a>
        </li>
    </ul>

</header>
HTML;

}

function getHeaderStudent($name, $surname, $typeLogin){
    return <<<HTML
<header>
    <ul class="nav">
        
    </ul>
    <ul class="nav">
        <li class="nav-item navRight">
            <span id="noHover" class="nav-link"><b>$typeLogin |</b> $name $surname</span>
        </li>
        <li class="nav-item navRight">
            <a class="nav-link" href="logout.php">Odhl??si??</a>
        </li>
    </ul>

</header>
HTML;

}

function getHeaderHome(){
    return <<<HTML
<header>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Sp????</a>
        </li>
    </ul>
</header>
HTML;

}


function getFooter(){
    return <<<HTMl
<footer>
    <span>&copy; 2021 Z??vere??n?? zadanie WEBTECH 2</span>
</footer>
</body>
</html>
HTMl;

}
