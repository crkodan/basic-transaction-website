@extends('adminlayout.cust')

@section('title', 'PesananBaruCustomer')
@section('content')
                     
            <div class="row">
              <div class="col-md-12">
              @if(session()->has('gagal'))
              <div class="alert alert-danger">
                {{session()->get('gagal')}}
              </div>
              @endif
                <div class="card">
                  <div class="card-header">
                    <h4> Tambah Data Pemesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ url('/pesananbarucust') }}">
                    @csrf
                      <label>Nama Pemesan</label>
                      <input class="form-control" name="namaPemesan">
                      <label>Jabatan Pemesan</label>
                      <input class="form-control" name="jabatanPemesan" required>
                      <label>Perusahaan</label>
                      <select class="form-control" name="namaPerusahaan" readonly>                    
                        <option value="{{Auth::user()->id}}">{{ Auth::user()->name }}</option> 
                      </select>
                      <label>Item yang dipesan (Jenis )</label>
                      <select class="form-control" name="jenisItem" id="jenis_item">
                      @php 
                        $def = "";
                        $print = "";
                        foreach($item as $i){
                            if($i->jenisItem == $def){
                              $print = $print . '';
                            
                            }
                            else
                            {
                              $def = $i->jenisItem;
                              
                              $print = $print . '<option value="'.$i->jenisItem.'">'.$i->jenisItem .' </option> '; 

                            }
                        
                        }
                      @endphp

                      {!! $print !!}

                        
             
                      </select>
                      
                      <label>Item yang dipesan (Tipe - Estimasi Harga - Juml.Min. Pemesanan)</label>
                      <select class="form-control" name="nameItem" id="item">
                      @foreach($item as $i)

                        <option value="0"> ---pilih jenis ---</option>  

                      @endforeach                    
                      </select>
                      <label>Qty.(pcs)</label>
                      <input type="number" name="kuantitas" class="form-control" required>
                      <label>Tanggal Jadi</label>
                      <input type="text" name="tanggaljadi" class="form-control datepickertanggaljadi" autocomplete="off">
                      
                      <label>Keterangan / Permintaan Khusus</label>
                      <input type="text" name="keterangan" class="form-control">
                      <label>Pembayaran</label>
                      <select class="form-control" name="tipe_bayar">
                        <option value="0">Tunai</option>
                        <option value="1">Kredit</option>
                      </select>  <br>
                      <button class="btn btn-primary mr-1" type="submit">Submit
                    </form>
                  </div>
                </div>
              </div>
            </div>                      
@endsection

@section('script')

<script>
$('#jenis_item').on('change', function() {
  var array_items = {!! $item !!};
  $('#item').html("");
  for(var i =0 ;i<array_items.length;i++){
      if(array_items[i].jenisItem == $('#jenis_item').val()){
        $('#item').append('<option value="'+ array_items[i].id +'"> '+ array_items[i].tipeitem +' - '+ array_items[i].hargajual +' - '+ array_items[i].jumlahminimal +' units</option>');
      }
  }
  
});

</script>
<script type="text/javascript">
   $('.datepickertanggaljadi').datepicker({ 
    startDate: new Date()
});
</script>

@endsection