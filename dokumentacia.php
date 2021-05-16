<?php
session_start();

require_once "partials/header.php";
echo getHead('Dokumentácia');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
<div class="container documentation">
    <div class="row">
        <div class="col-md-12">
            <h1>Dokumentácia</h1>
            <h4>Párovacie otázky</h4>
            <p>jsPlumb</p>
            <h4>Otázky s kreslením</h4>
            <p>drawingboard.js</p>
            <h4>Matematické výrazy</h4>
            <p>mathquill.js</p>
            <h4>PDF export</h4>
            <a href="http://www.fpdf.org/">FPDF</a>
            <h4>PHPGangsta</h4>
            <p>Prihlasovanie</p>
            <h4>Hodnotenie a aktivácia testov</h4>
            <p>Hodnotenie a aktivácia testov je vykonávaná pomocou kliknutia na tlačidlo. Po kliknutí zmení hodnotu 0/1.</p>
            <h4>Bodovanie testov</h4>
            <p>Bodovanie je spravené spôsobom 1 otázka = 1 bod. V prípade párovacej otázky, 1 správny pár = 0,25 boda.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h1>Rozdelenie úloh</h1>
            <table class="table">
                <tbody>
                <tr>
                    <td>Prihlasovanie</td>
                    <td>Dávid Gavenda</td>
                </tr>
                <tr>
                    <td>Otázky s krátkymi odpoveďami (zobrazenie, automatické vyhodnotenie)</td>
                    <td>Peter Andrejko</td>
                </tr>
                <tr>
                    <td>Otázky s možnosťami (zobrazenie, automatické vyhodnotenie)</td>
                    <td>Peter Andrejko</td>
                </tr>
                <tr>
                    <td>Párovacie otázky (zobrazenie, automatické vyhodnotenie)</td>
                    <td>Peter Andrejko</td>
                </tr>
                <tr>
                    <td>Otázky s kreslením (zobrazenie, vkladanie výsledku do testu)</td>
                    <td>Tomáš Danko</td>
                </tr>
                <tr>
                    <td>Otázky s matematickým výrazom (zobrazenie, vkladanie výsledku do testu)</td>
                    <td>Tomáš Danko</td>
                </tr>
                <tr>
                    <td>Zadávanie otázok do testu</td>
                    <td>Marek Dráb</td>
                </tr>
                <tr>
                    <td>Pridávanie viacerých testov, aktivácia a deaktivácia testov</td>
                    <td>Marek Dráb</td>
                </tr>
                <tr>
                    <td>Manuálne vyhodnotenie testu učiteľom</td>
                    <td>Marek Dráb</td>
                </tr>
                <tr>
                    <td>Info o zbiehaní testov</td>
                    <td>Michal Hamrák</td>
                </tr>
                <tr>
                    <td>Uloženie a vyhodnotenie testu</td>
                    <td>Peter Andrejko</td>
                </tr>
                <tr>
                    <td>Časovač a ukončenie testu po uplynutí času</td>
                    <td>Dávid Gavenda</td>
                </tr>
                <tr>
                    <td>Export do PDF</td>
                    <td>Marek Dráb, Michal Hamrák</td>
                </tr>
                <tr>
                    <td>Export do CSV</td>
                    <td>Peter Andrejko</td>
                </tr>
                <tr>
                    <td>Docker balíček</td>
                    <td>Dávid Gavenda</td>
                </tr>
                <tr>
                    <td>Dizajn a štruktúra aplikácie</td>
                    <td>Michal Hamrák</td>
                </tr>
                <tr>
                    <td>Databáza</td>
                    <td>Marek Dráb</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<div class="space"></div>
</div>

<?php echo getFooter();?>