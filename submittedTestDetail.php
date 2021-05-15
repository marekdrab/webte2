<?php
require_once "partials/loginChecker.php";
require_once "partials/header.php";
require_once "inc/Database.php";
$conn = (new Database())->createConnection();

echo getHead('Odovzdané testy');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Otázka</th>
                    <th>Odpoveď študenta</th>
                    <th>Správna odpoveď</th>
                    <th>Hodnotenie</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
