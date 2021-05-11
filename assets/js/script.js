$(document).ready(function () {
    $('#addTest').click(function () {
        $.ajax({
            type: 'POST',
            url: 'routes/TestControler.php',
            data: {
                name: $('#name').val(),
                timeLimit: $('#timeLimit').val(),
            },
            success: function (result) {
                window.location.replace('testOverview.php')
            },
            error: function (result) {
                alert('error');
            }
        })
    })
})