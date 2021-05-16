function sendTest(){
    $.ajax({
        type: 'PUT',
        url: 'routes/notificationController.php/?code=' + searchParams.get('code') + '&sendTest=yes',
        success: function (result) {
            console.log("odovzdal som test")
            console.log(result)
        }
    })
}

let searchParams = new URLSearchParams(window.location.search)
document.addEventListener("visibilitychange", function () {
    if (document.visibilityState == "hidden") {
        $.ajax({
            type: 'PUT',
            url: 'routes/notificationController.php/?code=' + searchParams.get('code') + '&visibility=hidden',
            success: function (result) {
                console.log("zavolal som hidden")
            }
        })
    } else if (document.visibilityState == "visible") {
        $.ajax({
            type: 'PUT',
            url: 'routes/notificationController.php/?code=' + searchParams.get('code') + '&visibility=visible',
            success: function (result) {
                console.log("zavolal som visible")
            }
        })
    }
})

window.addEventListener('beforeunload', function (event){
    //event.returnValue = 'true';
    $.ajax({
        type: 'PUT',
        url: 'routes/notificationController.php/?code=' + searchParams.get('code') + '&closeWindow=1',
        success: function (result) {
            console.log("zatvoril som okno")
        }
    })


})