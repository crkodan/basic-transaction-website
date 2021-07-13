@extends('adminlayout.app')

@section('title', 'Dashboard')
@section('content')
<section class="section">





          
          <div class="section-body">
            <div class="alert alert-info">
                      <b>Pembukuan</div>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-header-action">  

                    
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#filterbulantahun">Filter Bulan Tahun</button>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalStarBuyerM">Buyer of the Month</button>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalStarBuyerY">Buyer of the Year</button>

                    

                  </div>
                </div>
                
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead><tr>
                              <th>Tanggal</th>
                              <th>No. Invoice</th>
                              <th>Customer</th>
                              <th>Vendor</th>
                              <th>Harga Jual<br>(per unit)</th>
                              <th>Harga Vendor<br>(per unit)</th>
                              <th>Unit Terjual</th>
                              @if(Request::is('pembukuan'))
                              <th>Debit</th>
                              <th>Kredit</th>
                              <th>Laba</th>
                              <th>Saldo</th>
                              @elseif(Request::is('pembukuan/filter'))
                              <th>Debit</th>
                              <th>Kredit</th>
                              <th>Laba</th>
                              <th>Saldo</th>
                              @else
                              <th>Laba</th>
                              @endif
                          </tr></thead>
                          <tbody>
                          <script>var saldo=0</script>
                          @foreach($pembukuan as $p)
                              <tr>
                                <td>{{$p->tanggalpo}}</td>
                                <td>{{$p->invoice}}</td>
                                <td>{{$p->namaPemesan}} - {{$p->brandCustomer}}</td>
                                <td>{{$p->namaVendor}}</td>
                                <td>  <script>
                                    hargasatuan = 0 + {{ $p->hargaSatuan }}
                                    document.write(hargasatuan.toLocaleString("id-ID"))
                                  </script></td>
                                <td> <script>
                                    hargaJual = 0 + {{ $p->hargajual }}
                                    document.write(hargaJual.toLocaleString("id-ID"))
                                  </script></td>
                                <td> {{ $p->jumlah }}</td>
                                @if(Request::is('pembukuan'))
                                <td align ="right"><script>
                                    hargatotal = 0 + {{$p->hargaTotal}}
                                    document.write(hargatotal.toLocaleString("id-ID"))
                                  </script></td>
                                <td align ="right"><script>
                                    Biaya = 0 + {{$p->biaya}}
                                    document.write(Biaya.toLocaleString("id-ID"))
                                  </script></td>
                                <td align ="right"> 
                                    <script>
                                    laba = 0 + {{$p->hargaTotal - $p->biaya}}
                                    document.write(laba.toLocaleString("id-ID"))
                                    </script> 
                                </td>
                                <td align ="right">
                                  <script>
                                    saldo = saldo + {{$p->hargaTotal}} - {{$p->biaya}}
                                    document.write(saldo.toLocaleString("id-ID"))
                                  </script>
                                </td>
                                @elseif(Request::is('pembukuan/filter'))
                                <td align ="right"><script>
                                    hargatotal = 0 + {{$p->hargaTotal}}
                                    document.write(hargatotal.toLocaleString("id-ID"))
                                  </script></td>
                                <td align ="right"><script>
                                    Biaya = 0 + {{$p->biaya}}
                                    document.write(Biaya.toLocaleString("id-ID"))
                                  </script></td>
                                <td align ="right"> 
                                    <script>
                                    laba = 0 + {{$p->hargaTotal - $p->biaya}}
                                    document.write(laba.toLocaleString("id-ID"))
                                    </script> 
                                </td>
                                <td align ="right">
                                  <script>
                                    saldo = saldo + {{$p->hargaTotal}} - {{$p->biaya}}
                                    document.write(saldo.toLocaleString("id-ID"))
                                  </script>
                                </td>
                                @else
                                <td align ="right"> <script>
                                    laba = 0 + {{$p->hargaTotal - $p->biaya}}
                                    document.write(laba.toLocaleString("id-ID"))
                                    </script> 
                                </td>
                                @endif
                          @endforeach
                          </tbody>
                        </table>
                      {{ $pembukuan->links() }}
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          </div>
        </section>
                  <div class="modal fade" id="modalStarBuyerM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Star Buyer of the Month</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('/pembukuan/filterPembukuanStarBuyerM')}}" method="GET">
                      <label >Bulan </label>
                      <select name="month" id="bulan" class="form-control">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select>
                      <label> Tahun</label>
                      <input type="number" name="year" class="form-control" value='2020' required><br>
                      <input type="submit" value="Pembeli dengan Transaksi Terbanyak Bulan Ini" class="btn btn-primary">
                    </form>  
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="modalStarBuyerY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Star Buyer of the Month</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('/pembukuan/filterPembukuanStarBuyerY')}}" method="GET">
                      
                      <label> Tahun</label>
                      <input type="number" name="year" class="form-control" value='2020' required><br>
                      <input type="submit" value="Pembeli dengan Transaksi Terbanyak Tahun Ini" class="btn btn-primary">
                    </form>  
                      </div>
                    </div>
                  </div>


                  <div class="modal fade" id="filterbulantahun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Filter Bulan dan Tahun</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('/pembukuan/filter')}}" method="GET">
                      <label >Bulan </label>
                      <select name="month" id="bulan" class="form-control">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select>
                      <label> Tahun</label>
                      <input type="number" name="year" class="form-control" value='2020' required><br>
                      <input type="submit" value="Filter Berdasarkan Bulan dan Tahun" class="btn btn-primary">
                    </form>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modalNama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Star Buyer</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
@endsection
