
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
    let i;
    for (i = 0; i < sources.length; i++) {
        if (pairs.includes(document.getElementById(sources[i]).innerText + document.getElementById(targets[i]).innerText)) {
            points += 0.25;
        }
    }
    var submittedAnswer = points + "|";
    for (i = 0; i < sources.length; i++){
        submittedAnswer = submittedAnswer + document.getElementById(sources[i]).innerText + "~";
    }
    submittedAnswer = submittedAnswer.slice(0, -1);
    submittedAnswer = submittedAnswer + "&";
    for (i = 0; i < targets.length; i++){
        submittedAnswer = submittedAnswer + document.getElementById(targets[i]).innerText + "~";
    }
    submittedAnswer = submittedAnswer.slice(0, -1);
    document.getElementById('points-question3').value = submittedAnswer;
}

