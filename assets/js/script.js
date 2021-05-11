$(document).ready(function () {
    $('#myTable').DataTable();

    $('#addTest').click(function () {
        $.ajax({
            type: 'POST',
            url: 'routes/TestControler.php',
            data: {
                name: $('#name').val(),
                timeLimit: $('#timeLimit').val(),
            },
            success: function (result) {
                console.log(result)
                window.location.replace('testOverview.php?code=' + parseInt(result))
            },
            error: function (result) {
                alert('error');
            }
        })
    })
})

function changeActivity() {
    var rowId = event.target.parentNode.parentNode.id;
    var data = document.getElementById(rowId).querySelectorAll(".row-data");
    var code = data[0].innerHTML;
    var activity = data[1].value;
    if(activity==0)
        activity=1
    else activity=0
    $.ajax({
        type: 'PUT',
        url: 'routes/TestControler.php?code=' + code +'&activity=' + activity,
        success: function (result) {
            if(result==1)
                data[1].style.backgroundColor = 'green'
            else
                data[1].style.backgroundColor ='red'
            data[1].value =result
        },
        error: function (result) {
            alert('error');
        }
    })
}