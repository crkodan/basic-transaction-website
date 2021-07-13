@extends('adminlayout.app')

@section('title', 'DaftarPesanan')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            @if(session()->has('berhasil'))
              <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>  {{ session('berhasil') }}</strong>
                    </div>

              </div>
            @elseif(session()->has('gagal'))
              <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>{{ session('gagal') }}</strong>
                    </div>
                
              </div>
                
            @endif
            <div class="alert alert-info">
                      <b>Daftar Pesanan
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <form action="{{url('/daftarpesanan/cari')}}" method="GET">
                    <label  >Bulan </label>
                    <select name="statuspesanan" id="statuspesanan" class="form-control">
                      <option value="0">Dalam Antrian</option>
                      <option value="1">Menunggu Konfirmasi</option>
                      <option value="2">Pengerjaan</option>
                      <option value="3">Ditolak</option>
                      <option value="4">Selesai</option>
                    </select><input type="submit" value="Filter" class="btn btn-primary">
                  </form>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>ID Pesanan</th>
                        <th>Customer</th>
                        <th>Status Pesanan</th>
                        <th>Status Pelunasan</th>
                        <th>Due Date</th>
                        <th>Action</th>
                      </tr>        
                      @foreach($invoice as $i)           
                      <tr>
                        <td><a href="#">{{ $i->invoice }}</a></td>
                        <td class="font-weight-600">{{ $i->name }}</td>
                        @if($i->statuspesanan == 0)
                        <td><div class="badge badge-warning">Dalam Antrian</div></td>
                        @elseif($i->statuspesanan == 1)                        
                        <td><div class="badge badge-warning">Menunggu Konfirmasi</div></td>
                        @elseif($i->statuspesanan == 2)                        
                        <td><div class="badge badge-warning">Pengerjaan</div></td>
                        @elseif($i->statuspesanan == 3)                        
                        <td><div class="badge badge-danger">Ditolak</div></td>
                        @elseif($i->statuspesanan == 4)   
                        <td><div class="badge badge-success">Selesai</div></td>
                        @endif
                        @if($i->statuspelunasan == 0)
                        <td><div class="badge badge-danger">Belum Lunas</div></td>
                        @elseif($i->statuspelunasan == 1)                        
                        <td><div class="badge badge-success">Telah Lunas</div></td>
                        @endif
                        <td>{{ $i->tanggaljadi }}</td>
                        <td>
                          <a href="{{url('detailpesanan/'.$i->id)}}" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                    {{ $invoice->links() }}
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection