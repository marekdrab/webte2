//javascript code that intercepts form submission to add drawingboard content to the form data sent to the server

var myBoard = new DrawingBoard.Board('board');

$('.drawing-form').on('submit', function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    console.log(form.serialize());

    //get drawingboard content
    var img = myBoard.getImg();

    //we keep drawingboard content only if it's not the 'blank canvas'
    var imgInput = (myBoard.blankCanvas == img) ? '' : img;

    //put the drawingboard content in the form field to send it to the server

    $(this).find('input[name=image]').val( imgInput );

    $.ajax({
        type: "POST",
        url: "sendCanva.php",
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            console.log(data);
            myBoard.clearWebStorage();

        }
    });


});

