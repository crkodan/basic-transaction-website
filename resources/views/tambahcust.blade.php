@extends('adminlayout.app')

@section('title', 'TambahCustomer')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Tambah/Sunting Pelanggan
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                    <form method="POST" action="{{ url('/tambahcust') }}">
                      @csrf
                      <label>Brand / Instansi Pelanggan</label>
                      <input type="text" name="brandCustomer" class="form-control" required>
                      <label>Cabang Pelanggan</label>
                      <input type="text" name="cabangCustomer" class="form-control" required>
                      <label>Alamat Pelanggan</label>
                      <input type="text" name="alamatCustomer" class="form-control" required>
                      <label>Kota </label>
                      <input type="text" name="kotaCustomer" class="form-control" required>
                      <label>Kategori Pelanggan</label>
                      <input type="text" name="kategoriCustomer" class="form-control" required><br>
                      <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
                  </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection