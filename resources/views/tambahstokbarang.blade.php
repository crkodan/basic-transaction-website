@extends('adminlayout.app')

@section('title', 'TambahStok')
@section('content')
      <div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Tambah/Sunting Stok Barang
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ url('/tambahstokbarang') }}">
                    @csrf
                    <label>Jenis Barang</label>
                    <input type="text" name="jenisItem" class="form-control">                      
                    <label>Detail Tipe Barang</label>
                    <input type="text" name="tipeitem" class="form-control">   
                    <label>Jumlah Item</label>
                    <input type="number" name="stockjumlah" class="form-control">
                    <label>Harga Beli</label>
                    <input type="number" name="hargabeli" class="form-control">  
                    <label>Harga Jual</label>
                    <input type="number" name="hargajual" class="form-control">      
                    <label>Minimum Jumlah</label>
                    <input type="number" name="jumlahminimal" class="form-control">                              
                    <label>Catatan</label>
                    <input type="text" name="catatan" class="form-control"><br><br>
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection