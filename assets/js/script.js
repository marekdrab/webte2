$(document).ready(function () {
    $('#tableData').DataTable({
        "language": {
            "decimal": "",
            "emptyTable": "Dáta nie sú dostupné",
            "infoEmpty": "Zobrazené od 0 do 0 z 0 výsledkov",
            "infoFiltered": "(filtrované z _MAX_ všetkých záznamov)",
            "infoPostFix": "",
            "thousands": ",",
            "loadingRecords": "Načitáva...",
            "processing": "Spracuváva...",
            "zeroRecords": "Žiadne zhodné záznamy",
            "lengthMenu": "Zobraz _MENU_ výsledkov na stranu",
            "search": "Hľadaj",
            "info": "Zobrazené od _START_ do _END_, z _TOTAL_ výsledkov",
            "paginate": {
                "first": "Prvá",
                "last": "Posledná",
                "next": "Nasledujúca",
                "previous": "Predchádzajúca"
            },
        }
    });
    $('#tableData').css('width', '')

    $('#addTest').click(function () {
        var error = false
        if ($('#name').val() == '') {
            error = true
            $('#nameError').text('Meno je prázdne')
        }
        if ($('#timeLimit').val() == '') {
            error = true
            $('#timeError').text('Čas je prázdny')
        }
        if (!error)
            $.ajax({
                type: 'POST',
                url: 'routes/TestControler.php/test',
                data: {
                    name: $('#name').val(),
                    timeLimit: $('#timeLimit').val(),
                },
                success: function (result) {
                    console.log(result)
                    window.location.replace('testOverview.php?code=' + parseInt(result))
                },
                error: function (result) {
                    alert('error: ' + result);
                }
            })
    })
    $('#questionType').change(function () {
        if ($('#questionType').val() == 1)
            $('#questionShort').css('display', 'block')
        else
            $('#questionShort').css('display', 'none')
        if ($('#questionType').val() == 2)
            $('#questionChoices').css('display', 'block')
        else
            $('#questionChoices').css('display', 'none')
        if ($('#questionType').val() == 3)
            $('#questionPairs').css('display', 'flex')
        else
            $('#questionPairs').css('display', 'none')
        if ($('#questionType').val() == 4)
            $('#questionDrawing').css('display', 'block')
        else
            $('#questionDrawing').css('display', 'none')
        if ($('#questionType').val() == 5)
            $('#questionMaths').css('display', 'block')
        else
            $('#questionMaths').css('display', 'none')

    })
    $('#addQuestion').click(function () {
        let searchParams = new URLSearchParams(window.location.search)
        if ($('#question').val() == '') {
            $('#questionError').text('Nebola zadaná otázka')
        } else {
            if ($('#questionType').val() == 1) {
                if ($('#answer-1-1').val() == '') {
                    $('#answer-1-1-error').text('Nebola zadaná odpoveď')
                } else {
                    $('#answer-1-1-error').text('')

                    $.ajax({
                        type: 'POST',
                        url: 'routes/TestControler.php/question/1',
                        data: {
                            code: searchParams.get('code'),
                            question: $('#question').val(),
                            answer: $('#answer-1-1').val()
                        },
                        success: function (result) {
                            console.log(result)
                            $('#questionShort input[type="text"]').val('');
                            $('#question').val('');
                        }
                    })
                }
            }
            if ($('#questionType').val() == 2) {
                if ($('#answer-2-1').val() == '') {
                    $('#answer-2-1-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-2-1-error').text('')
                }
                if ($('#answer-2-2').val() == '') {
                    $('#answer-2-2-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-2-2-error').text('')
                }
                if ($('#answer-2-3').val() == '') {
                    $('#answer-2-3-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-2-3-error').text('')
                }
                if ($('#answer-2-4').val() == '') {
                    $('#answer-2-4-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-2-4-error').text('')
                }
                $.ajax({
                    type: 'POST',
                    url: 'routes/TestControler.php/question/2',
                    data: {
                        code: searchParams.get('code'),
                        question: $('#question').val(),
                        correct_answer: $('#answer-2-1').val(),
                        answer_0: $('#answer-2-2').val(),
                        answer_1: $('#answer-2-3').val(),
                        answer_2: $('#answer-2-4').val(),
                    },
                    success: function (result) {
                        $('#questionChoices input[type="text"]').val('');
                        $('#question').val('');
                        console.log(result)
                    }
                })
            }
            if ($('#questionType').val() == 3) {
                if ($('#match-3-1').val() == '') {
                    $('#match-3-1-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#match-3-1-error').text('')
                }
                if ($('#match-3-2').val() == '') {
                    $('#match-3-2-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#match-3-2-error').text('')
                }
                if ($('#match-3-3').val() == '') {
                    $('#match-3-3-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#match-3-3-error').text('')
                }
                if ($('#match-3-4').val() == '') {
                    $('#match-3-4-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#match-3-4-error').text('')
                }
                if ($('#answer-3-1').val() == '') {
                    $('#answer-3-1-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-3-1-error').text('')
                }
                if ($('#answer-3-2').val() == '') {
                    $('#answer-3-2-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-3-2-error').text('')
                }
                if ($('#answer-3-3').val() == '') {
                    $('#answer-3-3-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-3-3-error').text('')
                }
                if ($('#answer-3-4').val() == '') {
                    $('#answer-3-4-error').text('Nebola zadaná odpoveď')
                    return
                } else {
                    $('#answer-3-4-error').text('')
                }
                $.ajax({
                    type: 'POST',
                    url: 'routes/TestControler.php/question/3',
                    data: {
                        code: searchParams.get('code'),
                        question: $('#question').val(),
                        match_0: $('#match-3-1').val(),
                        match_1: $('#match-3-2').val(),
                        match_2: $('#match-3-3').val(),
                        match_3: $('#match-3-4').val(),
                        answer_0: $('#answer-3-1').val(),
                        answer_1: $('#answer-3-2').val(),
                        answer_2: $('#answer-3-3').val(),
                        answer_3: $('#answer-3-4').val(),
                    },
                    success: function (result) {
                        console.log(result)
                        $("#questionType option[value='3']").remove();
                        $('#questionPairs input[type="text"]').val('');
                        $('#question').val('');
                    }
                })
            }
            if ($('#questionType').val() == 4 || $('#questionType').val() == 5) {
                $.ajax({
                    type: 'POST',
                    url: 'routes/TestControler.php/question/' + $('#questionType').val(),
                    data: {
                        code: searchParams.get('code'),
                        question: $('#question').val(),
                    },
                    success: function (result) {
                        console.log(result)
                        $('#question').val('');
                    }
                })
            }
        }
    })
})
;

