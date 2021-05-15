<?php
require_once "partials/loginChecker.php";
require_once "partials/header.php";
require_once "inc/Database.php";
$conn = (new Database())->createConnection();
$stmt = $conn->prepare("select * from tests where teacher_id = :teacher_id");
$stmt->bindParam(':teacher_id', $_SESSION['teacher_id']);
$stmt->execute();
$rs = $stmt->fetchAll();


echo getHead('Testy');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]);?>
<div class="container">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table" id="tableTest">
                <thead>
                <tr>
                    <td>Názov</td>
                    <td>Kód</td>
                    <td>Aktivita</td>
                    <td>Čas</td>
                    <td>Detail</td>
                    <td>Vymazať</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rs as $row) { ?>
                    <tr id="<?php echo $row['code']; ?>">
                        <td><?php echo $row['name']; ?></td>
                        <td class="row-data"><?php echo $row['code']; ?></td>
                        <td>
                            <input class="btn btn-login row-data btn-table <?php echo $row['is_active'] == 1 ? 'is-active' : 'is-inactive' ?>"
                                   type="button" onclick="changeActivity()" value="<?php echo $row['is_active']; ?>">
                        </td>
                        <td><?php echo $row['time_limit']; ?></td>
                        <td><a class="btn btn-login btn-table" href="testOverview.php?code=<?php echo $row['code']; ?>">Detail</a> </td>
                        <td><input type="button" class="btn btn-login btn-table" value="Vymazať" onclick="deleteTest()"></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <div class="space"></div>

<?php echo getFooter();?>