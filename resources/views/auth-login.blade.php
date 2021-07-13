<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; GEP</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
<div class="container">


        <div class="col-md-12">

    <div >
       @if(session()->has('berhasil'))
<div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>  {{ session('berhasil') }}</strong>
      </div>

</div>
@elseif(session()->has('gagal'))
<div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ session('gagal') }}</strong>
      </div>
  
</div>
  
@endif
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" role="form">
                  @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in username
                    </div>
                  </div>

                  <div class="form-group">
                  <label for="password">PIN / Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in pin / password
                    </div>
                  </div>

                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      <b>Login</b>
                    </button>
                  </div>
                </form>
                

              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              <!-- <a href="auth-register">Register</a> -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerVendor">
                  Register Vendor
              </button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerCustomer">
                  Register Customer
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
      <div class="modal fade" id="registerCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Register Customer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ url('/auth-login/register-customer')}}" enctype="multipart/form-data" onsubmit="alert('Akun Berhasil Didaftarkan. Silahkan menghubungi +6285233444543 untuk aktivasi');">
              <div class="modal-body">
                @csrf
                  <label for="email">Username</label>
                  <input id="email" type="text" class="form-control" name="username" required> 
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" required>
                  <label for="password" class="d-block">PIN / Password</label>
                  <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                  <label for="password2" class="d-block">PIN / Password Confirmation</label>
                  <input id="password2" type="password" class="form-control" name="password-confirm" required>
                  <label>Brand</label>
                  <input type="text" name="brandCustomer" class="form-control" required>
                  <label>Alamat</label>
                  <input type="text" name="alamatCustomer" class="form-control" required>
                  <label>Kota</label>
                  <input type="text" name="kotaCustomer" class="form-control" required>
                  <label>Kategori Customer</label>
                  <input type="text" name="kategoriCustomer" class="form-control" required>
                  <label>Cabang</label>
                  <input type="text" name="cabangCustomer" class="form-control" required><h1></h1>
              </div>
              <div class="modal-footer">
                  <input type="submit" value="Register Now!" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="registerVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Register Vendor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ url('/auth-login/register-vendor')}}" enctype="multipart/form-data" onsubmit="alert('Akun Berhasil Didaftarkan. Silahkan menghubungi +6285233444543 untuk aktivasi');">
              <div class="modal-body">
                @csrf
                  <label for="email">Username</label>
                  <input id="email" type="text" class="form-control" name="username" required>
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" required>
                  <label for="password" class="d-block">PIN / Password</label>
                  <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                  <label for="password2" class="d-block">PIN / Password Confirmation</label>
                  <input id="password2" type="password" class="form-control" name="password-confirm" required>
                  <label>Pemilik</label>
                  <input type="text" name="pemilikVendor" class="form-control" required>
                  <label>Brand</label>
                  <input type="text" name="brandVendor" class="form-control" required>
                  <label>Alamat</label>
                  <input type="text" name="alamatVendor" class="form-control" required>
                  <label>Kota</label>
                  <input type="text" name="kotaVendor" class="form-control" required>
                  <label>Jenis Usaha</label>
                  <input type="text" name="jenisUsahaVendor" class="form-control" required>
                  <label>Kategori</label>
                  <input type="text" name="kategoriVendor" class="form-control" required><h1></h1>
                  <!-- <label>Item yang dijual</label><br> -->
                  
              </div>
              <div class="modal-footer">
                <input type="submit" value="Register now!" class="btn btn-primary">
              </div>
            </form>
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

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  @yield('script')
</body>
</html>
