<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link rel="stylesheet" href="assets/css/draw.css">

</head>
<body>
<h1>TODO</h1>

<div class="app">
    <div class="controls">
        <div class="title">Sketch</div>
        <div class="type">
            <input type="radio" name="pen-type" id="pen-pencil" checked>
            <label for="pen-pencil">
                <i class="fa fa-pencil"></i>
            </label>
            <input type="radio" name="pen-type" id="pen-brush">
            <label for="pen-brush">
                <i class="fa fa-paint-brush"></i>
            </label>
        </div>
        <div class="size">
            <label for="pen-size">Size</label>
            <input type="range" id="pen-size" min="1" max="50">
        </div>
        <div class="color">
            <label for="pen-color">Color</label>
            <input type="color" id="pen-color" value="#000">
        </div>
        <div class="actions">
            <button id="reset-canvas">Reset</button>
            <button id="save-canvas">Save</button>
        </div>
    </div>
    <div id="canvas-wrapper"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.6/p5.min.js"></script>
<script src="assets/js/draw.js"></script>


</body>
</html>