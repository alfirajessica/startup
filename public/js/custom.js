
$(function () {
    event_hasPassed();
});

//function dimana akan mengubah status pada tabel header_events
//jika header telah melewati masa akan diadakan event
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