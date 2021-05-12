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
sources = [];
targets = [];

jQuery(document).ready(function () {
    var targetOption = {
        anchor: "LeftMiddle",
        maxConnections: 1,
        isSource: false,
        isTarget: true,
        reattach: true,
        endpoint: "Dot",
        connector: ["Bezier", {
            curviness: 50}],
        setDragAllowedWhenFull: true
    };

    var sourceOption = {
        tolerance: "touch",
        anchor: "RightMiddle",
        maxConnections: 1,
        isSource: true,
        isTarget: false,
        reattach: true,
        endpoint: "Dot",
        connector: ["Bezier", {
            curviness: 50}],
        setDragAllowedWhenFull: true
    };

    jsPlumb.importDefaults({
        ConnectionsDetachable: true,
        ReattachConnections: true,
        maxConnections: 1,
        Container: 'page_connections'
    });

    //current question clicked on
    var questionSelected = null;
    var questionEndpoint = null;

    //remember the question you clicked on
    jQuery("#select_list_lebensbereiche ul > li").click( function () {

        //remove endpoint if there is one
        if( questionSelected !== null )
        {
            jsPlumb.deleteEndpoint(questionEndpoint);
            console.log('deleted');
        }

        //add new endpoint
        questionSelected = jQuery(this);
        questionEndpoint = jsPlumb.addEndpoint(questionSelected, sourceOption);
    });

    //now click on an answer to link it with previously selected question
    jQuery("#select_list_wirkdimensionen ul > li").click( function () {

        //we must have previously selected question
        //for this to work
        if( questionSelected !== null )
        {
            //create endpoint
            var answer = jsPlumb.addEndpoint(jQuery(this)[0], targetOption);

            //link it

            if (!targets.includes(answer['anchor']['elementId']) && !sources.includes(questionEndpoint['anchor']['elementId'])) {
                jsPlumb.connect({source: questionEndpoint, target: answer});
                sources.push(questionEndpoint['anchor']['elementId']);
                targets.push(answer['anchor']['elementId']);
            }
            else{
                if( questionSelected !== null )
                {
                    jsPlumb.deleteEndpoint(questionEndpoint);
                    jsPlumb.deleteEndpoint(answer);
                    console.log('deleted');
                }
            }
            //cleanup
            questionSelected = null;
            questionEndpoint = null;
            console.log(sources);
            console.log(targets);
        }
    });
});

function clearConnections(){
    jsPlumb.deleteEveryEndpoint();
    sources = [];
    targets = [];
}