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
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <form method="POST" action="{{ url('/pengguna/aktivasi/aktif/'.$user->id) }}">
                    <div class="modal-body">
                      @csrf
                      <table class="table table-striped">
                            <tr>
                              <th>Nama pendaftar</th>
                              <th>{{$user->name}}</th>
                              <th></th>
                            </tr><tr>
                              <th>Email pendaftar</th>
                              <th>{{$user->email}}</th>
                              <th></th>
                            </tr>
                            <tr>
                              <th>Status Pendaftar</th>
                              <th>{{$user->role}}</th>
                              <th></th>
                            </tr>
                            <tr>
                              <th>Tanggal Mendaftar : </th>
                              <th>{{ $user->created_at->format('d M Y')}}</th>
                              <th></th>
                            </tr>
                      </table>  
                    </div>
                    <div class="modal-footer">
                    @if($user->active != "active")
                      <input type="submit" value="aktivasi" name="aktivasi" class="btn btn-primary" onclick="alert('Aktivasi Sukses');">
                    @else
                      <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>   
                    @endif                   
                    </div>
                  </form>
                    <form method="POST" action="{{url('/pengguna/aktivasi/tolak/'.$user->id)}}">
                      @csrf                    
                      <div class="modal-footer">
                        @if($user->active == "refused")
                          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>  
                        @else
                          <input type="submit" value="Tolak / Non-Aktif" name="aktivasi" class="btn btn-primary" onclick="alert('Akun Dinonaktifkan');">
                        @endif
                      </div>
                    </form>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
      
      
@endsection