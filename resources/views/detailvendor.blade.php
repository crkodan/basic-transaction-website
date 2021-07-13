@extends('adminlayout.app')

@section('title', 'DetailVendor')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Detail Vendor
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4></h4>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card">
                      <div class="card-body">
                        <form method="POST" action="{{ url('/detailvendor/updateVendor/'.$data->id)}}">
                          @csrf
                          <label>ID Vendor</label>
                          <input type="text" class="form-control" name="id" value="{{$data->id}}" readonly="">
                          <label>Nama Vendor</label>
                          <input type="text" name="namaVendor" class="form-control" value="{{$data->namaVendor}}">
                          <label>Pemilik</label>
                          <input type="text" name="pemilikVendor" class="form-control" value="{{$data->pemilikVendor}}">
                          <label>Brand / Instansi Vendor</label>
                          <input type="text" name="brandVendor" class="form-control" value="{{$data->brandVendor}}">
                          <label>Alamat Vendor</label>
                          <input type="text" name="alamatVendor" class="form-control" value="{{$data->alamatVendor}}">
                          <label>Kota </label>
                          <input type="text" name="kotaVendor" class="form-control" value="{{$data->kotaVendor}}">
                          <label>Usaha Vendor</label>
                          <input type="text" name="jenisUsahaVendor" class="form-control"value="{{$data->jenisUsahaVendor}}">
                          <label>Kategori Vendor</label>
                          <input type="text" name="kategoriVendor" class="form-control" value="{{$data->kategoriVendor}}"><br>
                          <label>Email Vendor</label>
                          <input type="text" class="form-control" name="id" value="vendor@vendor.com" readonly="">
                          <label>Nama Item Tersedia</label>
                          <select class="form-control" name="nameItem" readonly="">
                          @foreach($item as $i)
                          <option value="{{ $i->item_id}} " size="4">{{$i->jenisItem}} - {{$i->tipeitem}}</option>         
                          @endforeach
                          </select><br>
                          <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        </form>
                      </div>
                  </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection