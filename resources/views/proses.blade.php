@extends('adminlayout.app')

@section('title', 'Input')
@section('content')
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3>Form Proses</h3>
                        <h3 class="my-4">Data Yang Di Input : </h3>
 
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td style="width:150px">Nama File</td>
                                <td>{{ $data->namafile }}</td>
                            </tr>
                            <tr>
                                <td>Ekstensi</td>
                                <td>{{ $data->ext }}</td>
                            </tr>
                        </table>
 
                        <a href="/input" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection