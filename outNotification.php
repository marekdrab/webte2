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
                                elseif ($row['active'] == 2){
                                    echo "Študent zatvoril okno";
                                }else{
                                    echo "Študent odovzdal test";
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
                    //console.log(result)
                    setTimeout(function () {
                        var activeState = JSON.parse(result)
                        console.log(activeState)
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
                        var tableLen = $('#tableNotification tbody tr').length
                        console.log(tableLen)
                        console.log(activeState.length)
                        if(tableLen < activeState.length) {
                            var newRows = activeState.length - tableLen
                            console.log(newRows)
                            for(var i=0; i<newRows;i++){
                                var activity ="Píše test"
                                switch (activeState[tableLen+i]['active']){
                                    case 0:
                                        activity = "Opustil tab"
                                        break
                                    case 2:
                                        activity ="Študent zatvoril okno"
                                        break
                                    case 3:
                                        activity = "Študent odovzdal test"
                                        break
                                }
                                $('#tableNotification > tbody:last-child').append('<tr class="rowTab" id="'+activeState[tableLen+i]['id']+'">' +
                                    '<td class="name">'+activeState[tableLen+i]['first_name']+'</td>' +
                                    '<td class="surname">'+activeState[tableLen+i]['last_name']+'</td>' +
                                    '<td class="active">'+activity+'</td>' +
                                    '<td>'+activeState[tableLen+i]['code']+'</td>' +
                                    '</tr>');
                                $('table#tableNotification tr#' + activeState[tableLen+i]['id'] + ' td.active').css('background-color', 'yellow');
                                $('table#tableNotification tr#' + activeState[tableLen+i]['id'] + ' td.active').css('color', 'black');
                            }
                        }
                        isHidden();


                    }, 500);
                }
            })
        }
        isHidden();
    </script>
<div class="space"></div>

<?php echo getFooter();?>