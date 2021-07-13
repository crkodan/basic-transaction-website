@extends('adminlayout.app')

@section('title', 'Pelunasan')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
          <div class="alert alert-info">
                      <b>Status Pelunasan Pesanan
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
                          <td>{{$i->jatuhtempo}}</td>
                          @elseif($i->statuspelunasan==1)
                          <td><div class="badge badge-success">Lunas</div></td>
                          @endif
                          <td>-</td>
                          <td>
                            @if($i->statuspelunasan==0)
                            <a href="{{ url('/uploadCek/'.$i->id)}}" class="btn btn-primary">Update Payment</a>
                            @elseif($i->statuspelunasan==1)
                            <a href="{{url('detailpesanan/'.$i->id)}}" class="btn btn-primary">Detail</a>
                            @endif
                          </td>
                                          
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
      <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ url('/upload/proses')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                      <input type="file" name="file">
                                      <input type="submit" value="Upload Image">
                                      <input type="text" value="keterangan">
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>

@endsection