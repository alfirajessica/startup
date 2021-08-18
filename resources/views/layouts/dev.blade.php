@extends('head')
<link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
    .navbar{
        
        background-color:#0A1931;
    }
    .dropdown-menu{
        background-color:#0a1931;
    }
    .landing-page{
        background-color: #EFEFEF;
    }
    .jumbotron {
        background-image: none
    }
    .navbar-brand-img {
        height: 80px;
        width: 100px;
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
<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
          <img src="/../images/Logo-Startupinow-used.png" class="navbar-brand-img" alt="..." >
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
                    <a class="nav-link text-white" href="{{ route('dev.event') }}">{{ __('Event') }}</a>
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
                            <h6 class="text-sm">Kamu memiliki <strong class="text-primary">(<span class="notif-count">0</span>)</strong> Notifikasi.</h6>
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
                        <a href="{{ route('dev.product') }}" class="dropdown-item">
                            <i class="ni ni-collection"></i>
                            <span>{{ __('Startup/Produk Saya') }}</span>
                        </a>

                        <a href="{{ route('dev.listJoinEvent') }}" class="dropdown-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ __('Riwayat Event') }}</span>
                        </a>

                        <a href="{{ route('akun') }}" class="dropdown-item">
                            <i class="ni ni-settings"></i>
                            <span>{{ __('Pengaturan Akun') }}</span>
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
    <div class="wrapper">
        
        <main >
            @if (Route::currentRouteName() == "dev.product")
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
                <script >
                    var userID = "{{ Auth::user()->id }}";
                    var notifTypeID="";

                    notifTypeID=1;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                    notifTypeID = 2;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                    notifTypeID = 3;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                    notifTypeID = 4;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                    notifTypeID = 6;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                    notifTypeID = 8;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
                        success: function (data) {
                        console.log("ok");
                        }
                    });

                    notifTypeID = 9;
                    $.ajax({
                        type: "get",
                        url: '/markReadReviewDev/'+userID+'/'+notifTypeID,
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
<script>
    var notificationsWrapper   = $('.dropdown-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = notificationsToggle.find('i[data-count]');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = $('.list-group');
  
      var existingNotifications = notifications.html();
      var newNotificationHtml = "";
      var msg="";
      var page="";
  
      if (notificationsCount <= 0) {
          notificationsWrapper.hide();
      }
  
      //get notif from database 
      $.ajax({
          type: "get",
          url: '/devNotification',
          success: function (data) {
            for (let i = 0; i < data.notif.length; i++) {

                var a = moment(); // today
                var b = moment(data.notif[i]['created_at']); // target date
                var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
               

                if (diffInDays == '0 hari lalu') {
                    diffInDays = "Hari ini";
                }
                page = "<a href='{{ route('dev.product') }}' class='list-group-item list-group-item-action devNotif'>";
                if (data.notif[i]['id_notif_type'] == 1) {
                    msg = "Menerima Ulasan Startup dari " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 2) {
                    msg = "Sedang dalam tahap diinvestasikan oleh " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 3) {
                    msg = "Investasi dibatalkan oleh Investor " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 4) {
                    msg = "Menerima Ulasan Investasi dari " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 6) {
                    msg = "Startup telah dikonfirmasi oleh " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 8) {
                    msg = "Menerima Investasi dari Investor " + data.notif[i]['data'];
                }

                if (data.notif[i]['id_notif_type'] == 9) {
                    msg = "Startup Tidak Dikonfirmasi oleh " + data.notif[i]['name_user_fired_event'];
                }

                newNotificationHtml = page +`
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
      var channel = pusher.subscribe('dev-notif.' + userID);
      
      channel.bind('App\\Events\\DevNotif', function(data) {
      console.log(data.newNotif['id_notif_type']);
      
            var a = moment(); // today
            var b = moment(data.newNotif['created_at']); // target date
            var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
            
            if (diffInDays == '0 hari lalu') {
                diffInDays = "Hari ini";
            }

            page = "<a href='{{ route('dev.product') }}' class='list-group-item list-group-item-action devNotif'>";

          //investor memberikan review
            if (data.newNotif['id_notif_type'] == 1) {
                msg = "Menerima Ulasan Startup dari " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 2) {
                msg = "Sedang dalam tahap diinvestasikan oleh " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 3) {
                msg = "Investasi dibatalkan oleh Investor " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 4) {
                msg = "Menerima Ulasan Investasi dari " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 6) {
                msg = "Startup telah dikonfirmasi oleh " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 8) {
                msg = "Menerima Investasi dari Investor " + data.newNotif['data'];
            }

            if (data.newNotif['id_notif_type'] == 9) {
                msg = "Startup Tidak Dikonfirmasi oleh " + data.newNotif['name_user_fired_event'];
            }
  
          newNotificationHtml = page + `
              <div class="row align-items-center">
                  <div class="col">
                  <div class="d-flex justify-content-between align-items-center">
                      <div>
                      <h6 class="mb-0 text-sm">`+ data.startupName + `</h6>
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
</script>
  

</body>
 
</html>
