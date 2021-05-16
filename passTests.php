<?php
require_once "partials/loginChecker.php";
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
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $insert = $conn->prepare("select st.id, st.test_code, s.first_name, s.last_name 
from submitted_tests st 
    left join students s on s.test_number=st.test_code and s.id = st.student_id 
    left join tests t on t.code=s.test_number where s.active = 3 and t.teacher_id = :teacher_id");
                    $insert->bindParam(':teacher_id',$_SESSION['teacher_id']);
                    $insert->execute();
                    $result = $insert->fetchAll();

                    foreach ($result as $row){?>
                        <tr class="rowTab" id="<?php echo $row['id']; ?>">
                            <td class="name"><?php echo $row['first_name']; ?></td>
                            <td class="surname"><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['test_code']; ?></td>
                            <td><a type="button" class="btn btn-login" href="submittedTestDetail.php?id=<?php echo $row['id']; ?>">Detail</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="space"></div>

<?php echo getFooter();?>