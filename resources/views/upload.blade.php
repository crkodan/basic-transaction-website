
@extends('adminlayout.cust')
@section('title', 'Upload')
@section('content')
<body>
	<div class="row">
		<div class="container">
			<h2 class="text-center my-5">Update Pembayaran</h2>
			
			<div class="col-lg-8 mx-auto my-5">	
			@if(count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						{{ $error }} <br/>
						@endforeach
					</div>
					@endif
 
				<form action="{{url('upload/proses/'.$data->id)}}" method="POST" enctype="multipart/form-data" onsubmit="alert('Sukses Mengunggah Bukti Pembayaran, silahkan menghubungi pihak GEP di No. 081233444543 untuk Konfirmasi Pembayaran.');">
					@csrf
					<label>No. Invoice</label>
					<input type="text" name="id" class="form-control" readonly value="{{$data->id}}">
					<label>Nama Pemesan</label>
					<input type="text" name="namaPesanan" class="form-control" readonly value="{{$data->namaPemesan}}">
					<label>Item yang dipesan</label><br>
					<textarea name="items" rows="5" cols="75">
					{{$data->jenisItem}} - {{$data->tipeitem}}
					</textarea><br>
					<label>Qty.</label>
					<input type="number" name="kuantitas" class="form-control"  value="{{$data->jumlah}}">
					<label>Harga Total</label>
					<input type="number" name="kuantitas" class="form-control" readonly value="{{$data->hargaTotal}}">
					<label>Jatuh Tempo</label>
					<input type="date" name="tanggal"class="form-control" value="{{$data->jatuhtempo}}" readonly> <br>
					
					<div class="form-group">
						<b>Unggah Nota</b><br/>
						<input type="file" name="image" id="image" required>
					</div>
 
					<div class="form-group">
						<b>Keterangan</b>
						<textarea class="form-control" name="keterangan" required></textarea>
					</div>
 
					<input type="submit" value="Upload Image" class="btn btn-primary" >
				</form>
				<form action="{{url('updatelunas/'.$data->id)}}" method="POST" onsubmit="alert('Sukses mengupdate ulasan');">
				@csrf
					<!-- <a href="{{ url('/updatelunas/'.$data->id)}}" class="btn btn-primary" value="1" name="lunas">Update Lunas</a> -->
					<label>Ulasan</label>
					<input type="text" name="catatan" class="form-control"><br>
					<!-- <input type="submit" value="Lunas" name="lunas" class="btn btn-primary"> -->
				</form>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="1%">File</th>
							<th>Keterangan</th>
							<th width="1%">OPSI</th>
						</tr>
					</thead>
					<tbody>
					@foreach($payment as $p)
						<tr>
							<td><img width="150px" src="{{ URL::to('/') }}/images_payment/{{ $p->namafile }}"></td>
							<td>{{ $p->keterangan }}</td>
							<td><a class="btn btn-danger" href="#">HAPUS</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				
				<a href="{{ url('/auth-customer') }}" class="btn btn-primary">Kembali</a>
				<br>
			</div>
		</div>
	</div>
</body>

<script>
 //---------------------Browse image----------------
 $('#browse_file').on('click',function(){
                            $('#image').click();                 
                        })
                        $('#image').on('change', function(e){
                            showFile(this, '#showImage');
                        })
</script>
@endsection