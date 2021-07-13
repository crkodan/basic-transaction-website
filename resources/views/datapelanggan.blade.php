@extends('adminlayout.app')

@section('title', 'DataPelanggan')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Data Pelanggan</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="tambahcust" class="btn btn-primary">Tambah Pelanggan Baru</a>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Alamat</th>
                        <th>Kategori </th>
                        <th></th>
                      </tr>
                      @foreach($customer as $c)
                        <tr>
                          <td><a href="#">{{ $c->id }}</a></td>
                          <td>{{ $c->brandCustomer }} </td>
                          <td>{{$c->alamatCustomer}}    </td>
                          <td>{{$c->kategoriCustomer}}  </td>
                          <td>
                            <a href="{{ url('/detailpelanggan/'.$c->id) }}" class="btn btn-primary">Detail</a>
                            <a href="{{ url('/datapelanggan/historypelanggan/'.$c->id) }}" class="btn btn-primary">Histori Pesanan</a>
                          </td>
                        </tr>
                     @endforeach
                     {{ $customer->links() }}
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