//javascript code that intercepts form submission to add drawingboard content to the form data sent to the server

var myBoard = new DrawingBoard.Board('board');
var img = myBoard.getImg();

function sendCanva(element, name, surname){
    //get drawingboard content
    var img = myBoard.getImg();

    //we keep drawingboard content only if it's not the 'blank canvas'
    var imgInput = (myBoard.blankCanvas == img) ? '' : img;

    //put the drawingboard content in the form field to send it to the server

    //vypis obsahu .png suboru
    // console.log(imgInput);

    $.ajax({
        type: "POST",
        url: "sendCanva.php",
        data: {
            image : imgInput,
            name: name,
            surname: surname
        },
        success: function(data)
        {
            //data je nazov .png suboru
            //toto ukladame do hidden fieldu v test.php
            // console.log(data);
            var input = document.getElementById("points-question4").value = data;
            myBoard.clearWebStorage();

        }
    });


}
