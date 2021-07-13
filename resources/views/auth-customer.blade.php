<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Customer-GEP</title>

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
            <li class="nav-item active"><a href="#" class="nav-link"></a></li>
            <li class="nav-item active"><a href="#" class="nav-link"></a></li>
            <li class="nav-item active"><a href="{{ url('/pesananbarucust')}}" class="nav-link">Tambah Pesanan</a></li>
            <li class="nav-item active"><a href="{{ url('/auth-customer')}}" class="nav-link">Upload Nota</a></li>
          </ul>
        </div>
        <form class="form-inline ml-auto">
        </form>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
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
            <h1>Upload Nota Pemesanan</h1>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
              @if(session()->has('berhasil'))
              <div class="alert alert-success">
                {{session()->get('berhasil')}}
              </div>
              @elseif(session()->has('gagal'))
              <div class="alert alert-danger">
                {{session()->get('gagal')}}
              </div>
              @endif
              </div>
              <div class="card-body">
              <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Total Harga</th>
                        <th>Jenis Pembayaran</th>
                        <th>Status Pelunasan</th>
                        <th>Status Kerja</th>
                        <th>Batas Waktu Pembayaran</th>
                        <th>Action</th>
                      </tr>
                      @foreach($invoice as $i)
                      <tr>
                        <td><a href="#">{{ $i->invoice }}</a></td>
                        @if($i->hargaTotal == 0)
                        <td><div class="font-weight-600 badge badge-warning">Menunggu Konfirmasi</div></td>  
                        @else
                        <td class="font-weight-600">{{$i->hargaTotal}}</td>
                        @endif                          
                        @if($i->jenispembayaran==1)
                          <td class="font-weight-600">Kredit</td>      
                        @elseif($i->jenispembayaran==0)
                          <td class="font-weight-600">Tunai</td>      
                        @endif
                        
                        @if($i->statuspelunasan == 0)
                          <td><div class="badge badge-warning">Belum Lunas</div></td>
                        @elseif($i->statuspelunasan==1)
                          <td><div class="badge badge-success">Lunas</div></td>
                        @endif
                        @if($i->statuspesanan == 0)
                                  <td><div class="badge badge-warning">Pesanan Dalam Antrian</div></td>
                                @elseif($i->statuspesanan == 1)                        
                                  <td><div class="badge badge-warning">Menunggu Konfirmasi Pengerjaan</div></td>
                                @elseif($i->statuspesanan == 2)                        
                                  <td><div class="badge badge-info">Pesanan dalam Pengerjaan</div></td>
                                @elseif($i->statuspesanan == 3)                        
                                  <td><div class="badge badge-danger">Pesanan Ditolak</div></td>
                                @elseif($i->statuspesanan == 4)   
                                  <td><div class="badge badge-success">Selesai</div></td>
                        @endif 
                        @if($i->jatuhtempo == "" && $i->statuspesanan !=4)
                        <td>Menunggu Konfirmasi GEP</td>
                        @elseif($i->jatuhtempo == "" && $i->statuspesanan ==4)
                        <td>-</td>
                        @else
                          <td>{{date('j F Y', strtotime($i->jatuhtempo))}}</td>
                          @endif
                          <td>
                            @if($i->statuspelunasan==0 && $i->statuspesanan==0)
                            <a href="{{url('/detailpesanancust/'.$i->id)}}" class="btn btn-primary">Detail</a>
                            @elseif($i->statuspelunasan==0 && $i->statuspesanan!=0)
                            <a href="{{url('/detailpesanancust/'.$i->id)}}" class="btn btn-primary">Detail</a>
                            <a href="{{ url('/upload/'.$i->id)}}" class="btn btn-primary">Update Payment</a>
                            @elseif($i->statuspelunasan==1)
                            <a href="{{url('detailpesanancust/'.$i->id)}}" class="btn btn-primary">Detail</a>
                            @endif
                          </td>
                        
                          <td></td>                        
                      </tr>
                      @endforeach
                      
                                  
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
