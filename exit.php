<?php
require_once "partials/header.php";
echo getHead('Test odovzdaný');
?>
<div class="finishTest">
    <button class="btn btn-choice btn-lg disabled" type="button" >
        Úspešne si odovzdal test, o výsledkoch budeš informovaný vyučujúcim</button>
</div>
<div class="finishTest2">
    <button onclick="window.location.href='index.php'" id="testInfo" class="btn">Späť na domovskú obrazovku</button>
</div>
<?php echo getFooter();?>
