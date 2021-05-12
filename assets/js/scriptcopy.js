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