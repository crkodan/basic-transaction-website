@extends('adminlayout.vendor')

@section('title', 'ambilPesanan')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>Ambil Pesanan</h1>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header"></div>
              <div class="card-body">
              <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Jenis Pembayaran</th>
                        <th>Status</th>
                        <th>Batas Waktu Pembayaran</th>
                        <th>Action</th>
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
                          <td>{{$i->jatuhtempo->format('d-M-Y')}}</td>
                          <td>
                            @if($i->statuspelunasan==0)
                            <a class="btn btn-warning">Menunggu Status Pelunasan</a>
                            @elseif($i->statuspelunasan==1)
                            <a href="{{url('ambilpesanan/'.$i->id)}}" class="btn btn-info">Proses Pesanan</a>
                            @endif
                          </td>
                        
                          <td></td>                        
                      </tr>
                      @endforeach
                      
                                  
                    </table>
                  </div>
                    
              </div>
              <div class="card-footer bg-whitesmoke"></div>
            </div>
          </div>
        </section>
      
@endsection