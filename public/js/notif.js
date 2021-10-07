
$(function () {
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = $('.list-group');

    var existingNotifications = notifications.html();
    var newNotificationHtml = "";

    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }


    //get notif from database 
    $.ajax({
        type: "get",
        url: '/notification',
        success: function (data) {
            
            $.each(data, function(i, obj) {
                console.log(obj['id']);
                
                newNotificationHtml = `
                <a href="" class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    
                    <div class="col ml--2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                        <h6 class="mb-0 text-sm">`+ obj['id'] + `</h6>
                        <label>`+ obj['id'] + `</label>
                        </div>
                        <div class="text-right text-muted">
                        <small>`+ moment(obj['created_at']).format('DD-MMM-YYYY')  + `</small>
                        </div>
                    </div>
                    </div>
                </div>
                </a>`;
    
                $('.list-group').append(newNotificationHtml);
                notifications.html(newNotificationHtml + existingNotifications);
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
                
            });
            
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

    



    //Remember to replace key and cluster with your credentials.
    var pusher = new Pusher('7ccfa9bcb981ff489c7a', {
        cluster: 'ap1',
        encrypted: false
    });

    //Also remember to change channel and event name if your's are different.
    var userID = "{{ Auth::user()->id }}";
    var channel = pusher.subscribe('investor-review.' + userID);
    
    channel.bind('App\\Events\\InvestorReview', function(data) {
    console.log(data.newNotif['id_notif_type']);
    
       

        //investor memberikan review
        if (data.newNotif['id_notif_type'] == 1) {
            $("a.list-group-item list-group-item-action").prop("href", "{{ route('dev.product') }}")
        }

        newNotificationHtml = `
            <a href="" class="list-group-item list-group-item-action">
            <div class="row align-items-center">
                
                <div class="col ml--2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                    <h6 class="mb-0 text-sm">`+ data.startupName + `</h6>
                    <label>`+ data.message + `</label>
                    </div>
                    <div class="text-right text-muted">
                    <small>`+ moment(data.newNotif['created_at']).format('DD-MMM-YYYY')  + `</small>
                    </div>
                </div>
                </div>
            </div>
            </a>`;
        

        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });


});

    

    

    
