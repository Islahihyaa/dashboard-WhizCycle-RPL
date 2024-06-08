<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
  .dotted-line {
        border-top: 1px dotted #000; /* Mengatur garis titik-titik dengan warna hitam */
        width: 80%; /* Lebar garis */
        margin: 20px auto; /* Posisi garis di tengah halaman */
    }
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <img src="{{ asset('images/logo.png') }}" alt="logo" width="180" height="60" >
  </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo Auth::user()->name; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo Auth::user()->name ?></h6>
              <span><?php echo Auth::user()->address  ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @yield('dashboard')" href="{{url('/dashboard')}}">
          <i class="bi bi-house"></i>
          <span>Beranda</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @yield('manage-order')" href="{{url('/manage-order')}}">
          <i class="bi bi-truck"></i>
          <span>Setoran Sampah</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @yield('manage-voucher')" href="<?= url('voucher') ?>">
          <i class="bi bi-folder"></i>
          <span>Data Voucher</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @yield('manage-redeem')" href="<?= url('history-all-redeem-point') ?>">
          <i class="bi bi-star-fill"></i>
          <span>Riwayat Tukar Point </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @yield('manage-article')" href="{{url('/manage-article')}}">
          <i class="bi bi-newspaper"></i>
          <span>Edukasi Lingkungan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @yield('response-complaint')" href="{{url('/response-complaint')}}">
          <i class="bi bi-headset"></i>
          <span>Customer Service</span>
        </a>
      </li>

      <li class="nav-item">
          <a class="nav-link @yield('manageuser')" href="manageuser">
              <i class="bi bi-person-circle"></i>
              <span>Management User</span>
          </a>
      </li>
      
      <li class="nav-item">
      <a class="nav-link @yield('manage-vehicles')" href="{{url('/manage-vehicles')}}">
          <i class="bi bi-truck"></i>
          <span>Kelola Kendaraan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @yield('manage-driver')" href="{{url('/manage-driver')}}">
          <i class="bi bi-person-walking"></i>
          <span>Kelola Driver</span>
        </a>
      </li>

      <li class="nav-item">
          <a class="nav-link @yield('laporan')" href="{{ url('/laporan') }}">
              <i class="bi bi-file-earmark-text"></i>
              <span>Laporan</span>
          </a>
      </li>
      

      </li>
    </ul>

  </aside><!-- End Sidebar-->

  @yield('content')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
      $(document).ready(function() {
          $('#exportForm').on('submit', function(e) {
              e.preventDefault();
              var tableId = $('#tableSelect').val();
              exportTableToExcel(tableId);
          });
      });

      function exportTableToExcel(tableId) {
          var table = document.getElementById(tableId);
          var tableHtml = table.outerHTML.replace(/ /g, '%20');
          var filename = tableId + '.xls';
          var dataType = 'application/vnd.ms-excel';
          var downloadLink = document.createElement("a");

          document.body.appendChild(downloadLink);

          if (navigator.msSaveOrOpenBlob) {
              var blob = new Blob(['\ufeff', tableHtml], { type: dataType });
              navigator.msSaveOrOpenBlob(blob, filename);
          } else {
              downloadLink.href = 'data:' + dataType + ', ' + tableHtml;
              downloadLink.download = filename;
              downloadLink.click();
          }
      }
  </script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @yield('script')
</body>

</html>

