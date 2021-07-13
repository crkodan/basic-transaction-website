@extends('adminlayout.app')

@section('title', 'DetailPesanan')
@section('content')
<div class="card-body">
<br>
                    <form method="POST" action="{{url('/detailpemesanan/update/'.$data->id)}}">
                    @csrf
                      <label>Nama Vendor</label>
                      <input type="text" name="" class="form-control" readonly value="{{$data->namaVendor}}">
                      <label>Nama Perusahaan</label>
                      <input type="text" name="" class="form-control" readonly value="{{$data->brandVendor}}">
                        <label>Item pesanan</label><br>
                        <textarea name="items" rows="5" cols="75" name="items">
                        {{$data->jenisItem}} - {{$data->tipeitem}}
                        </textarea>
                        <br>
                      <label>Invoice</label>
                      <input type="text" name="" class="form-control" readonly value="{{$data->invoice}}">
                      <label>Perusahaan</label>
                      <input type="text" name="" class="form-control" readonly value="{{$data->brandCustomer}}">
                      <label>Qty.</label>
                      <input type="number" name="kuantitas" class="form-control"  value="{{$data->jumlah}}">
                      <label>Harga Satuan</label>
                      <input type="number" name="hargasatuan" class="form-control"  value="{{$data->hargajual}}">
                      <label>Harga Total</label>
                      <input type="number" name="" class="form-control" readonly value="{{$data->biaya}}">
                      <label>Tanggal kerja</label>
                      <input type="date" name="tanggalfaktur"class="form-control" readonly value="{{$data->tanggalkerja}}" readonly> 
                      <br>
                      <label>Tanggal Jadi</label>
                      <input type="date" name="tanggaljadi"class="form-control" id="tanggaljadi" value="{{$data->tanggaljadi}}"> <br>
                      <label>Tanggal PO</label>
                      <input type="date" name="tanggalpo"class="form-control" readonly value="{{$data->tanggalpo}}"> <br>
                      <label>Tanggal Jatuh Tempo</label>
                      <input type="date" name="jatuhtempo"class="form-control" readonly value="{{$data->jatuhtempo}}"> <br>
                      @if($data->statuskerja == 0)
                      <input class="btn btn-primary mr-1" type="submit" value="Edit"><br>                       
                      @elseif($data->statuskerja == 1 || $data->statuskerja == 6)
                      <input class="btn btn-primary mr-1" type="submit" value="Edit"><br>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProsesNego">update pesanan</button>  
                      @elseif($data->statuskerja == 2)
                      <input class="btn btn-primary mr-1" type="submit" value="Edit"><br>
                      <a href="{{ url('/uploadvendorCek/'.$data->id)}}" class="btn btn-primary">Pembayaran / Pengiriman</a>
                      @elseif($data->statuskerja == 3 || $data->statuskerja == 4 || $data->statuskerja == 7)
                          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a> 
                     
                      @endif
                    </form>
                  </div>

                  <div class="modal fade" id="ProsesNego" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Proses Pesanan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ url('/detailpemesanan/update/prosesnego/'.$data->id)}}" enctype="multipart/form-data">
                          <div class="modal-body">
                            @csrf             
                            <input type="hidden" id="custId" name="custId" value="{{$data->invoiceid}}">         
                            <label>Vendor</label>
                            <input type="text" name="" class="form-control" readonly value="{{$data->namaVendor}}" required>
                            <label>Item yang dipesan</label><br>
                              <textarea name="items" rows="5" cols="60" name="nameItem" readonly value="{{$data->items_id}}">
                              {{$data->jenisItem}} - {{$data->tipeitem}}
                              </textarea>
                              <br>
                            <label>Qty.</label>
                            <input type="number" name="kuantitas" class="form-control" readonly value="{{$data->jumlah}}" required>
                            <label>Tanggal Jadi</label>
                            <input type="date" name="tanggaljadi"class="form-control" id="tanggaljadi" readonly value="{{$data->tanggaljadi}}" required> <br>
                            <label>Harga Beli dari Vendor (referensi)</label>
                            <input type="number" name="hargabeli" class="form-control" readonly value="{{ $data->hargabeli}}" required>
                            <label>Harga Jual ke Customer (referensi)</label>
                            <input type="number" name="hargajual" class="form-control" readonly value="{{ $data->hargajual}}" required>
                            <label>Harga Satuan</label>
                            <input type="number" name="hargasatuan" class="form-control" value="{{ $data->hargajual}}" required>
                            <label>Harga Total</label>
                            <input type="number" name="hargaTotal" class="form-control" readonly value="{{ $data->biaya}}" required>
                            <label>Tanggal Jatuh Tempo</label>
                            <input type="date" name="jatuhtempo"class="form-control" id="jatuhtempo"  readonly value="{{ $data->jatuhtempo}}"> <br>
                              <label> Proses Negosiasi </label>
                              <select class="form-control" name="update">
                              @if($data->statuskerja == 0)
                                  <option value="7">Negosiasi harga</option> 
                                  <option value="3">Tolak Penawaran</option>
                              @elseif($data->statuskerja == 6)
                                  <option value="7">Negosiasi harga</option> 
                                  <option value="2">Terima Penawaran</option> 
                                  <option value="3">Tolak Penawaran</option>
                              @else
                              </select>
                              <label>Alasan Proses negosiasi</label>
                              <input type="text" name="catatan" class="form-control" required>
                              @endif
                          </div>
                          <div class="modal-footer">
                          <input type="submit" value="Proses pesanan" class="btn btn-primary">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

@endsection
@section('script')

<script type="text/javascript">
  $(function(){
    $('#tanggaljadi').datetimepicker({
      minDate:new Date();
    });
  });

  $(function(){
    $('#jatuhtempo').datetimepicker({
      minDate:new Date();
    });
  });
</script>

@endsection