function changeActivity() {
    var rowId = event.target.parentNode.parentNode.id;
    var data = document.getElementById(rowId).querySelectorAll(".row-data");
    var code = data[0].innerHTML;
    var activity = data[1].value;
    if (activity == 0)
        activity = 1
    else activity = 0
    $.ajax({
        type: 'PUT',
        url: 'routes/TestControler.php/change?code=' + code + '&activity=' + activity,
        success: function (result) {
            if (result == 1)
                data[1].style.backgroundColor = '#9dc88d'
            else
                data[1].style.backgroundColor = 'red'
            data[1].value = result
        },
        error: function (result) {
            alert('error: ' + result);
        }
    })
}

function deleteTest() {
    var code = event.target.parentNode.parentNode.id;
    $.ajax({
        type: 'DELETE',
        url: 'routes/TestControler.php?code=' + code,
        success: function (result) {
            $('table#tableData tr#' + code).remove();
        },
        error: function (result) {
            alert('error: ' + result);
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
            curviness: 50
        }],
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
            curviness: 50
        }],
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
    jQuery("#select-list-matches ul > li").click(function () {

        //remove endpoint if there is one
        if (questionSelected !== null) {
            jsPlumb.deleteEndpoint(questionEndpoint);
        }

        //add new endpoint
        questionSelected = jQuery(this);
        questionEndpoint = jsPlumb.addEndpoint(questionSelected, sourceOption);
    });

    //now click on an answer to link it with previously selected question
    jQuery("#select-list-answers ul > li").click(function () {

        //we must have previously selected question
        //for this to work
        if (questionSelected !== null) {
            //create endpoint
            var answer = jsPlumb.addEndpoint(jQuery(this)[0], targetOption);

            //link it

            if (!targets.includes(answer['anchor']['elementId']) && !sources.includes(questionEndpoint['anchor']['elementId'])) {
                jsPlumb.connect({source: questionEndpoint, target: answer});
                sources.push(questionEndpoint['anchor']['elementId']);
                targets.push(answer['anchor']['elementId']);
            } else {
                if (questionSelected !== null) {
                    jsPlumb.deleteEndpoint(questionEndpoint);
                    jsPlumb.deleteEndpoint(answer);
                }
            }
            //cleanup
            questionSelected = null;
            questionEndpoint = null;
        }
    });
});

function clearConnections() {
    jsPlumb.deleteEveryEndpoint();
    sources = [];
    targets = [];
}

function points3rdQuestion() {
    var match1 = document.getElementById('match1').innerText;
    var match2 = document.getElementById('match2').innerText;
    var match3 = document.getElementById('match3').innerText;
    var match4 = document.getElementById('match4').innerText;

    var answer1 = document.getElementById('answer1').innerText;
    var answer2 = document.getElementById('answer2').innerText;
    var answer3 = document.getElementById('answer3').innerText;
    var answer4 = document.getElementById('answer4').innerText;

    var pairs = [match1 + answer1, match2 + answer2, match3 + answer3, match4 + answer4];

    var points = 0;
    for (var i = 0; i < sources.length; i++) {
        if (pairs.includes(document.getElementById(sources[i]).innerText + document.getElementById(targets[i]).innerText)) {
            points += 0.25;
        }
    }
    document.getElementById('points-question3').value = points;
}

