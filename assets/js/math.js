var htmlElement = document.getElementById('some_id');
var config = {
    handlers: { edit: function(){ console.log('X') } },
    restrictMismatchedBrackets: true
};
var mathField = MQ.MathField(htmlElement, config);

// mathField.typedText('2^{\\frac{3}{2}}'); // Renders the given LaTeX in the MathQuill field
var enteredMath = mathField.latex(); // => '2^{\\frac{3}{2}}'
// console.log(htmlElement.textContent = enteredMath;) // simple API)

function input(str) {
    mathField.cmd(str)
    mathField.focus()
}

$('.latex-form').on('submit', function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var text = mathField.latex()
    console.log(text);

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
})