@extends('adminlayout.app')

@section('title', 'DetailPesanan')
@section('content')
<div class="row">
              <div class="col-md-12">
              @if(session()->has('berhasil'))
              <div class="alert alert-success">
                {{session()->get('berhasil')}}
              </div>
              @endif
                <div class="card">
                  <div class="card-header">
                    <h4> Detail Pesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{url('/detailpesanan/update/'.$data->id)}}">
                    @csrf
                      <label>No. Invoice</label>
                      <input type="text" class="form-control" readonly="" value="{{$data->id}}">
                      <label>Nama Pemesan</label>
                      <input type="text" name="namaPemesan" class="form-control" readonly value="{{$data->name}}">
                      <label>Jabatan Pemesan</label>
                      <input type="text" name="jabatanPemesan" class="form-control" readonly value="{{$data->jabatanPemesan}}">
                      <label>Nama Perusahaan</label>
                      <input type="text" name="" class="form-control" readonly value="{{$data->brandCustomer}}">
                        <label>Item yang dipesan</label><br>
                        <textarea name="items" rows="5" cols="75" value="{{$data->items_id}}">
                        {{$data->jenisItem}} - {{$data->tipeitem}}
                        </textarea>
                        <br>

                      <label>Referensi Harga Beli (per item)</label>
                      <input type="number" name="hargabeli" class="form-control" readonly value="{{ $data->hargabeli}}" required>
                      <label>Referensi Harga Jual (per item)</label>
                      <input type="number" name="hargajual" class="form-control" readonly value="{{ $data->hargajual}}" required>
                      
                      
                      <label>Qty.</label>
                      <input type="number" name="kuantitas" class="form-control"  value="{{$data->jumlah}}">
                      <label>Harga Satuan</label>
                      <input type="number" name="hargaSatuan" class="form-control"  value="{{$data->hargaSatuan}}">
                      <label>Harga Total</label>
                      <input type="number" name="hargaTotal" class="form-control" readonly value="{{$data->hargaTotal}}">
                      <label>Tanggal Jadi</label>
                      <input type="date" name="tanggaljadi"class="form-control" value="{{$data->tanggaljadi}}"> <br>
                      <label>Tanggal Jatuh Tempo</label>
                      <input type="text" name="jatuhtempo" class="form-control datepickerjatuhtempo" value="{{$data->jatuhtempo}}">
                      <label>Tanggal PO</label>
                      <input type="date" name="tanggalpo"class="form-control" readonly value="{{$data->tanggalpo}}"> <br>
                      @if($data->statuspesanan == 0)
                          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a> 
                      <input class="btn btn-primary mr-1" type="submit" value="Edit">                  
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updatePesanan">
                        update pesanan
                      </button>                  
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tolak">
                        tolak pesanan
                      </button>
                      @elseif($data->statuspesanan == 1)
                          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a> 
                      <input class="btn btn-primary mr-1" type="submit" value="Edit">                  
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tolak">
                        Tolak pesanan / Batalkan
                      </button>
                      @elseif($data->statuspesanan == 3 || $data->statuspesanan == 4)
                          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a> 
                      @else
                          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a> 
                      <input class="btn btn-primary mr-1" type="submit" value="Edit">                  
                      <a href="{{ url('/uploadCek/'.$data->id)}}" class="btn btn-primary">Pembayaran / Pelunasan</a>
                      @endif
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Proses Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ url('/detailpesanan/update/tolakpesanan/'.$data->id)}}" enctype="multipart/form-data">
                    <div class="modal-body">
                      @csrf                      
                      <label>Catatan </label>
                      <input type="text" name="catatan" class="form-control" required>                      
                    </div>
                    <div class="modal-footer">
                    <input type="submit" value="tolak pesanan" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal fade" id="updatePesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Proses Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ url('/detailpesanan/update/prosespesanan/'.$data->id)}}" enctype="multipart/form-data">
                    <div class="modal-body">
                      @csrf
                      <label>Pilih Vendor</label>
                      <select class="form-control" name="namaVendor">                             
                        @foreach($vendor as $v)               
                          <option value="{{$v->id}}">{{$v->namaVendor}} - {{$v->brandVendor}}</option> 
                        @endforeach  
                      </select>
                      <label>Item yang dipesan</label><br>
                        <textarea name="items" rows="5" cols="63" name="nameItem" value="{{$data->items_id}}">
                        {{$data->jenisItem}} - {{$data->tipeitem}}
                        </textarea>
                        <br>
                      <label>Qty.</label>
                      <input type="number" name="kuantitas" class="form-control" readonly value="{{$data->jumlah}}" required>
                      <label>Tanggal Jadi</label>
                      <input type="date" name="tanggaljadi"class="form-control" id="tanggaljadi" readonly value="{{$data->tanggaljadi}}" required> <br>
                      <label> Ubah Status </label>
                        <select class="form-control" name="update">
                            <option value="1">Terima Pesanan</option> 
                            <option value="4">Tolak</option>
                        </select>
                      
                      <label>Referensi Harga Beli(per item)</label>
                      <input type="number" name="hargabeli" class="form-control" readonly value="{{ $data->hargabeli}}" required>
                      <label>Harga Jual ke Pelanggan(per item)</label>
                      <input type="number" name="hargajual" class="form-control" value="{{ $data->hargajual}}" required>
                      <label>Tanggal Jatuh Tempo</label>
                      <input type="text" name="jatuhtempo" class="form-control datepickerjatuhtempo" autocomplete="off">
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
</script>
<script type="text/javascript">
  $('.datepickerjatuhtempo').datepicker({ 
    startDate: new Date()
});
</script>
@endsection