function isHidden(){
    $.ajax({
        type: 'GET',
        url: 'routes/notificationController.php',
        success: function (result){
            setTimeout(function () {
                var activeState = JSON.parse(result)
                var row = $('#tableNotification tbody tr')
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
                    if (row.attr('id') == id['id'])
                        //console.log(row.attr('id'), id['id'])
                        row = row.next()
                    else row.remove()
                })
                var tableLen = $('#tableNotification tbody tr').length
                if(tableLen < activeState.length) {
                    var newRows = activeState.length - tableLen
                    for(var i=0; i<newRows;i++){
                        var activity ="Píše test"
                        switch (activeState[tableLen+i]['active']){
                            case 0:
                                activity = "Opustil tab"
                                break
                            case 2:
                                activity ="Študent zatvoril okno"
                                break
                        }

                        if (activeState[tableLen+i]['active'] != 3){
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
                }
                isHidden();


            }, 500);
        }
    })
}
isHidden();