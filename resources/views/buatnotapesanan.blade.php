@extends('adminlayout.app')

@section('title', 'BuatNotaPesanan')
@section('content')

<div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Buat Nota Pemesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ url('/pesananbaru') }}">
                    
                     <label>No. Invoice</label>
                      <input type="text" name="invoice" class="form-control">
                      <label>Nama Pelanggan</label>
                      <select class="form-control" name="namaCustomer">
                      
                        <option value="id">Nama Perusahaan</option>
                      
                      </select>

                      <label>Pilih ID Pesanan</label>
                        <select class="form-control" name="namaItem" multiple="" data-height="100%" readonly="">
                          <option>PSN001</option>
                          <option>PSN002</option>
                          <option>PSN003</option>
                        </select>
                                   
                      <label>Grandtotal</label>
                      <input type="number" name="grandtotal" class="form-control">
                      <label>Nama Penerima</label>
                      <input type="text" name="namapelangganpenerima" class="form-control">
                      <h1></h1>
                      <a href="notapesanan" class="btn btn-primary">Cetak Nota <i class="fas fa-chevron-right"></i></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>                      

@endsection