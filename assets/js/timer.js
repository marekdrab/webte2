function getTime(){
    $.ajax({
        type:'GET',
        url:'routes/TestControler.php/timer?time='+$('#minutes').text(),
        success: function (result){
            var time = JSON.parse(result)
            setTimeout(function () {
                var minutes = time[0]
                var secs = time[1]
                if(minutes == 0 && secs == 0){
                    $('form#testForm').submit()
                    sendTest()
                }
                if(minutes <10)
                    minutes = '0'+time[0]
                if(secs <10)
                    secs = '0'+time[1]
                $('#countdown').text(minutes+':'+secs)
                getTime()
            }, 1000);
        }
    })
}
getTime()