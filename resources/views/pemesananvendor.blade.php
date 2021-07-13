@extends('adminlayout.app')

@section('title', 'PesananVendor')
@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Tambah Data Pemesanan Vendor </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ url('/pemesananvendor') }}">
                    @csrf
                      <label>No. Invoice Pesanan</label>
                      <select class="form-control" name="invoicePesanan">
                      @foreach($invoice as $in)
                        <option value="{{$in->id}}">{{$in->name}} - {{$in->jabatanPemesan}} - {{$in->brandCustomer}}</option>
                      @endforeach
                      </select>
                      <label>Nama Vendor</label>
                      <select class="form-control" name="namaVendor">
                      @foreach($vendor as $v)
                        <option value="{{$v->id}}">{{$v->namaVendor}}</option>
                      @endforeach
                      </select>
                      <label>Item yang dipesan</label>
                      <select class="form-control" name="nameItem">
                      @foreach($item as $i)
                        <option value="{{$i->id}}">{{$i->jenisItem}} - {{$i->tipeitem}}</option>
                      @endforeach                   
                      </select>   
                      <label>Qty.</label>
                      <input type="number" name="kuantitas" class="form-control">
                      <label>Tanggal Jatuh Tempo Pembayaran</label>
                      <input type="date" name="tanggalJatuhTempo"class="form-control">
                      <label>Tanggal Kerja</label>
                      <input type="date" name="tanggalfaktur"class="form-control">
                      <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>                      
@endsection