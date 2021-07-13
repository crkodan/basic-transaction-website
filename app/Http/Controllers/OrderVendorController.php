<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gambar;
use App\Customer;
use App\Item;
use App\Vendor;
use App\ItemCustomer;
use App\ItemVendor;
use App\OrderVendor;
use App\Warehouse;
use \Carbon\Carbon;
use App\Payment;
use App\Shipment;
use App\Notification;
use App\NotifVendor;
use App\NotifCustomer;
use App\BuktiCustomer;
use App\BuktiVendor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Http\Controllers\Controller;
use auth;

class OrderVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function catatanVendor(){
        $listCatatan = DB::table('ordervendors')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('vendors.*','ordervendors.*')
                    ->paginate(10);
        return view('catatanvendor',compact('listCatatan'));
    }
    public function tambahCatatanVendor(){
        $spk = DB::table('ordervendors')
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->select('vendors.*','ordervendors.*')
        ->get();
        return view('tambahcatatanvendor',compact('spk'));
    }
    public function detaillunas($id){
        $data = OrderVendor::find($id);
		$gambar = BuktiVendor::where('bukti_vendors.ordervendor_id',$id)->join('ordervendors','ordervendors.id','bukti_vendors.ordervendor_id')->get();
        return view('uploadvendor',compact('data','gambar'));
    }    
    public function cekdetaillunas($id){
        $data = OrderVendor::join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->select('itemcustomers.invoice','vendors.namaVendor','ordervendors.*')->find($id);
        $gambar = BuktiVendor::where('bukti_vendors.ordervendor_id',$id)->join('ordervendors','ordervendors.id','bukti_vendors.ordervendor_id')->get();
        // dd($data);
        return view('uploadvendorCek',compact('data','gambar'));
    }    
    public function index()
    {
        $orders = DB::table('ordervendors')
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->select('vendors.*','itemcustomers.*','ordervendors.*')
        ->paginate(10);
        return view('dashboard',compact('orders'));
    }
    public function rekap(){        
        $invoice = DB::table('ordervendors')
        ->orderBy('ordervendors.tanggalpo','ASC')
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->select('vendors.*','itemcustomers.*','ordervendors.*')
        ->paginate(10);
        return view('daftarpemesanan',compact('invoice'));
    }
    public function filter(Request $request){
        $filter = $request->statuskerja;
             
        $invoice = DB::table('ordervendors')
        ->orderBy('ordervendors.tanggalpo','ASC')
        ->where('ordervendors.statuskerja',$filter)
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->select('vendors.*','itemcustomers.*','ordervendors.*')
        ->paginate(10);

        return view('daftarpemesanan',compact('invoice'));
    }
    public function uploadNotaVendor(){
        $listCatatan = DB::table('ordervendors')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('vendors.*','ordervendors.*')
                    ->paginate(10);
        return view('auth-vendor',compact('listCatatan'));
    }
    public function updateselesai(Request $request, $id){
        $order = OrderVendor::join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')->select('ordervendors.*','itemcustomers.id as invoiceid')->find($id);
        $checker = $order->itemcustomer_id;
        $itemCust = ItemCustomer::where('itemcustomers.id',$checker)->where('ordervendors.id',$id)->join('ordervendors','ordervendors.itemcustomer_id','=','itemcustomers.id')->select('itemcustomers.id','itemcustomers.statuspesanan')->first();        
        $order->statuskerja = 5;
        $order->statuspelunasan = 1;
        $order->catatan = $request->keterangan;
        $order->save();
        $itemCust->statuspesanan = 4;
        $itemCust->save();
        return back();
    }

    public function pesananVendor(){
        $listCatatan = DB::table('ordervendors')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('vendors.*','ordervendors.*')
                    ->paginate(10);
        return view('pesananvendor',compact('listCatatan'));
    }
    public function updatePemesanan(Request $request,$id){
        $data = OrderVendor::find($id);
        $data->tanggalpo =  $request->tanggalpo;
        $data->jatuhtempo = $request->jatuhtempo;
        $data->tanggaljadi = $request->tanggaljadi;
        $data->tanggalkerja = $request->tanggalkerja;
        $data->jumlah = $request->kuantitas;
        $data->hargajual = $request ->hargasatuan;
        $data->biaya = $request->hargasatuan * $request->kuantitas;
        $data->save();
        return back();
    }
    public function getOrder($id){
        $data = OrderVendor::where('ordervendors.id',$id)
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('items','items.id','=','itemcustomers.item_id')
        ->join('customers','customers.id','=','itemcustomers.customer_id')
        ->select('items.jenisItem','items.hargabeli','items.tipeitem','vendors.namaVendor','vendors.brandVendor'
        ,'itemcustomers.invoice','itemcustomers.jabatanPemesan','customers.brandCustomer','ordervendors.tanggalpo','ordervendors.id','ordervendors.orderinvoice'
        ,'ordervendors.jatuhtempo','ordervendors.jumlah','ordervendors.tanggaljadi','ordervendors.tanggalkerja','ordervendors.biaya','ordervendors.hargajual','itemcustomers.id as invoiceid')
        ->first();
        // dd($data);
        return view('ambilorder',compact('data'));
    }
    public function prosesorder(Request $request, $id){
        $d = strtotime($request->tanggaljadi);
        $dt = Carbon::parse($d);
        $update = OrderVendor::find($id);
        $date = Carbon::now('Asia/Bangkok');
        $update->tanggalkerja = $date;
        $update->tanggaljadi = $dt;
        $update->biaya = $request->harga * $request->kuantitas;
        $update->hargajual = $request->harga;
        $update->statuskerja = $request->update;
        $update->catatan = $request->catatan;
        $update->save();
        return redirect('/dashboard');
    }
    public function prosesnego(Request $request, $id){
        $order = OrderVendor::join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')->select('ordervendors.*','itemcustomers.id as invoiceid')->find($id);
        $checker = $order->itemcustomer_id;
        $itemCust = ItemCustomer::where('itemcustomers.id',$checker)->where('ordervendors.id',$id)->join('ordervendors','ordervendors.itemcustomer_id','=','itemcustomers.id')->select('itemcustomers.id','itemcustomers.statuspesanan')->first();        
        $order->hargajual = $request->hargasatuan;
        $order->statuskerja = $request->update;
        $order->catatan = $request->catatan;
        $order->save();
        if($request->update == 2){
            $itemCust->statuspesanan = 2;
            $itemCust->save();
        } else {
            $itemCust->statuspesanan = 1;
            $itemCust->save();
        }
        return redirect('/dashboard');
    }
    public function detailPemesanan($id){
        $data = OrderVendor::where('ordervendors.id',$id)
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('items','items.id','=','itemcustomers.item_id')
        ->join('customers','customers.id','=','itemcustomers.customer_id')
        ->select('items.jenisItem','items.hargabeli','items.hargajual','items.tipeitem','vendors.namaVendor','vendors.brandVendor'
        ,'itemcustomers.invoice','itemcustomers.jabatanPemesan','customers.brandCustomer','ordervendors.tanggalpo','ordervendors.id'
        ,'ordervendors.jatuhtempo','ordervendors.jumlah','ordervendors.tanggaljadi','ordervendors.tanggalkerja','ordervendors.biaya','ordervendors.hargajual','ordervendors.biaya','ordervendors.statuskerja')
        ->first();
        // dd($data);
        return view('detailpemesanan',compact('data'));
    }

    public function cekBayar(Request $request, $id){
        $order = OrderVendor::find($id);
        $order->statuspelunasan = 2;
        $order->save();
        return redirect('/auth-vendor');
    }
    public function konfirmasi(Request $request, $id){
        $order = OrderVendor::find($id);
        $order->statuspelunasan = 1;
        $order->save();
        return redirect()->action(
            'OrderVendorController@cekdetaillunas', ['id' => $id]
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pesanVendor = OrderVendor::get();
        $vendor = Vendor::get();
        $item = Item::get();
        $invoice = ItemCustomer::join('customers','customers.id','=','itemcustomers.customer_id')
                    ->select('customers.brandCustomer','itemcustomers.*')
                    ->get();
        return view('pemesananvendor',compact('pesanVendor','item','vendor','invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = OrderVendor::where('ordervendors.id',$id)
        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
        ->join('items','items.id','=','itemcustomers.item_id')
        ->join('customers','customers.id','=','itemcustomers.customer_id')
        ->select('items.jenisItem','items.hargabeli','items.tipeitem','vendors.namaVendor','vendors.brandVendor'
        ,'itemcustomers.invoice','itemcustomers.jabatanPemesan','customers.brandCustomer','ordervendors.tanggalpo','ordervendors.id'
        ,'ordervendors.jatuhtempo','ordervendors.jumlah','ordervendors.tanggaljadi','ordervendors.tanggalkerja','ordervendors.biaya')
        ->first();
        // dd($data);
        return view('detailpemesanan',compact('data'));
    }
    public function prosespesanan(Request $request){
        $date = Carbon::Today('Asia/Bangkok');
        $orderBaru = new OrderVendor();
        $idPesanan = Auth::user()->id;
        $invoice = Auth::user()->username;
        $orderBaru->itemCustomer_id = $idPesanan;
        $orderBaru->vendor_id = $request->namaVendor;
        $orderBaru->tanggalpo = $date;
        $orderBaru->jatuhtempo = $request->jatuhtempo;
        $orderBaru->tanggalkerja = $request->tanggalkerja;
        $orderBaru->jumlah = $request->kuantitas;
        $orderBaru->statuspelunasan = 0;
        $orderBaru->statuskerja = 0;
        $orderBaru->save();
        return redirect('/dashboard');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = OrderVendor::find($id);
        $data->vendor_id = $request->vendorid;
        $data->tanggalpo =  $request->tanggalpo;
        $data->jatuhtempo = $request->jatuhtempo;
        $data->tanggaljadi = $request->tanggaljadi;
        $data->tanggalkerja = $request->tanggalkerja;
        $data->jumlah = $request->kuantitas;
        $totalHarga = $request->hargasatuan * $request->kuantitas;
        $data->biaya = $totalHarga;
        $data->save();
        return redirect('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
