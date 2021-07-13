@extends('adminlayout.app')

@section('title', 'Notifikasi')
@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                  <div class="card-header">
                    <h4> Notifikasi </h4>
                  </div>

                  <div class="card-body">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                        <tr>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                        @foreach($dataNotif as $dn)
                        <tr>
                            <th>{{ $dn->created_at }}</th>
                            <th>{{ $dn->notifikasi }}</th>
                            <th><a href="{{url('notifikasi')}}" class="btn btn-primary">Detail</a></th>
                        </tr>
                        @endforeach
                        </table>
                      </div>        
                  </div>

                </div>
              </div>
            </div>       
@endsection