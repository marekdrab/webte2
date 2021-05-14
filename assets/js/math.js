var MQ = MathQuill.getInterface(2);
var htmlElement = document.getElementById('some_id');
var config = {
    restrictMismatchedBrackets: true
};
var mathField = MQ.MathField(htmlElement, config);

var enteredMath = mathField.latex();

function input(str) {
    mathField.cmd(str)
    mathField.focus()
}
function sendLatex(element){
    var text = element.previousSibling.previousSibling;//.previousSibling.previousSibling.innerText
    mathField = MQ.MathField(text, config);
    text = mathField.latex()
    $.ajax({
        type: "POST",
        url: "latex.php",
        data: {latex : text}, // serializes the form's elements.
        success: function(data)
        {
            console.log(data);
            //we can also assume that everything goes well server-side
            //and directly clear webstorage here so that the drawing isn't shown again after form submission
            //but the best would be to do when the server answers that everything went well
        }
    });
}
