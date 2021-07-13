@extends('adminlayout.vendor')

@section('title', 'PesananBaruCustomer')
@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Tambah Data Pemesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{url('/barang-vendor')}}">
                      @csrf
                        <label>Nama Vendor</label>
                        <input type="text" name="" class="form-control" readonly value="{{Auth::user()->name}}">
                          <label>Item yang dijual</label><br>
                          @foreach($item as $i)
                          <input type="text" name="" class="form-control" readonly value="{{$i->jenisItem}} - {{$i->tipeitem}}">
                          @endforeach
                          <br>
                          <select class="form-control" name="barang">
                          @foreach($item as $i)
                            <option value="{{$i->id}}">{{$i->jenisItem}} - {{$i->tipeitem}}</option>
                          @endforeach
                        </select>                          
                        <input type="submit" value="Tambah barang vendor" class="btn btn-primary">                        
                    </form>                  
                  </div>
                </div>
              </div>
            </div>     
                
@endsection