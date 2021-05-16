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
    //pridanie testu
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
    //zobrazovanie inputov pre odpovede
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
    //pridanie otazok
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
                            $('#questionsOverview > tbody:last-child').append(getQuestionsOverviewTableRow($('#question').val(), 'Otvorená odpoveď',$('#answer-1-1').val(),''));
                            $('#question').val('');
                            $('#questionShort input[type="text"]').val('');

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
                        $('#questionsOverview > tbody:last-child').append(getQuestionsOverviewTableRow($('#question').val(),'Možnosti',$('#answer-2-1').val(),
                            $('#answer-2-2').val()+', '+$('#answer-2-3').val()+', '+$('#answer-2-4').val()));
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
                       /* $('#questionsOverview > tbody:last-child').append(getQuestionsOverviewTableRow($('#question').val(),'Možnosti',$('#answer-2-1').val(),
                            $('#answer-2-2').val()+', '+$('#answer-2-3').val()+', '+$('#answer-2-4').val()));*/
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
                        var type
                        if($('#questionType').val()==5)
                            type = 'Matematický výraz'
                        else type = 'Kreslenie'
                        $('#questionsOverview > tbody:last-child').append(getQuestionsOverviewTableRow($('#question').val(),type,'',''));
                        console.log(result)
                        $('#question').val('');
                    }
                })
            }
        }
    })

})
;

function getQuestionsOverviewTableRow(question, type, correct, incorrect){
    return '<tr><td>'+question+'</td><td>'+type+'</td><td>'+correct+'</td><td>'+incorrect+'</td><input type="button" class="btn btn-login btn-table" value="Vymazať" onclick="deleteQuestion()"></tr>'
}

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
        url: 'routes/TestControler.php/changeActivity?code=' + code + '&activity=' + activity,
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
        url: 'routes/TestControler.php/deleteTest?code=' + code,
        success: function (result) {
            $('table#tableTest tr#' + code).remove();
        },
        error: function (result) {
            alert('error: ' + result);
        }
    })
}
function deleteQuestion() {
    let searchParams = new URLSearchParams(window.location.search)
    var code = event.target.parentNode.parentNode.id;
    console.log(code)
    $.ajax({
        type: 'DELETE',
        url: 'routes/TestControler.php/deleteQuestion?question=' + code + '&code=' + searchParams.get('code'),
        success: function (result) {
            console.log(result)
            $('table#questionsOverview tr#' + code).remove();
        },
        error: function (result) {
            alert('error: ' + result);
        }
    })
}
function changePoints(){
    var code = event.target.parentNode.parentNode.id;
    console.log(code)
    $.ajax({
        type: 'PUT',
        url: 'routes/TestControler.php/changePoints?answer='+code,
        success: function (result) {
            console.log(result)
            //$('table#questionsOverview tr#' + code).remove();
        },
        error: function (result) {
            alert('error: ' + result);
        }
    })
}