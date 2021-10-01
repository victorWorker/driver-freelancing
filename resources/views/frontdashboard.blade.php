<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="facebook-domain-verification" content="e04vczjvkvub3g14xu2yas9zksj3qg" />
    <title>BusCargo | Dashboard </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/shared/style.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/demo_1/style.css') }}">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/images/favicon.ico') }}" />
    <style>
        .item-purchase-banner { display : none !important; }
        .purchase-banner-active .navbar.fixed-top{ top: 0px !important; }
        .purchase-banner-active .navbar.fixed-top + .page-body-wrapper { padding-top: 55px;}
    </style>
  </head>
  <body>
  <audio id="myAudio">
      <source src="{{ asset('assets/notification.mp3') }}" type="audio/mpeg">
      Your browser does not support the audio element.
  </audio>
    <div class="container-scroller" id="app">
      <front-dashboard-main-nav></front-dashboard-main-nav>
      <div class="container-fluid page-body-wrapper">
      <front-dashboard-sec-nav></front-dashboard-sec-nav>
        <div class="main-panel">
            <router-view></router-view>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © BusCargo</span>
              <small class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Developed and maintained by <a href="https://redarc.in" target="_blank">RedArc Technology Pvt. Limited</a></small>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="https://kit.fontawesome.com/a69cfdfc72.js" crossorigin="anonymous"></script> 
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('dashboard/assets/js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/shared/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('dashboard/assets/js/demo_1/dashboard.j') }}s"></script>
    <!-- End custom js for this page-->
    <script src="{{ asset('dashboard/assets/js/shared/jquery.cookie.js') }}" type="text/javascript"></script>
    
  </body>
</html>
