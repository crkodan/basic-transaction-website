@extends('adminlayout.app')

@section('title', 'TambahVendor')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Tambah/Sunting Vendor
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4> </h4></div>
                  <div class="card-body">
                    <form method="POST" action="{{ url('/tambahvendor') }}">
                      @csrf
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
                      @foreach($item as $i)
                      <input type="checkbox" name="itemid[]" value="{{$i->id}}">
                      <label>{{$i->jenisItem}} - {{ $i->tipeitem }}</label><br>
                      @endforeach
                      <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection