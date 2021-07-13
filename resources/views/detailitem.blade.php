@extends('adminlayout.app')

@section('title', 'Gudang')
@section('content')
<div class="main-content">
        <section class="section">
         
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Gudang</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                        <form method="POST" action="{{url('/detailitem/updateitem/'.$data->id)}}">
                          @csrf
                          <label>ID Item</label>
                          <input type="text" class="form-control" name="id" value="{{$data->id}}" readonly="">
                          <label>Jenis Item</label>
                          <input type="text" name="jenisItem" class="form-control" value="{{$data->jenisItem}}" readonly="">
                          <label>Detail Tipe Item</label>
                          <input type="text" name="tipeitem" class="form-control" value="{{$data->tipeitem}}" readonly="">
                          <label>jumlah</label>
                          <input type="number" name="stockjumlah" class="form-control" value="{{$data->stockjumlah}}">
                          <label>min. pemesanan</label>
                          <input type="number" name="jumlahminimal" class="form-control" value="{{$data->jumlahminimal}}">
                          <label>Catatan</label>
                          <input type="text" name="catatan" class="form-control" value="{{$data->catatan}}">
                          <h1></h1>
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