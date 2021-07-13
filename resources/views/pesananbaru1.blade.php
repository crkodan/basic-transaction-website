@extends('adminlayout.app')

@section('title', 'PesananBaru')
@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Tambah Data Pemesanan </h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ url('/pesananbaru') }}">
                    @csrf
                      <!-- <label>ID Pesanan</label>
                      <input class="form-control" name="namaPemesanan"> -->
                      <label>Nama Pemesan</label>
                      <input class="form-control" name="namaPemesan" Required>
                      <label>Jabatan Pemesan</label>
                      <input class="form-control" name="jabatanPemesan" Required>
                      <label>Perusahaan</label>
                      <select class="form-control" name="namaPerusahaan">                             
                      @foreach($customer as $c)               
                        <option value="{{$c->id}}">{{$c->brandCustomer}} - {{$c->cabangCustomer}}</option> 
                      @endforeach                     
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
                              
                              $print = $print . '<option value="'.$i->jenisItem.'">'.$i->jenisItem .' units</option> '; 

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
                      <label>Vendor Pilihan</label>
                      <select class="form-control" name="vendorid">
                      @foreach($vendor as $v)
                        <option value="{{$v->id}}">{{$v->namaVendor}} - {{$v->brandVendor}}</option>  
                      @endforeach                    
                      </select>                 
                      <label>Qty.</label>
                      <input type="number" name="kuantitas" class="form-control">
                      <label>Tanggal Jatuh Tempo Pembayaran</label>
                      <input type="date" name="tanggalJatuhTempo"class="form-control">
                      <label>Tanggal mulai kerja</label>
                      <input type="date" name="tanggalkerja"class="form-control">
                      <label>Tanggal Jadi</label>
                      <input type="date" name="tanggalJadi"class="form-control">
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
@endsection