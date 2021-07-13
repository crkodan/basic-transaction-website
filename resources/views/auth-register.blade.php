<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; GEP</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

            <div class="login-brand">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ url('users') }}" role="form">
							  @csrf
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">PIN / Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">PIN / Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password-confirm">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group role">
                      <label for="role" class="d-block">Role</label>
                      <select name="role" id="jenisPengguna" onchange="hideDiv(this.value)">
											<option value="customer" >Customer</option>
											<option value="vendor" >Vendor</option>
										  </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="formCustomer">
                      <label>Brand / Instansi Pelanggan</label>
                      <input type="text" name="brandCustomer" class="form-control">
                      <label>Cabang Pelanggan</label>
                      <input type="text" name="cabangCustomer" class="form-control">
                      <label>Alamat Pelanggan</label>
                      <input type="text" name="alamatCustomer" class="form-control">
                      <label>Kota </label>
                      <input type="text" name="kotaCustomer" class="form-control">
                      <label>Kategori Pelanggan</label>
                      <input type="text" name="kategoriCustomer" class="form-control">
                    </div>
                    <div class="formVendor">
                      <label>Nama Vendor</label>
                      <input type="text" name="namaVendor" class="form-control">
                      <label>Pemilik</label>
                      <input type="text" name="pemilikVendor" class="form-control">
                      <label>Brand</label>
                      <input type="text" name="brandVendor" class="form-control">
                      <label>Alamat</label>
                      <input type="text" name="alamatVendor" class="form-control">
                      <label>Kota</label>
                      <input type="text" name="kotaVendor" class="form-control">
                      <label>Jenis Usaha</label>
                      <input type="text" name="jenisUsahaVendor" class="form-control">
                      <label>Kategori</label>
                      <input type="text" name="kategoriVendor" class="form-control"><h1></h1>
                      <label>Item yang dijual</label><br>
                      <input type="checkbox" name="itemid[]" value="id">
                      <label>jenisItem - tipeItem</label>
                      
                    </div>
                  </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      <b>Register</b>
                    </button>
                  </div>
                </form>
              </div>
            </div></div>
            <div class="simple-footer">
            <a href="auth-login">Back to Login</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="../assets/js/page/auth-register.js"></script>

  <!-- 19-9-2020 https://stackoverflow.com/questions/36242801/php-if-select-option-value-equals-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
  function hideDiv(option)	
	{
		if(option=="customer"){$('.formCustomer').show()}
    else{$('.formCustomer').hide()}
    if(option=="vendor"){$('.formVendor').show()}
    else{$('.formVendor').hide()}
	}
  </script>
   @yield('script')
</body>
</html>
