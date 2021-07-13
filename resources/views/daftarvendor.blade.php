@extends('adminlayout.app')

@section('title', 'DaftarVendor')
@section('content')
<div class="main-content">
        <section class="section">

          <div class="section-body">
            <div class="alert alert-info">
                      <b>Daftar Vendor</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>
                    <a href="tambahvendor" class="btn btn-primary">Tambah Vendor Baru</a></h4>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>ID Vendor</th>
                        <th>Nama Vendor</th>
                        <th>Tanggal Mendaftar</th>
                        <th>Jenis Usaha Vendor</th>
                        <th>Brand Vendor</th>
                        <th>Kategori Vendor</th>
                        <th></th>
                      </tr>
                      @foreach($vendor as $v)
                      <tr>
                        <td><a href="#">{{ $v->id }}</a></td>
                        <td class="font-weight-600">{{ $v->namaVendor }}</td>
                        <td>{{ $v->created_at->format('d M Y') }}</td>
                        <td class="font-weight-600">{{ $v->jenisUsahaVendor }}</td>
                        <td class="font-weight-600">{{ $v->brandVendor }}</td>
                        <td class="font-weight-600">{{ $v->kategoriVendor }}</td>
                        <td>
                        @if($v->active == "0")                  
                        <a href="{{ url('/daftarvendor/aktivasivendor/'.$v->id)}}" class="btn btn-primary">Aktivasi</a>
                        @elseif($v->active == "active")
                        <a href="{{ url('/detailvendor/'.$v->id)}}" class="btn btn-primary">Detail</a>
                        <a href="{{ url('/pesananvendor/'.$v->id)}}" class="btn btn-primary">Histori Transaksi</a>
                        @endif
                        </td>
                        
                      </tr>   
                      @endforeach
                      {{ $vendor->links() }}
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
      
      
@endsection