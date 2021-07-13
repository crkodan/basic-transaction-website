@extends('adminlayout.app')

@section('title', 'DetailPelanggan')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4></h4>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">  
                        <form method="POST" action="{{ url('/detailpelanggan/update/'.$data->id) }}">   
                        @csrf               
                            <label>Brand / Instansi Pelanggan</label>
                            <input type="text" name="brandCustomer" class="form-control" value="{{$data->brandCustomer}}">
                            <label>Cabang Pelanggan</label>
                            <input type="text" name="cabangCustomer" class="form-control"value="{{$data->cabangCustomer}}">
                            <label>Alamat Pelanggan</label>
                            <input type="text" name="alamatCustomer" class="form-control" value="{{$data->alamatCustomer}}">
                            <label>Kota </label>
                            <input type="text" name="kotaCustomer" class="form-control" value="{{$data->kotaCustomer}}">
                            <label>Kategori Pelanggan</label>
                            <input type="text" name="kategoriCustomer" class="form-control" value="{{$data->kategoriCustomer}}"><br>
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            <!-- <a href="pelunasan" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a> -->
                        </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection