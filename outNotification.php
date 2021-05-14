<?php
session_start();
require_once "partials/header.php";
echo getHead('Notifikácie');
require_once "inc/Database.php";
$conn = (new Database())->createConnection();
echo getHeaderTeacher($_SESSION['name'], $_SESSION['surname'], $_SESSION["loginType"]); ?>

    <body>
    <div class="container table">
        <table class="table" id="students">
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
            $insert = $conn->prepare("SELECT * FROM students");
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
                                $('table#students tr#' + id['id'] + ' td.active').text(active);
                            }

                            else if (id['active'] == 1){
                                var active = "Píše test";
                                $('table#students tr#' + id['id'] + ' td.active').text(active);
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