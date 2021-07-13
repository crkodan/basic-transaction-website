<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Vendor-GEP</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="layout-2">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="{{url('/dashboard')}}" class="navbar-brand sidebar-gone-hide">Golden Eagle Production</a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <ul class="navbar-nav">
            <li class="nav-item active"><a href="{{ url('auth-vendor') }}" class="nav-link">Upload Nota</a></li>
          <li class="nav-item active"><a href="{{ url('barang-vendor') }}" class="nav-link">Barang Vendor</a></li>
          </ul>
        </div>
        <form class="form-inline ml-auto">
        </form>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              
              <div class="dropdown-divider"></div>
              <form method="POST" action="{{ route('logout') }}" role="form">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      <b>logout</b>
                    </button>
              </form>
            </div>
          </li>
        </ul>
      </nav>
      

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Upload Nota Vendor</h1>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header"></div>
              <div class="card-body">
              <div class="table-responsive table-invoice">
              <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th></th>
                      </tr>
                        @foreach($orders as $ls)
                        @if($ls->statuskerja == 0)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                    
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                            <td><div class="badge badge-warning">Menunggu Konfirmasi</div></td>
                            <td>{{ $ls->tanggaljadi }}</td>    
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                        @elseif($ls->statuskerja == 1)
                          <tr>
                          <td><a href="#">{{ $ls->orderinvoice }}</a></td>                   
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                              <td><div class="badge badge-info">Menunggu Konfirmasi GEP</div></td>
                              <td>{{ $ls->tanggaljadi }}</td> 
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                          @elseif($ls->statuskerja == 2)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                      
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                              <td><div class="badge badge-success">Deal, Memproses Pesanan</div></td>
                              <td>{{ $ls->tanggaljadi }}</td>
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a>
                            </td>
                          </tr>
                          @elseif($ls->statuskerja == 3)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                              
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                            <td><div class="badge badge-danger">GEP Menolak Pesanan</div></td>
                              <td>{{ $ls->tanggaljadi }}</td>   
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                          @elseif($ls->statuskerja == 4)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                              
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                            <td><div class="badge badge-danger">Vendor Menolak Pesanan</div></td>
                              <td>{{ $ls->tanggaljadi }}</td>   
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                          @elseif($ls->statuskerja == 5)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                                 
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                            <td><div class="badge badge-success">Pesanan Selesai</div></td>
                              <td>{{ $ls->tanggaljadi }}</td>
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                          @elseif($ls->statuskerja == 6)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                        
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                            <td><div class="badge badge-info">Proses Negosiasi ke GEP</div></td>
                              <td>{{ $ls->tanggaljadi }}</td>
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                          @elseif($ls->statuskerja == 7)
                          <tr>
                            <td><a href="#">{{ $ls->orderinvoice }}</a></td>                        
                            <td>
                              {{ $ls->jenisItem }} - {{ $ls->tipeitem}}
                            </td>
                            <td class="font-weight-600">{{ $ls->biaya }}</td>               
                            <td><div class="badge badge-info">Tawaran Negosiasi dari GEP</div></td>
                              <td>{{ $ls->tanggaljadi }}</td>
                            <td>
                            <a href="{{ url('/detailpemesanan/ambilorder/'.$ls->id)}}" class="btn btn-primary">Detail Pemesanan</a>
                              <!-- <a href="{{ url('/uploadvendor/'.$ls->id)}}" class="btn btn-primary">upload bukti pengiriman</a> -->
                            </td>
                          </tr>
                        @endif
                        @endforeach
                        {{ $orders->links() }}
                    </table>
                  </div>
                    
              </div>
              <div class="card-footer bg-whitesmoke"></div>
            </div>
          </div>
        </section>
      </div>
      
    </div>
  </div>
  

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../node_modules/sticky-kit/dist/sticky-kit.min.js"></script>

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
  @yield('script')
</body>
</html>
