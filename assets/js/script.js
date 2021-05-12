$(document).ready(function() {
    $('#tableData').DataTable( {
        "language": {
            "decimal":        "",
            "emptyTable":     "Dáta nie sú dostupné",
            "infoEmpty":      "Zobrazené od 0 do 0 z 0 výsledkov",
            "infoFiltered":   "(filtrované z _MAX_ všetkých záznamov)",
            "infoPostFix":    "",
            "thousands":      ",",
            "loadingRecords": "Načitáva...",
            "processing":     "Spracuváva...",
            "zeroRecords":    "Žiadne zhodné záznamy",
            "lengthMenu":     "Zobraz _MENU_ výsledkov na stranu",
            "search":         "Hľadaj",
            "info":           "Zobrazené od _START_ do _END_, z _TOTAL_ výsledkov",
            "paginate": {
                "first":      "Prvá",
                "last":       "Posledná",
                "next":       "Nasledujúca",
                "previous":   "Predchádzajúca"
            },
        }
    });
    $('#tableData').css('width','')

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
} );

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
                data[1].style.backgroundColor = '#9dc88d'
            else
                data[1].style.backgroundColor ='red'
            data[1].value =result
        },
        error: function (result) {
            alert('error');
        }
    })
}