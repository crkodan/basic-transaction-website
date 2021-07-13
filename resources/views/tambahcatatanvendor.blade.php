@extends('adminlayout.app')

@section('title', 'TambahCatatanVendor')
@section('content')
<div class="main-content">
        <section class="section">
          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Tambah/Ubah Catatan Vendor
                    </div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4> </h4></div>
                  <div class="card-body">
                    <form method="POST" action="">
                      @csrf
                      <label>No. Invoice</label>
                      <select class="form-control">
                        <option></option>
                      </select>                   
                      <label>Catatan</label>
                      <input type="text" class="form-control">
                    </form>
                    <div class="form-group">
                      <label>ID Vendor</label>
                      <input type="text" class="form-control" readonly="">
                    </div>
                   
                  
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Edit</button>

                  </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
      </div>
@endsection