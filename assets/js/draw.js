var myBoard = new DrawingBoard.Board('board');
var img = myBoard.getImg();

function sendCanva(element){
    //get drawingboard content
    var img = myBoard.getImg();

    //we keep drawingboard content only if it's not the 'blank canvas'
    var imgInput = (myBoard.blankCanvas == img) ? '' : img;

    //put the drawingboard content in the form field to send it to the server

    console.log(imgInput);

    $.ajax({
        type: "POST",
        url: "sendCanva.php",
        data: {
            image : imgInput
        },
        success: function(data)
        {
            console.log(data);
            myBoard.clearWebStorage();

        }
    });
