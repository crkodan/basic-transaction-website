@extends('adminlayout.app')

@section('title', 'PesananVendor')
@section('content')
<div class="main-content">
        <section class="section">
         
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Histori Vendor</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>
            <!-- <a href="tambahcatatanvendor" class="btn btn-primary">Tambah Catatan Vendor</a></h4> -->
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Vendor</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Catatan</th>
                      </tr>
                        @foreach($listCatatan as $ls)
                          <tr>
                            <td><a href="#">{{ $ls->id }}</a></td>
                            <td class="font-weight-600">{{ $ls->namaVendor }}</td>                
                            @if($ls->statuskerja == 0)  
                              <td><div class="badge badge-warning">Belum Selesai</div></td>
                            @elseif($ls->statuskerja == 1)
                              <td><div class="badge badge-success">Selesai</div></td>
                            @endif
                              <td>{{ $ls->tanggaljadi }}</td>                        
                            <td>
                              <div style="height:40px;width:500px;overflow:auto;background-color:orange;color:white;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;">
                              {{ $ls->catatan }}
                              </div>
                            </td>
                            <td></td>
                          </tr>
                        @endforeach
                        {{ $listCatatan->links() }}
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection