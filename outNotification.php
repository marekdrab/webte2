<?php
require_once "partials/header.php";
require_once "partials/loginChecker.php";
require_once "inc/Database.php";
$conn = (new Database())->createConnection();

echo getHead('Notifikácie');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table" id="tableNotification">
                    <thead>
                    <tr>
                        <th scope="col">Meno</th>
                        <th scope="col">Priezvisko</th>
                        <th scope="col">Stav</th>
                        <th scope="col">Číslo testu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $insert = $conn->prepare("SELECT s.id, s.first_name, s.last_name, s.active, t.code FROM students s left join tests t on t.code = s.test_number 
                                                    WHERE test_submit=0 and t.teacher_id = :teacher_id");
                    $insert->bindParam(':teacher_id',$_SESSION['teacher_id']);
                    $insert->execute();
                    $result = $insert->fetchAll();

                    foreach ($result as $row){?>
                        <tr class="rowTab" id="<?php echo $row['id']; ?>">
                            <td class="name"><?php echo $row['first_name']; ?></td>
                            <td class="surname"><?php echo $row['last_name']; ?></td>
                            <td class="active"> <?php
                                if($row['active'] == 0){
                                    echo "Opustil tab";
                                }
                                elseif ($row['active'] == 1){
                                    echo "Píše test";
                                }
                                ?>
                            </td>
                            <td><?php echo $row['code']; ?></td>

                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function isHidden(){
            $.ajax({
                type: 'GET',
                url: 'routes/notificationController.php',
                success: function (result){
                    console.log("zavolal som", result)
                    setTimeout(function () {
                        var activeState = JSON.parse(result)
                        activeState.forEach((id)=>{
                            if (id['active'] == 0){
                                var active = "Opustil tab";
                                $('table#tableNotification tr#' + id['id'] + ' td.active').text(active);
                                $('table#tableNotification tr#' + id['id'] + ' td.active').css('background-color', 'orange');
                            }

                            else if (id['active'] == 1){
                                var active = "Píše test";
                                $('table#tableNotification tr#' + id['id'] + ' td.active').text(active);
                                $('table#tableNotification tr#' + id['id'] + ' td.active').css('background-color', 'yellow');
                                $('table#tableNotification tr#' + id['id'] + ' td.active').css('color', 'black');

                            }
                            else if (id['active'] == 2){
                                var active = "Študent zatvoril okno";
                                $('table#tableNotification tr#' + id['id'] + ' td.active').text(active);
                                $('table#tableNotification tr#' + id['id'] + ' td.active').css('background-color', 'red');

                            }
                            else if (id['active'] == 3){
                                var active = "Študent odovzdal test";
                                $('table#tableNotification tr#' + id['id'] + ' td.active').text(active);
                                $('table#tableNotification tr#' + id['id'] + ' td.active').css('background-color', 'green');

                            }
                        })
                        isHidden();


                    }, 500);
                }
            })
        }
        isHidden();
    </script>

<?php echo getFooter();?>