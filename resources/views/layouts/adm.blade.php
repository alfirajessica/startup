
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
  <title>{{ config('app.name', 'StartupINow.') }}</title>
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

  <link rel="stylesheet" href="/../assets/css/argon.css?v=1.2.0" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
 
   {{-- notif with firebase --}}
   <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
   <link rel="manifest" href="manifest.json">

   <style>
     .navbar-vertical.navbar-expand-xs .navbar-nav > .nav-item > .nav-link.active{
       background: #06325e;
     }
     .landing-page{
        background-color: #EFEFEF;
    }
    a.list-group-item{
        padding-top: 0rem;
        padding-bottom: 0rem;
    }
   </style>

</head>

<body class="landing-page">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left  navbar-expand-xs" id="sidenav-main" style="background-color: #0a1931">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
          <img src="/../images/Logo-Startupinow-used.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text ">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="produk_kategori" href="{{ route('admin.kategoriProduk') }}" title="Produk Kategori">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ __('Produk Kategori') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="type_trans" href="{{ route('admin.typeTrans') }}" title="Tipe Transaksi">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ __('Tipe Transaksi') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="startup_tag" href="{{ route('admin.startupTags') }}" title="Startup Tags">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ __('Startup Tags') }}</span>
              </a>
            </li>
          </ul>

          <!-- Divider -->
          <hr class="my-2">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-white">
            <span class="docs-normal">DEVELOPER</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="produk_terbaru" href="{{ route('admin.dev.produkDev')}}" title="Produk Terbaru">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Produk Terbaru</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="produk_terdata" href="{{ route('admin.dev.allListProduct')}}" title="Produk Terdata">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Produk Terdata</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="list_dev" href="{{ route('admin.dev.listDev')}}" title="Daftar Developer">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Daftar Developer</span>
              </a>
            </li>
          </ul>

          <hr class="my-1">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-white">
            <span class="docs-normal">INVESTOR</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="list_inv" href="{{ route('admin.inv.listInv')}}" title="Daftar Investor">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Daftar Investor</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="list_trans" href="{{ route('admin.inv.transaksiInv')}}" title="Transaksi">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Transaksi</span>
              </a>
            </li>
          </ul>

          <hr class="my-0">
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="laporan_admin" href="{{ route('admin.report')}}" title="Laporan">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>
          </ul>

          <hr class="my-0">
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="pengaturan_akun" href="{{ route('admin.akun')}}" title="Pengaturan Akun">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Pengaturan Akun</span>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand" style="background-color: #0a1931">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          
          <!-- Navbar links -->

          <ul class="navbar-nav">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="fas fa-bars" style="color: #f7f3e9"></i>
                </div>
              </div>
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
                      
                      <i data-count="0" class="fa fa-bell" aria-hidden="true"><span class="notif-count badge badge-danger"></span></i> 
                  </a>

                  <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" aria-labelledby="NotificationDropdown">
                    

                      <div class="px-3 py-3 list-group list-group-flush">

                      </div>
                     
                  </div>
              </li>

                <li class="nav-item dropdown" >
                  <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre=""> {{ Auth::user()->name }}
                  </a>
                  
                    <div class="dropdown-menu dropdown-menu-right">
                      {{-- <a href="{{ route('admin.akun') }}" class="dropdown-item" id="pengaturan_akun" title="Pengaturan Akun">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Pengaturan Akun') }}</span>
                      </a> --}}
                      
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
    
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header" style="background-color: #0a1931">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-2">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-2">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page" id="now_path">
                    {{-- {{request()->segment(count(request()->segments()))}} -  --}}
                  </li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class=" col ">
          <main role="main">
            @yield('content')
          </main>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  {{-- <script src="/../assets/vendor/jquery/dist/jquery.min.js"></script> --}}
  <script src="/../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="/../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="/../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="/../assets/js/argon.js?v=1.2.0"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script type="text/javascript"  src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  
   <!-- Sweet alert -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script>
    $("#dashboard").addClass('active');
    var getID = $("li").find(".active").attr('title');
    console.log(getID);
    $("#now_path").text(getID);
  </script>

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
   
    call_notif();
   
    function call_notif() { 
        $.ajax({
            type: "get",
            url: '/adminNotification',
            success: function (data) {
              if (data == 0) {
                console.log('kosong');
              }
              else{
                console.log(data[0]);
                newNotificationHtml = page + `
                  <div class="row align-items-center">          
                      <div class="col">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h6 class="mb-0 text-sm"> Terdapat `+ data[0]['idlist_invest'] + ` Transaksi Investasi Startup butuh dikonfirmasi </h6>
                          
                          </div>
                          <div class="text-right text-muted">
                              <small>`+ ''  + `</small>
                          </div>
                      </div>
                      </div>
                    </div>
                    </a>`;
              
                  notifications.append(newNotificationHtml);
                  notificationsCount = notificationsCount;
                  notificationsCountElem.attr('data-count', notificationsCount);
                  notificationsWrapper.find('.notif-count').text(notificationsCount);
                  notificationsWrapper.show();
              }
            },
            
            error: function (data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            type: "get",
            url: '/adminNotificationlistProduct',
            success: function (data) {

              if (data == 0) {
                console.log('kosong2');
              }else{
                console.log(data[0]['idlist_project']);
              newNotificationHtml = page + `
                <div class="row align-items-center">          
                    <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 text-sm"> Terdapat `+ data[0]['idlist_project'] + ` Startup butuh dikonfirmasi</h6>
                      
                        </div>
                        <div class="text-right text-muted">
                            <small>`+ ''  + `</small>
                        </div>
                    </div>
                    </div>
                  </div>
                </a>`;
            
                notifications.append(newNotificationHtml);
                notificationsCount = notificationsCount;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
              }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
     }
  
    document.addEventListener("visibilitychange", function() {
        console.log( document.visibilityState );
        notifications.empty();
        call_notif();
    });

</script>
</body>

</html>

{{-- <script>
    var notificationsWrapper   = $('.dropdown-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = notificationsToggle.find('i[data-count]');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = $('.list-group');
  
      var existingNotifications = notifications.html();
      var newNotificationHtml = "";
      var msg=-"";
  
      if (notificationsCount <= 0) {
          notificationsWrapper.hide();
      }
  
  
      //get notif from database 
      $.ajax({
          type: "get",
          url: '/adminNotification',
          success: function (data) {
            for (let i = 0; i < data.notif.length; i++) {

                var a = moment(); // today
                var b = moment(data.notif[i]['created_at']); // target date
                var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
               

                if (diffInDays == '0 hari lalu') {
                    diffInDays = "Hari ini";
                }
              
                if (data.notif[i]['id_notif_type'] == 1) {
                    $("list-group").prop("href", "{{ route('dev.product') }}");
                    msg = "Menerima Ulasan Startup dari " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 2) {
                    $("list-group").prop("href", "{{ route('dev.product') }}");
                    msg = "Sedang dalam tahap diinvestasikan oleh " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 3) {
                    $("list-group").prop("href", "{{ route('dev.product') }}");
                    msg = "Investasi dibatalkan oleh Investor " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 4) {
                    $("list-group").prop("href", "{{ route('dev.product') }}");
                    msg = "Menerima Ulasan Investasi dari " + data.notif[i]['name_user_fired_event'];
                }

                if (data.notif[i]['id_notif_type'] == 8) {
                    $("list-group").prop("href", "{{ route('dev.product') }}");
                    msg = "Menerima Investasi dari Investor " + data.notif[i]['data'];
                }

                newNotificationHtml = `
                <a href="{{ route('dev.product') }}" class="list-group-item list-group-item-action">
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
      var channel = pusher.subscribe('investor-review.' + userID);
      
      channel.bind('App\\Events\\InvestorReview', function(data) {
      console.log(data.newNotif['id_notif_type']);
      
            var a = moment(); // today
            var b = moment(data.newNotif['created_at']); // target date
            var diffInDays = a.diff(b, 'days') + ' hari lalu'; // 36d;
            
            if (diffInDays == '0 hari lalu') {
                diffInDays = "Hari ini";
            }

          //investor memberikan review
            if (data.newNotif['id_notif_type'] == 1) {
                $("list-group").prop("href", "{{ route('dev.product') }}");
                msg = "Menerima Ulasan Startup dari " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 2) {
                $("list-group").prop("href", "{{ route('dev.product') }}");
                msg = "Sedang dalam tahap diinvestasikan oleh " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 3) {
                $("list-group").prop("href", "{{ route('dev.product') }}");
                msg = "Investasi dibatalkan oleh Investor " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 4) {
                $("list-group").prop("href", "{{ route('dev.product') }}");
                msg = "Menerima Ulasan Investasi dari " + data.newNotif['name_user_fired_event'];
            }

            if (data.newNotif['id_notif_type'] == 8) {
                $("list-group").prop("href", "{{ route('dev.product') }}");
                msg = "Menerima Investasi dari Investor " + data.newNotif['data'];
            }
  
          newNotificationHtml = `
              <a href="" class="list-group-item list-group-item-action">
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
</script> --}}
  