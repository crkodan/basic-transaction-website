@extends('adminlayout.cust')

@section('title', 'DetailPesanan')
@section('content')
<div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Detail Pesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="#">
                    @csrf
                      <label>No. Invoice</label>
                      <input type="text" class="form-control" readonly="" value="{{$data->invoice}}">
                      <label>Nama Pemesan</label>
                      <input type="text" name="namaPemesan" class="form-control" readonly value="{{$data->name}}">
                      <label>Jabatan Pemesan</label>
                      <input type="text" name="jabatanPemesan" class="form-control" readonly value="{{$data->jabatanPemesan}}">
                      <label>Nama Perusahaan</label>
                      <input type="text" name="" class="form-control" readonly value="{{$data->brandCustomer}}">
                        <label>Item yang dipesan</label><br>
                        <textarea name="items" rows="5" cols="75" readonly value="{{$data->items_id}}">
                        {{$data->jenisItem}} - {{$data->tipeitem}}
                        </textarea>
                        <br>
                      <label>Qty.</label>
                      <input type="number" name="kuantitas" class="form-control" readonly value="{{$data->jumlah}}">
                      <label>Harga Satuan</label>
                      <input type="number" name="hargaSatuan" class="form-control"  readonly value="{{$data->hargaSatuan}}">
                      <label>Harga Total</label>
                      <input type="number" name="" class="form-control" readonly value="{{$data->hargaTotal}}">
                      <label>Tanggal Jadi</label>
                      <input type="date" name="tanggaljadi"class="form-control" readonly value="{{$data->tanggaljadi}}"> <br>
                      <label>Tanggal PO</label>
                      <input type="date" name="tanggalpo"class="form-control" readonly value="{{$data->tanggalpo}}"> <br>     
                      @if($data->statuspesanan == 0)      
                      <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                      @else
                      <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                      <a href="{{ url('/upload/'.$data->id)}}" class="btn btn-primary">Pembayaran / Pelunasan</a>
                      @endif
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection