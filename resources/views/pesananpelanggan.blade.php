@extends('adminlayout.app')

@section('title', 'PesananPelanggan')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
          <div class="alert alert-info">
                      <b>Histori Pelanggan
                    </div>  
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4></h4>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Jenis Pembayaran</th>
                        <th>Status</th>
                        <th>Batas Waktu Pembayaran</th>
                      </tr>
                      @foreach($invoice as $i)
                      <tr>
                        <td><a href="#">{{ $i->id }}</a></td>
                        <td class="font-weight-600">{{$i->name}}</td>  
                        @if($i->jenispembayaran==1)
                          <td class="font-weight-600">Kredit</td>      
                        @elseif($i->jenispembayaran==0)
                          <td class="font-weight-600">Tunai</td>      
                        @endif
                        
                        @if($i->statuspelunasan == 0)
                          <td><div class="badge badge-warning">Belum Lunas</div></td>
                          @elseif($i->statuspelunasan==1)
                          <td><div class="badge badge-success">Lunas</div></td>
                          @endif
                          <td>{{$i->jatuhtempo}}</td>
                          
                        
                          <td></td>                        
                      </tr>
                      @endforeach
                      
                                  
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