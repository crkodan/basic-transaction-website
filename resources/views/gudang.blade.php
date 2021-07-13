@extends('adminlayout.app')

@section('title', 'Gudang')
@section('content')
<div class="main-content">
        <section class="section">
         
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Daftar Barang</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4><a href="tambahstokbarang" class="btn btn-primary">Tambah Barang</a></h4>                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcel">
                  Import Excel
                  </button>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead><tr>
                        <th>ID Barang</th>
                        <th>Jenis Barang</th>
                        <th>Detail Tipe Barang</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Min. Pemesanan</th>
                        <th>Catatan</th>
                        <th></th>
                      </tr></thead>
                     @foreach($item as $i)
                     
                     <tbody><tr>
                        <td><a href="#">{{$i->id}}</a></td>
                        <td class="font-weight-600">{{$i->jenisItem}}</td>
                        <td>{{$i->tipeitem}}</td>
                        <td>{{$i->hargabeli}}</td>
                        <td>{{$i->hargajual}}</td>
                        <td>{{$i->jumlahminimal}}</td>
                        <td>{{$i->catatan}}</td>
                        <td><a href="{{url('/detailitem/'.$i->id)}}" class="btn btn-primary">Detail / Edit Stok</a></td>
                      </tr></tbody>
                      @endforeach
                      {{$item->links()}}
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
      <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ url('/gudang/import_excel')}}" enctype="multipart/form-data">
              <div class="modal-body">
                @csrf
                <label>Pilih file excel</label>
                <div class="form-group">
                  <input type="file" name="file" required="required">
                </div>
              </div>
              <div class="modal-footer">
              <input type="submit" value="Upload Excel" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <script>
      $(document).ready(function() {
      $('#dataTable').DataTable();
      });
      </script>
@endsection