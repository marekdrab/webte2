<?php
require_once "partials/header.php";
echo getHead('Notifikácie');

?>
    <body>
    <div class="container">

    </div>
    <script>
        function myFun(){
            $.ajax({
                type: 'GET',
                url: 'routes/notificationController.php',
                success: function (result){
                    console.log("zavolal som", result)
                    setTimeout(function () {myFun()}, 1000);
                }
            })
        }
        myFun();
    </script>


<?php echo getFooter();?>