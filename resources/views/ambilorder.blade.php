@extends('adminlayout.vendor')

@section('title', 'PesananBaruCustomer')
@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Tambah Data Pemesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{url('/detailpemesanan/update/'.$data->id)}}">
                      @csrf
                        <label>No. Order</label>
                        <input type="text" class="form-control" readonly="" value="{{$data->id}}">
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
                        <input type="text" name="" class="form-control" readonly value="{{$data->orderinvoice}}">
                        <label>Perusahaan</label>
                        <input type="text" name="" class="form-control" readonly value="{{$data->brandCustomer}}">
                        <label>Qty.</label>
                        <input type="number" name="kuantitas" class="form-control"  readonly value="{{$data->jumlah}}">
                        <label>Harga Satuan</label>
                        <input type="number" name="hargajual" class="form-control"  readonly value="{{$data->hargajual}}">
                        <label>Harga Total</label>
                        <input type="number" name="" class="form-control" readonly value="{{$data->biaya}}">
                        <label>Tanggal Kerja</label>
                        <input type="date" name="tanggalfaktur"class="form-control" readonly value="{{($data->tanggalkerja)}}" readonly> <br>
                        <label>Tanggal Jadi</label>
                        <input type="date" name="tanggaljadi"class="form-control" readonly value="{{($data->tanggaljadi)}}"> <br>
                        <label>Tanggal PO</label>
                        <input type="date" name="tanggalpo"class="form-control" readonly value="{{($data->tanggalpo)}}"> <br>
                        <label>Tanggal Jatuh Tempo</label>
                        <input type="date" name="jatuhtempo"class="form-control" readonly value="{{($data->jatuhtempo)}}"> <br>
                        @if($data->statuskerja == 0)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prosespesanan">
                        Proses
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        @else
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        <a href="{{ url('/uploadvendor/'.$data->id)}}" class="btn btn-primary">Update Payment</a>
                        @endif
                    </form>                  
                  </div>
                </div>
              </div>
            </div>     
            <div class="modal fade" id="prosespesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Proses / Tolak Pesanan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ url('/detailpemesanan/ambilorder/prosesorder/'.$data->id)}}" enctype="multipart/form-data">
                      <div class="modal-body">
                        @csrf
                        <label>Qty.</label>
                        <input type="number" name="kuantitas" class="form-control"  value="{{$data->jumlah}}">
                        <label>Tanggal Jadi</label>
                      <input type="text" name="tanggaljadi" class="form-control datepickertanggaljadi" autocomplete="off">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{$data->hargajual}}" class="form-control">
                        <label> Ubah Status </label>
                        <select class="form-control" name="update">
                        @if($data->statuskerja == 0)
                            <option value="6">Berikan negosiasi</option> 
                            <option value="4">Tolak</option>
                        @elseif($data->statuskerja == 7)
                            <option value="1">Terima Pesanan</option> 
                            <option value="6">Berikan negosiasi</option> 
                            <option value="4">Tolak</option>
                        @endif
                        </select>
                        <label>Alasan Perubahan Status</label>
                        <input type="text" name="catatan" class="form-control">
                      </div>
                      <div class="modal-footer">
                      <input type="submit" value="Proses Pesanan" class="btn btn-primary">
                      </div>
                    </form>
          </div>
        </div>
      </div>  

@endsection
@section('script')
<script type="text/javascript">
  $('.datepickertanggaljadi').datepicker({ 
    startDate: new Date()
});
</script>               
@endsection