<?php
require_once "partials/header.php";
require_once "inc/Database.php";

$conn = (new Database())->createConnection();
$stmt = $conn->prepare("select * from tests");
$stmt->execute();
$rs = $stmt->fetchAll();


echo getHeader('Testy'); ?>
<body>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <table id="myTable">
                <thead>
                <tr>
                    <td>Nazov</td>
                    <td>Kod</td>
                    <td>Aktivita</td>
                    <td>Cas</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rs as $row) { ?>
                    <tr id="<?php echo $row['code']; ?>">
                        <td><?php echo $row['name']; ?></td>
                        <td class="row-data"><?php echo $row['code']; ?></td>
                        <td>
                            <input class="btn btn-primary changeActivity row-data <?php echo $row['is_active'] == 1 ? 'is-active' : 'is-inactive' ?>"
                                   type="button" onclick="changeActivity()" value="<?php echo $row['is_active']; ?>">
                        </td>
                        <td><?php echo $row['time_limit']; ?></td>
                        <td><a class="btn btn-primary" href="testOverview.php?code=<?php echo $row['code']; ?>">Detail</a> </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
