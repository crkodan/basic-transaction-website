<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SI Logistik & Pembukuan GEP &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css"> -->
  

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <!-- <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css"> -->

<!-- datatables -->
                            <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
                                  <link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap4.css') }}">
                                  <link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap4.min.css') }}">
                            <script src="{{ asset('datatables/dataTables.bootstrap4.js') }}"></script>\
                            <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
                            <script src="{{ asset('datatables/jquery.dataTables.js') }}"></script>
                            <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
                            <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
  <!-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->


  
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        
          
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{url('/dashboard')}}">GEP</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dasbor</li>
              <li class="nav-item dropdown">
                <a href="{{ url('/dashboard') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Rekap Penjualan</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{ url('/pengguna') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Kelola Pengguna</span></a>
              </li>
              <li class="menu-header">Pesanan</li>
              <li class="nav-item dropdown">
                <a href="{{ url('/daftarpesanan') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Pesanan Customer</span></a>  
              </li>
              <li><a class="nav-link" href="{{ url('/daftarpemesanan') }}"><i class="fas fa-columns"></i> <span>Pemesanan Vendor</span></a></li>
              <li><a class="nav-link" href="{{ url('/pesananbaru') }}"><i class="far fa-square"></i> <span>Pesanan Baru</span></a></li>
              <!-- <li><a class="nav-link" href="{{ url('/pemesananvendor') }}"><i class="far fa-square"></i> <span>Pesan Vendor</span></a></li> -->
              <li class="nav-item dropdown">
                <a href="{{ url('/pelunasan') }}" class="nav-link"><i class="fas fa-th"></i> <span>Pelunasan</span></a>                
              </li>
              <li class="menu-header">Pelanggan</li>
              <li class="nav-item dropdown">
                <a href="{{ url('/datapelanggan') }}" class="nav-link"><i class="fas fa-th-large"></i> <span>Data Pelanggan</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{ url('/ulasanrating') }}" class="nav-link"><i class="far fa-file-alt"></i> <span>Rating/Ulasan</span></a>
                
              </li>
              <li class="menu-header">Vendor</li>
              <li class="nav-item dropdown">
                <a href="{{ url('/daftarvendor') }}" class="nav-link"><i class="far fa-user"></i> <span>Daftar Vendor</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{ url('/catatanvendor') }}" class="nav-link"><i class="fas fa-exclamation"></i> <span>Catatan Vendor</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{ url('/gudang') }}" class="nav-link"><i class="fas fa-home"></i> <span> Daftar Barang </span></a>
              </li>
              </li>
              
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="{{ url('/pembukuan') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Pembukuan
              </a>
            </div>
            <form method="POST" action="{{ route('logout') }}" role="form">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  <b>logout</b>
              </button>
            </form>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <!-- <script src="../assets/js/stisla.js"></script> -->
  <script src="{{ asset('js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Template JS File -->
  <!-- <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script> -->
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

  

  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- {{ asset('css/style.css') }} -->
  <!-- Page Specific JS File -->
  <!-- <script src="../assets/js/page/index.js"></script> -->
  <script src="{{ asset('js/page/index.js') }}"></script>

  
<!-- Page level plugins -->

  @yield('script')
</body>
</html>
