event_hasPassed();

function event_hasPassed() {  
    $.ajax({
        type: "get",
        url: url_eventPassed,
        success: function (data) {
            console.log('ok');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  }