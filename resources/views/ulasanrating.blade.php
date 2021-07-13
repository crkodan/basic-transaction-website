@extends('adminlayout.app')

@section('title', 'UlasanRating')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Rating / Ulasan</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4></h4>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Tanggal Pelunasan</th>
                        <th>Ulasan</th>
                      </tr>
                      @foreach($invoice as $i)
                      <tr>
                        <td><a href="#">{{$i->id}}</a></td>
                        <td class="font-weight-600">{{$i->name}} - {{$i->brandCustomer}}</td>
                        <td class="font-weight-600">{{$i->jenisItem}} - {{$i->tipeitem}}</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>{{$i->tanggalpo}}</td>
                        <td class="font-weight-600">{{$i->catatan}}</td>
                      </tr>
                      @endforeach     
                      {{$invoice->links()}}    
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
@endsection