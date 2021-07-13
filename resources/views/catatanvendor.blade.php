@extends('adminlayout.app')

@section('title', 'CatatanVendor')
@section('content')
<div class="main-content">
        <section class="section">
         
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Catatan Vendor</div>
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
                        <th></th>
                      </tr>
                        @foreach($listCatatan as $ls)
                          <tr>
                            <td><a href="#">{{ $ls->id }}</a></td>
                            <td class="font-weight-600">{{ $ls->namaVendor }}</td>                
                            @if($ls->statuskerja == 1)      
                                  <td><div class="badge badge-success">Menunggu Konfirmasi</div></td>
                                  @elseif($ls->statuskerja == 0)
                                  <td><div class="badge badge-warning">Dalam Antrian</div></td>
                                  @elseif($ls->statuskerja == 2)
                                  <td><div class="badge badge-info">Deal dengan Vendor</div></td>
                                  @elseif($ls->statuskerja == 3)
                                  <td><div class="badge badge-danger">GEP Menolak Pesanan</div></td>
                                  @elseif($ls->statuskerja == 4)
                                  <td><div class="badge badge-danger">Vendor Menolak Pesanan</div></td>
                                  @elseif($ls->statuskerja == 5)
                                  <td><div class="badge badge-success">Pesanan Selesai</div></td>
                                @endif
                            @if($ls->tanggaljadi != '')
                              <td>{{ $ls->tanggaljadi }}</td>   
                            @else
                              <td></td>
                            @endif                     
                            <td>
                              <div style="height:40px;width:500px;overflow:auto;background-color:orange;color:white;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;">
                              {{ $ls->catatan }}
                              </div>
                            </td>
                            <td>
                            <a href="{{url('/detailpemesanan/'.$ls->id)}}" class="btn btn-primary">Detail</a>
                            </td>
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