@extends('adminlayout.app')

@section('title', 'DaftarPesanan')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            @if(session()->has('berhasil'))
              <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>  {{ session('berhasil') }}</strong>
                    </div>

              </div>
            @elseif(session()->has('gagal'))
              <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>{{ session('gagal') }}</strong>
                    </div>
                
              </div>
                
            @endif
            <div class="alert alert-info">
                      <b>Kelola Pengguna
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                <!--  -->
                  <div class="card-header-action">
                  </div>
                
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th><b>ID</b></th>
                        <th><b>Nama</b></th>
                        <th><b>Email</b></th>
                        <th><b>Jenis Pengguna (Role)</b></th>
                        <th><b>Action</b></th>
                      </tr>        
                      @foreach($user as $u)
                      <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->role}}</td>
                        <td>
                            @if($u->active == "active")
                              <a href="{{ url('/pengguna/aktivasi/'.$u->id)}}" class="btn btn-success">Aktif</a>
                            @elseif($u->active == "refused")
                              <a href="{{ url('/pengguna/aktivasi/'.$u->id)}}" class="btn btn-danger">Non-aktif</a>      
                            @else                              
                              <a href="{{ url('/pengguna/aktivasi/'.$u->id)}}" class="btn btn-primary">Detail dan proses</a>                      
                            @endif
                        </td>
                      </tr>
                      @endforeach
                      
                    </table>
                    <!--  -->
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection