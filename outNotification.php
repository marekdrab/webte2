<?php
session_start();
require_once "partials/header.php";
require_once "inc/Database.php";
$conn = (new Database())->createConnection();

echo getHead('Notifikácie');
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>

    <body>
    <div class="container table">
        <table class="table" id="tableData">
            <thead>
            <tr>
                <th scope="col">Meno</th>
                <th scope="col">Priezvisko</th>
                <th scope="col">Stav</th>
                <th scope="col">Číslo testu</th>
            </tr>
            </thead>
            <tbody class="bodyTable">
            <?php
            $insert = $conn->prepare("SELECT * FROM students WHERE test_submit=0");
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
                    <td><?php echo $row['test_number']; ?></td>

                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
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
                                $('table#tableData tr#' + id['id'] + ' td.active').text(active);
                                $('table#tableData tr#' + id['id'] + ' td.active').css('background-color', 'red');
                            }

                            else if (id['active'] == 1){
                                var active = "Píše test";
                                $('table#tableData tr#' + id['id'] + ' td.active').text(active);
                                $('table#tableData tr#' + id['id'] + ' td.active').css('background-color', 'green');

                            }
                        })
                        isHidden();


                    }, 1000);
                }
            })
        }
        isHidden();
    </script>


<?php echo getFooter();?>