<?php
session_start();
require_once "partials/header.php";
require_once "inc/Database.php";
$conn = (new Database())->createConnection();

echo getHead('Odovzdané testy');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Meno</th>
                        <th scope="col">Priezvisko</th>
                        <th scope="col">Číslo testu</th>
                    </tr>
                    </thead>
                    <tbody class="bodyTable">
                    <?php
                    $insert = $conn->prepare("SELECT * FROM students WHERE test_submit=1");
                    $insert->execute();
                    $result = $insert->fetchAll();

                    foreach ($result as $row){?>
                        <tr class="rowTab" id="<?php echo $row['id']; ?>">
                            <td class="name"><?php echo $row['first_name']; ?></td>
                            <td class="surname"><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['test_number']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php echo getFooter();?>