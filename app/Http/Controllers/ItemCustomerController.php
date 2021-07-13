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
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Http\Controllers\Controller;
use auth;

class ItemCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateLunas(Request $request, $id){
        $pelunasan = ItemCustomer::find($id);
        $pelunasan->statuspelunasan = 1;
        $pelunasan->catatan = $request->catatan;
        $pelunasan->save();
        return back();
    }
    public function index()
    {
        //
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('items','items.id','=','itemcustomers.item_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('items.*','customers.*','itemcustomers.*','users.name')
                    ->paginate(10);  
        return view('dashboard',compact('invoice'));
    }    
    public function uploadNotaPelanggan(){
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('customers.*','itemcustomers.*','users.name')
                    ->get();
        return view('auth-customer', compact('invoice'));
    }
    public function pesananPelanggan(){
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('customers.*','itemcustomers.*','users.name')
                    ->get();
        return view('pesananpelanggan', compact('invoice'));
    }
    public function Pelunasan(){
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('customers.*','itemcustomers.*','users.name')
                    ->get();
        return view('pelunasan', compact('invoice'));
    }
    public function rating(){
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('items','items.id','=','itemcustomers.item_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->where('statuspelunasan','=',1)
                    ->select('customers.brandCustomer','itemcustomers.*','items.jenisItem','items.tipeitem','users.name')
                    ->paginate(10);
        return view('ulasanrating', compact('invoice'));
    }
    public function listPO(){
        $invoice = DB::table('itemcustomers')
                    ->orderBy('itemcustomers.tanggalpo','ASC')
                    ->join('customers', 'customers.id','=','itemcustomers.customer_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('customers.*','itemcustomers.*','users.name')
                    ->paginate(10);
        return view('daftarpesanan', compact('invoice'));
    }
    public function filtering(Request $request){
        $filter = $request->statuspesanan;
        $invoice = DB::table('itemcustomers')
                    ->orderBy('itemcustomers.tanggalpo','ASC')
                    ->where('itemcustomers.statuspesanan',$filter)
                    ->join('customers', 'customers.id','=','itemcustomers.customer_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('customers.*','itemcustomers.*','users.name')
                    ->paginate(10);
        return view('daftarpesanan', compact('invoice'));        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailpelunasan($id){
        $data = ItemCustomer::where('itemcustomers.id',$id)
        ->join('customers','customers.id','=','itemcustomers.customer_id')
        ->join('items','items.id','=','itemcustomers.item_id')
        ->join('users','users.id','=','itemcustomers.user_id')
        ->select('items.jenisItem','items.tipeitem','customers.brandCustomer','itemcustomers.*','users.name')
        ->first();
        $payment = BuktiCustomer::where('bukti_customers.itemcustomer_id',$id)
                    ->get();
        return view('upload',compact('data','payment'));

    }
    //
    public function cekdetailpelunasan($id){
        $data = ItemCustomer::where('itemcustomers.id',$id)
        ->join('customers','customers.id','=','itemcustomers.customer_id')
        ->join('items','items.id','=','itemcustomers.item_id')
        ->join('users','users.id','=','itemcustomers.user_id')
        ->select('items.jenisItem','items.tipeitem','customers.brandCustomer','itemcustomers.*','users.name')
        ->first();
        $payment = BuktiCustomer::where('bukti_customers.itemcustomer_id',$id)
                    ->get();
        return view('uploadCek',compact('data','payment'));

    }
    //
    public function create()
    {
        $customer = Customer::get();
        $item = Item::get();
        $itemCustomer = ItemCustomer::get();
        $vendor = Vendor::get();
        $user = User::where('role','customer')->get();
        return view('pesananbaru',compact('customer','item','itemCustomer','vendor','user'));
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
        $d = Carbon::parse($request->tanggaljadi);
        $s = Carbon::parse($request->jatuhtempo);
        $item = Item::get();
        $idItem = $request->nameItem;
        $cekItem = Item::find($idItem);
        $pengecekan = $cekItem->stockjumlah;
        $customerid = Customer::where('id',$request->namaPerusahaan)->first();
        $date = Carbon::today('Asia/Bangkok');
        $minim = $cekItem->jumlahminimal;
        $inname = substr($request->jabatanPemesan,0,1);
        $pms = substr($request->namaPemesan,0,1);
        $invoiceCode = $pms.'/'.$customerid->id.'/'.$inname.'/'.$date->format('d/m/Y').'/'.$request->nameItem.'/'.$request->kuantitas;
        foreach($item as $i)
        {

            if($i->id == $idItem && $request->kuantitas < $pengecekan && $request->kuantitas >= $minim)
            {
                $pesananBaru = new ItemCustomer;
                $pesanVendor = new orderVendor;
                $totalHarga = $i->hargajual * $request->kuantitas;
                $hargaVendor = $request->kuantitas * $i->hargabeli;
                $pesananBaru->user_id = $customerid->user_id;
                $pesananBaru->customer_id = $request->namaPerusahaan;
                $pesananBaru->item_id = $request->nameItem;
                $pesananBaru->invoice = $invoiceCode;
                $pesananBaru->namaPemesan = $request->namaPemesan;
                $pesananBaru->jabatanPemesan = $request->jabatanPemesan;
                $pesananBaru->tanggalpo = $date;
                $pesananBaru->jatuhtempo = $s;
                $pesananBaru->tanggaljadi = $d;
                $pesananBaru->jumlah = $request->kuantitas;
                $pesananBaru->hargaSatuan = $i->hargajual;
                $pesananBaru->hargaTotal = $i->hargajual * $request->kuantitas;
                $pesananBaru->statuspelunasan = 0;
                $pesananBaru->statuspesanan = 0;
                $pesananBaru->jenispembayaran = $request->tipe_bayar;
                $pesananBaru->penerimafaktur = $request->vendorid;
                $pesananBaru->save();
                $icmast = ItemCustomer::where('invoice',$invoiceCode)->where('jabatanPemesan',$request->jabatanPemesan)->first();
                $pesanVendor->itemcustomer_id = $icmast->id;
                $pesanVendor->orderinvoice = "O".'/'.$request->namaVendor.'/'.$date->format('d/m/Y').'/'.$icmast->id.'/'.$request->kuantitas;
                $pesanVendor->vendor_id = $request->vendorid;
                $pesanVendor->tanggalpo = $date;
                $pesanVendor->tanggaljadi = $d;
                $pesanVendor->jumlah = $request->kuantitas;
                $pesanVendor->biaya = $hargaVendor;
                $pesanVendor->statuspelunasan = 0;
                $pesanVendor->statuskerja = 0;
                $pesanVendor->hargajual = $i->hargabeli;
                $pesanVendor->save();
                $sisa = $pengecekan - $request->kuantitas;
                $i->stockjumlah = $sisa;
                $i->save();
                session()->flash('berhasil','Pesanan akan diproses!');
                return redirect()->action(
                    'ItemCustomerController@edit', ['id' => $icmast->id]
                );
            }
            else if($request->kuantitas >= $pengecekan){
                session()->flash('gagal','Jumlah Item pesanan melebihi stock!');
                return redirect('pesananbaru');
            }
            else if($request->kuantitas < $minim){
                session()->flash('gagal','Jumlah Item kurang minimal pemesanan!');
                return redirect('pesananbaru');
            }
        }
        // return redirect()->action(
        //     'ItemCustomerController@edit', ['id' => $icmast->id]
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = DB::table('itemcustomers')
                    ->where('customers.id',$id)
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('items','items.id','=','itemcustomers.item_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('itemcustomers.*','items.jenisItem','items.tipeitem','customers.brandCustomer','customers.alamatCustomer','customers.kotaCustomer','users.name')
                    ->paginate(10);
        return view('historypelanggan',compact('customer'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('itemcustomers')
                ->where('itemcustomers.id',$id)
                ->join('customers','customers.id','=','itemcustomers.customer_id')
                ->join('items','items.id','=','itemcustomers.item_id')
                ->join('users','users.id','=','itemcustomers.user_id')
                ->select('items.jenisItem','items.hargajual','items.hargabeli','items.tipeitem','items.id as items_id','itemcustomers.*','customers.brandCustomer','users.name')
                ->first();
        $vendor = Vendor::get();
        return view('detailpesanan',compact('data','vendor'));
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
        $data = ItemCustomer::find($id);
        
        $date = Carbon::now('Asia/Bangkok');
        $data->jabatanPemesan = $request->jabatanPemesan;
        $data->tanggalpo =  $request->tanggalpo;
        $data->jatuhtempo = $request->jatuhtempo;
        $data->tanggaljadi = $request->tanggaljadi;
        $data->tanggalkerja = $request->tanggalkerja;
        $data->jumlah = $request->kuantitas;
        $data->hargaSatuan = $request->hargaSatuan;
        $data->hargaTotal = $request->hargaSatuan * $request->kuantitas;
        $data->save();
        return redirect('daftarpesanan');
    }
    public function prosesPesanan(Request $request, $id){
        $d = strtotime($request->jatuhtempo);
        $dt = Carbon::parse($d);
        $date = Carbon::now('Asia/Bangkok');
        $data = ItemCustomer::find($id);
        $data->jatuhtempo = $dt;
        $data->hargaSatuan = $request->hargajual;
        $data->hargaTotal = $request->kuantitas * $request->hargajual;
        $data->statuspesanan = 1;
        $data->save();

        $dataVendor = new OrderVendor;
        $dataVendor->orderinvoice = "O".'/'.$request->namaVendor.'/'.$date->format('d/m/Y').'/'.$data->id.'/'.$request->kuantitas;
        $dataVendor->itemCustomer_id = $id;
        $dataVendor->vendor_id = $request->namaVendor;
        $dataVendor->jumlah = $request->kuantitas;
        $dataVendor->biaya = $request->hargabeli * $request->kuantitas;
        $dataVendor->hargajual = $request->hargabeli;
        $dataVendor->tanggaljadi = $request->tanggaljadi;
        $dataVendor->tanggalpo = $date;
        $dataVendor->jatuhtempo = $dt;
        $dataVendor->statuspelunasan = 0;
        $dataVendor->statuskerja = 0;
        $dataVendor->save();
        return redirect('daftarpesanan');
    }
    public function tolakPesanan(Request $request, $id){
        $data = ItemCustomer::find($id);
        $checked = $data->id;
        $order = OrderVendor::where('itemcustomer_id',$id)->first();
                // dd($order);
        $data->catatan = $request->catatan;
        $data->statuspesanan = 3;
        $data->save();
        $order->statuskerja = 3;
        $order->save();
        return redirect('daftarpesanan');
    }
    public function detailpescust($id){
        $data = DB::table('itemcustomers')
                ->where('itemcustomers.id',$id)
                ->join('customers','customers.id','=','itemcustomers.customer_id')
                ->join('items','items.id','=','itemcustomers.item_id')
                ->join('users','users.id','=','itemcustomers.user_id')
                ->select('items.jenisItem','items.tipeitem','items.id as items_id','itemcustomers.*','customers.brandCustomer','users.name')
                ->first();
        return view('detailpesanancust',compact('data'));
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
    public function getPesananCust(){
        $customer = Customer::get();
        $item = Item::get();
        $itemCustomer = ItemCustomer::get();
        $vendor = Vendor::get();
        return view('pesananbarucust',compact('customer','item','itemCustomer','vendor'));
    }
    public function tambahPesananCust(Request $request){
        // $d = Carbon::parse('d/m/Y',$request->tanggaljadi,'Asia/Bangkok');
        $userid = Auth::id();
        $d = strtotime($request->tanggaljadi);
        $dt = Carbon::parse($d);
        $item = Item::get();
        $idItem = $request->nameItem;
        $cekItem = Item::find($idItem);
        $pengecekan = $cekItem->stockjumlah;
        $customerid = Customer::where('user_id',$userid)->first();
        $date = Carbon::today('Asia/Bangkok');
        // $tanggal = Carbon::parse($request->tanggaljadi);
        $dates = Carbon::parse($request->tanggaljadi);
        $minim = $cekItem->jumlahminimal;
        $ysterday = Carbon::yesterday();
        $d = strtotime($date);
        $c = strtotime($request->tanggaljadi);
        $datediff = $d - $c;
        $difference = floor($datediff/(60*60*24));
        

        $minim = $cekItem->jumlahminimal;
        $inname = substr($request->jabatanPemesan,0,1);
        $pms = substr($request->namaPemesan,0,1);
        $invoiceCode = $pms.'/'.$customerid->id.'/'.$inname.'/'.$date->format('d/m/Y').'/'.$request->nameItem.'/'.$request->kuantitas;
        foreach($item as $i)
        {

            if($i->id == $idItem && $request->kuantitas < $pengecekan && $request->kuantitas >=$minim )
            {
                $pesananBaru = new ItemCustomer;
                $totalHarga = $i->hargajual * $request->kuantitas;
                $hargaVendor = $request->kuantitas * $i->hargabeli;
                $hargaCust = $request->kuantitas * $i->hargajual;
                $pesananBaru->customer_id = $customerid->id;
                $pesananBaru->item_id = $request->nameItem;
                $pesananBaru->namaPemesan = $request->namaPemesan;
                $pesananBaru->invoice = $invoiceCode;
                $pesananBaru->jabatanPemesan = $request->jabatanPemesan;
                $pesananBaru->tanggalpo = $date;
                $pesananBaru->hargaTotal = $i->hargajual * $request->kuantitas;
                $pesananBaru->hargaSatuan = $i->hargajual;
                $pesananBaru->tanggaljadi = $dt;
                $pesananBaru->jumlah = $request->kuantitas;
                $pesananBaru->statuspelunasan = 0;
                $pesananBaru->jenispembayaran = $request->tipe_bayar;
                $pesananBaru->statuspesanan = 0;
                $pesananBaru->catatan = $request->keterangan;
                $pesananBaru->user_id = $userid;
                $pesananBaru->save();
                session()->flash('berhasil','Sukses menambah pesanan, silahkan menunggu konfirmasi dari pihak GEP. CP: 081233444543');
            }
            else if($request->kuantitas >= $pengecekan){
                session()->flash('gagal','Jumlah Item pesanan melebihi stock! Silahkan mengulang input dengan mengklik tambah pesanan.');
            }
            else if($request->kuantitas < $minim){
                session()->flash('gagal','Jumlah Item kurang minimal pemesanan! Silahkan mengulang input dengan mengklik tambah pesanan. Mohon untuk pelanggan memperhatikan Juml.Min.Stok dari barang yang ingin dipesan.');
            }
            else if($dates->lte($ysterday)){
                session()->flash('gagal','Tanggal yang dipilih tidak boleh kemarin! Silahkan mengulang input dengan mengklik tambah pesanan.');                
            }
        }
        return redirect('auth-customer');
    }
}
