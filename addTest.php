<?php
require_once "partials/header.php";
echo getHeader('Pridať test'); ?>
<body>
<div class="container">
    <div class="row">
        <label for="name">Nazov</label>
        <input class="form-control" type="text" id="name" name="name" required>
        <label for="timeLimit">Cas</label>
        <input class="form-control" type="number" id="timeLimit" name="timeLimit" required>
        <input class="btn btn-primary" type="button" value="Potvrdit" id="addTest">
    </div>
</div>
</body>
