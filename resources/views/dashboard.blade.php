@extends('adminlayout.app')

@section('title', 'Dashboard')
@section('content')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Rekap Penjualan</h4>
                  <div class="card-header-action">
                    <a href="pelunasan" class="btn btn-danger">Cek Daftar Pelunasan <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice Pesanan</th>
                                <th>Customer</th>
                                <th>Status Pesanan</th>
                                <th>Tanggal Jadi</th>
                                <th>Invoice Vendor</th>
                                <th>Vendor</th>
                                <th>Status Vendor</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($invoice as $i)
                            <tr>
                                <td><a href="{{ url('/detailpesanan/'.$i->id) }}">{{ $i->invoice }}</a></td>
                                <td class="font-weight-600"> {{ $i->name }} </td>
                                @if($i->statuspesanan == 0)
                                  <td><div><a href="{{url('/detailpesanan/'.$i->id)}}" class="btn btn-warning">Pesanan Baru/Dalam Antrian</a></div></td>
                                @elseif($i->statuspesanan == 1)                        
                                  <td><div> <a href="{{url('/detailpesanan/'.$i->id)}}" class="btn btn-primary">Menunggu Konfirmasi Pengerjaan</a></div></td>
                                @elseif($i->statuspesanan == 2)                        
                                  <td><div> <a href="{{url('/detailpesanan/'.$i->id)}}" class="btn btn-info">Pesanan dalam Pengerjaan</a></div></td>
                                @elseif($i->statuspesanan == 3)                        
                                  <td><div> <a href="{{url('/detailpesanan/'.$i->id)}}" class="btn btn-danger">Pesanan Ditolak</a></div></td>
                                @elseif($i->statuspesanan == 4)   
                                  <td><div>  <a href="{{url('/detailpesanan/'.$i->id)}}" class="btn btn-success">Pesanan Selesai</a></div></td>
                                @endif                                
                                <td> {{ date('j F Y', strtotime($i->tanggaljadi))}} </td>
                                <td> <a href="{{url('/detailpemesanan/'.$i->orderid)}}">{{$i->orderinvoice }} </td>
                                <td> {{$i->namaVendor }} </td>
                                @if($i->statuskerja != null)
                                  @if($i->statuskerja == 1)      
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-primary"> Menunggu Konfirmasi Vendor</a></div></td>
                                  @elseif($i->statuskerja == 0)
                                    <td><div> <a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-warning">Pesanan Baru/Dalam Antrian</a></div></td>
                                  @elseif($i->statuskerja == 2)
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-info">Proses Pengerjaan Oleh Vendor</a></div></td>
                                  @elseif($i->statuskerja == 3)
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-danger">GEP Menolak Pesanan</a></div></td>
                                  @elseif($i->statuskerja == 4)
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-danger">Vendor Menolak Pesanan</a></div></td>
                                  @elseif($i->statuskerja == 5)
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-success">Pesanan Selesai</a></div></td>
                                    @elseif($i->statuskerja == 6)
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-success">Negosiasi dari Vendor</a></div></td>
                                    @elseif($i->statuskerja == 7)
                                    <td><div><a href="{{url('/detailpemesanan/'.$i->orderid)}}" class="btn btn-success">Mengajukan negosiasi ke Vendor</a></div></td>
                                  @elseif($i->statuskerja == '')
                                    <td><td>
                                  @endif
                                @else 
                                    <td><div class="badge badge-warning">Menunggu Proses Admin</div></td>
                                @endif
                            </tr>
                          @endforeach
                        </tbody>                        
                      {{ $invoice->links() }}
                    </table>
                  </div>
                </div>
              </div>
            </div>
                    
          </div>
          <div class="row">
            
          </div>
@endsection