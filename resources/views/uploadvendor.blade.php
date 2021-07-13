
@extends('adminlayout.vendor')

@section('title', 'Upload')
@section('content')
<body>
	<div class="row">
		<div class="container">
			<h2 class="text-center my-5">Update Pembayaran/Pengiriman Vendor</h2>
			
			<div class="col-lg-8 mx-auto my-5">	
			@if(count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						{{ $error }} <br/>
						@endforeach
					</div>
					@endif
 
				<form action="{{url('/uploadvendor/proses_vendor/'.$data->id)}}" method="POST" enctype="multipart/form-data">
					@csrf
					<label>No. Order</label>
					<input type="text" name="id" class="form-control" readonly value="{{$data->id}}">
					<label>Harga Total</label>
					<input type="number" name="kuantitas" class="form-control" readonly value="{{$data->biaya}}">
					<label>Tanggal barang jadi</label>
					<input type="date" name="tanggal"class="form-control" value="{{$data->tanggaljadi}}" readonly> <br>
					
					<div class="form-group">
						<b>Unggah Bukti Pengiriman</b><br/>
						<input type="file" name="image" id="image">
					</div>
 
					<div class="form-group">
						<b>Keterangan</b>
						<textarea class="form-control" name="keterangan"></textarea>
					</div>
 
					<input type="submit" value="Upload Image" class="btn btn-primary">
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
					@foreach($gambar as $s)
						<tr>
							<td><img width="150px" src="{{ URL::to('/') }}/images_shipments/{{ $s->namafile }}"></td>
							<td>{{ $s->keterangan }}</td>
							<td><a class="btn btn-danger" href="#">HAPUS</a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				@if($data->statuspelunasan !=2)
				<form action="{{url('/uploadvendor/'.$data->id)}}" method="POST" onsubmit="alert('Konfirmasi lunas berhasil');">
				@csrf
					<!-- <a href="{{ url('/updatelunas/'.$data->id)}}" class="btn btn-primary" value="1" name="lunas">Update Lunas</a> --><br>
					<!-- <label>Catatan Pesanan</label>
					<input type="text" name="keterangan" class="form-control" > -->
					<input type="submit" value="Verifikasi Pembayaran" name="selesai" class="btn btn-primary">
				</form>
				<a href="{{ url('/auth-customer') }}" class="btn btn-primary">Kembali</a>
				@else
				<a href="{{ url('/auth-customer') }}" class="btn btn-primary">Kembali</a>
				@endif
			</div>
		</div>
	</div>
</body>
@endsection