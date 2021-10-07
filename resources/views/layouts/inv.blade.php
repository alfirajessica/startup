@extends('head')
<link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
    .navbar{
        background-color:#0a1931;
    }
    .dropdown-menu{
        background-color:#0a1931;
    }
    .landing-page{
        background-color: #EFEFEF;
    }
    .jumbotron {
        background-color: none
    }
    a.list-group-item{
        padding-top: 0rem;
        padding-bottom: 0rem;
    }
    a.list-group-item:hover{
        background-color: #EFEFEF;
    }
    .scroll {
        max-height: 400px;
        overflow-y: auto;
    }
    
  </style>
<body class="landing-page"  data-spy="scroll" data-offset="60" data-target="#navbar-main" id="produk">
  <!-- Navbar -->
  
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
            <img src="/../images/Logo-Startupinow-used.png" class="navbar-brand-img" alt="...">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color: #f7f3e9"></i></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ url('/home') }}">
                            <img src="/../images/Logo-Startupinow-used2.png" class="navbar-brand-img" alt="...">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                    </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('inv.startup') }}">{{ __('Startup') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('valuation') }}">{{ __('Valuation Tools') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
            
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
            <li class="nav-item dropdown dropdown-notifications">
                <a id="NotificationDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    
                    <i data-count="0" class="fa fa-bell" aria-hidden="true"><span class="notif-count badge badge-danger">0</span></i> 
                </a>

                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right scroll" aria-labelledby="NotificationDropdown">
                    <div class="px-3">
                        <h6 class="text-sm">Kamu Memiliki <strong class="text-primary">(<span class="notif-count">0</span>)</strong> Notifikasi.  
                        </h6>
                        <small> <a onclick="mark_all()"> Tandai Semua Telah dibaca</a> </small>
                    </div>

                    <div class="list-group list-group-flush text-dark">

                    </div>
                </div>
            </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('inv.event') }}">
                            <i class="fas fa-calendar-alt"></i>
                            {{ __('Event Saya') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('inv.invest') }}">
                            <i class="ni ni-money-coins"></i>
                            {{ __('Investasi Saya') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('inv.riwayatReview') }}">
                            <i class="ni ni-chat-round"></i>
                            {{ __('Riwayat Ulasan') }}
                        </a>
                        
                        <div class="dropdown-divider"></div>
                       
                        <a class="dropdown-item" href="{{ route('akun') }}">
                            <i class="ni ni-settings"></i>
                            {{ __('Pengaturan Akun') }}
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('users.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                
            @endguest
          </ul>
          
      </div>
      
    </div>
    </nav>
    
    
  <!-- End Navbar -->
 

    <!-- End Navbar -->
    <div class="wrapper">
        <main>
            @if (Route::currentRouteName() == "inv.invest")
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
                <script >
                    var userID = "{{ Auth::user()->id }}";
                    var notifTypeID="";

                    notifTypeID=8;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev2/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                </script>
            @endif
            @if (Route::currentRouteName() == "inv.riwayatReview")
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
                <script >
                    var userID = "{{ Auth::user()->id }}";
                    var notifTypeID="";

                    notifTypeID=7;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev2/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                </script>
            @endif
            @yield('content')
        </main>
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
    {{-- <script> 
        var notificationsWrapper   = $('.dropdown-notifications');
          var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
          var notificationsCountElem = notificationsToggle.find('i[data-count]');
          var notificationsCount     = parseInt(notificationsCountElem.data('count'));
          var notifications          = $('.list-group');
      
          var existingNotifications = notifications.html();
          var newNotificationHtml = "";
          var msg="";
          var page=""
      
          if (notificationsCount <= 0) {
              notificationsWrapper.hide();
          }
      
      
            //get notif from database 
            $.ajax({
              type: "get",
              url: '/invNotification',
              success: function (data) {
                for (let i = 0; i < data.notif.length; i++) {
    
                    var a = moment(); // today
                    var b = moment(data.notif[i]['created_at']); // target date
                    var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
                   
                    var dataID = data.notif[i]['id'];
    
                    if (diffInDays == '0 hari lalu') {
                        diffInDays = "Hari ini";
                    }
                  
                    if (data.notif[i]['id_notif_type'] == 7) {
                        page = "<a  class='list-group-item list-group-item-action devNotif' href='{{ route('inv.riwayatReview') }}' data-id='" + dataID +"'";
                        msg = "Ulasan anda pada <b>" + data.notif[i]['name_product'] + "</b> </br> telah ditanggapi Developer " + data.notif[i]['name_user_fired_event'];
                    }

                    if (data.notif[i]['id_notif_type'] == 8) {
                        page = "<a  class='list-group-item list-group-item-action devNotif' href='{{ route('inv.invest') }}' data-id='" + dataID +"'";
                        msg = "Transaksi investasi pada <b>" + data.notif[i]['name_product'] + "</b> </br> telah dikonfirmasi " + data.notif[i]['name_user_fired_event'];
                    }
    
    
                    newNotificationHtml = page + `
                    <div class="row align-items-center">          
                        <div class="col">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            
                            <label>` + msg + `</label>
                            </div>
                            <div class="text-right text-muted">
                                <small>`+ diffInDays  + `</small>
                            </div>
                        </div>
                        </div>
                    </div>
                    </a>`;
                    
                    notifications.append(newNotificationHtml);
                    notificationsCount += 1;
                    notificationsCountElem.attr('data-count', notificationsCount);
                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                }
                
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
          var channel = pusher.subscribe('inv-notif.' + userID);
          
          channel.bind('App\\Events\\InvestorNotif', function(data) {
          console.log(data.newNotif['id_notif_type']);
          
                var a = moment(); // today
                var b = moment(data.newNotif['created_at']); // target date
                var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
                
                if (diffInDays == '0 hari lalu') {
                    diffInDays = "Hari ini";
                }
              
                if (data.newNotif['id_notif_type'] == 7) {
                    page = "<a class='list-group-item list-group-item-action devNotif' href='{{ route('inv.riwayatReview') }}'";
                    msg = "Ulasan anda pada <b>" + data.startupName + "</b> </br> telah ditanggapi Developer " + data.newNotif['name_user_fired_event'];
                }

                if (data.newNotif['id_notif_type'] == 8) {
                    page = "<a class='list-group-item list-group-item-action devNotif' href='{{ route('inv.invest') }}'";
                    msg = "Transaksi investasi pada <b>" + data.startupName + "</b> </br> telah dikonfirmasi " + data.newNotif['name_user_fired_event'];
                }
      
              newNotificationHtml = page + `
                  <div class="row align-items-center">            
                      <div class="col">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                          <label>`+ msg + `</label>
                          </div>
                          <div class="text-right text-muted">
                          <small>`+ diffInDays  + `</small>
                          </div>
                      </div>
                      </div>
                  </div>
                  </a>`;
              
                notifications.append(newNotificationHtml);
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
          });

    </script>--}}


{{-- <script src="/js/firebase.js"></script> --}}
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

<script>
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = $('.list-group');

    console.log(notificationsCount);
    var existingNotifications = notifications.html();
    var newNotificationHtml = "";
    var msg="";
    var page="";
            
    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }

    call_notif();

    function call_notif() { 
        $.ajax({
            type: "get",
            url: '/invNotification',
            success: function (data) {
            for (let i = 0; i < data.notif.length; i++) {

                var a = moment(); // today
                var b = moment(data.notif[i]['created_at']); // target date
                var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
                
                var dataID = data.notif[i]['id'];

                if (diffInDays == '0 hari lalu') {
                    diffInDays = "Hari ini";
                }
                
                if (data.notif[i]['id_notif_type'] == 7) {
                        page = "<a  class='list-group-item list-group-item-action devNotif' href='{{ route('inv.riwayatReview') }}' data-id='" + dataID +"'";
                        msg = "Ulasan anda pada <b>" + data.notif[i]['name_product'] + "</b> </br> telah ditanggapi Developer " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 8) {
                    page = "<a  class='list-group-item list-group-item-action devNotif' href='{{ route('inv.invest') }}' data-id='" + dataID +"'";
                    msg = "Transaksi investasi pada <b>" + data.notif[i]['name_product'] + "</b> </br> telah dikonfirmasi " + data.notif[i]['name_user_fired_event'];
                }

                newNotificationHtml = page + `
                <div class="row align-items-center">          
                    <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 text-sm">`+ data.notif[i]['name_product'] + `</h6>
                        <label>` + msg + `</label>
                        </div>
                        <div class="text-right text-muted">
                            <small>`+ diffInDays  + `</small>
                        </div>
                    </div>
                    </div>
                </div>
                </a>`;

                
                notifications.append(newNotificationHtml);
                notificationsCount = data.notif.length;
                
            }

            notificationsCount = notificationsCount;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
            
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
     }

                
          
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyBwc8NSTx3jM8dLItdPj3se5UCjFIDUzdU",
        authDomain: "startupinow.firebaseapp.com",
        projectId: "startupinow",
        storageBucket: "startupinow.appspot.com",
        messagingSenderId: "780160674699",
        appId: "1:780160674699:web:456282866792841d649d8e",
        measurementId: "G-HB571HD822"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () { 
                console.log('notification permission granted.');
                return messaging.getToken();
            }).then(function (token) { 
                $('#device_token').val(token);
                $.ajax({
                    type: "get",
                    url: '/home/saveToken' + '/' + token,
                    contentType: "application/json",
                    success: function (response) {
                        console.log('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
                console.log(token);
            }).
            catch(function (err) { 
                console.log('unable to get permission to notify.',err);
            });

    

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            
        };
        console.log('notification firebasejs');
        notifications.empty();
        call_notif();
        new Notification(noteTitle, noteOptions);
    });

    document.addEventListener("visibilitychange", function() {
        console.log( document.visibilityState );
        notifications.empty();
        call_notif();
    });

    function mark_all() { 
        var userID = "{{ Auth::user()->id }}";
        $.ajax({
            type: "get",
            url: '/mark_all_inv/'+userID,
            success: function (data) {
            console.log("ok");
            notificationsCount = 0;
            notifications.empty();
            call_notif();
            }
        });
     }

</script>
</body>
</html>

