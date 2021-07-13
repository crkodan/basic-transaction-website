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
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Http\Controllers\Controller;
use auth;

class homeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prioritas(){
        $id = Auth::user()->id;
        if(Auth::user()->active == "active"){
            if(Auth::user()->role=="admin"){
                $invoicewaitinglist = DB::table('itemcustomers')
                            ->orderBy('itemcustomers.tanggalpo','DESC')
                            ->where('itemcustomers.statuspesanan',0)
                            ->join('customers','customers.id','=','itemcustomers.customer_id')
                            ->join('items','items.id','=','itemcustomers.item_id')
                            ->join('users','users.id','=','itemcustomers.user_id')
                            ->select('items.jenisitem','customers.*','itemcustomers.*','users.name')
                            ->paginate(10);    
                $orderwaitinglist = DB::table('ordervendors')
                        ->orderBy('ordervendors.tanggalpo','DESC')
                        ->where('ordervendors.statuskerja',0)
                        ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                        ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
                        ->select('vendors.*','itemcustomers.*','ordervendors.*')
                        ->paginate(10);
                // $dataNotif= Notification::get();

                return view('dashboard', compact('invoicewaitinglist','orderwaitinglist'));
            }
        }
    }
    public function showNotif(){        
        $dataNotif= Notification::get();
        // dd($dataNotif);
        return view('dashboard',compact('dataNotif'));
    }
    public function notifItem(){
        $items = Item::get();
        // $pengecekanJumlah = $items->stockjumlah;
        // dd($items);
        foreach($items as $it)
        {
            $pengecekanJumlah = $it->stockjumlah;
            if($pengecekanJumlah < 24){
                $notif = new Notification;
                $notif->notifikasi = $it->jenisItem." - ".$it->tipeitem." ada sebanyak ".$it->stockjumlah;
                $notif->item_id = $it->items_id;
                $notif->save();
            }
        }
        return redirect('dashboard');
        // $dataNotif= DB::table('notifications')->get();
        // dd($dataNotif);
        // return view('/',compact('dataNotif'));
    }
    public function getPesanVendor(){
        $pesanVendor = OrderVendor::get();
        $vendor = Vendor::get();
        $item = Item::get();
        $invoice = ItemCustomer::join('customers','customers.id','=','itemcustomers.customer_id')
                    ->select('customers.brandCustomer','itemcustomers.*')
                    ->get();
        return view('pemesananvendor',compact('pesanVendor','item','vendor','invoice'));
    }
    public function pembukuan(){

        $pembukuan = ItemCustomer::orderBy('itemcustomers.tanggalpo','ASC')
                    ->orderBy('ordervendors.tanggalpo','ASC')
                    ->where('itemcustomers.statuspesanan',4)
                    ->where('ordervendors.statuskerja',5)
                    ->join('customers','itemcustomers.customer_id','=','customers.id')
                    ->join('ordervendors','itemcustomers.id','=','ordervendors.itemCustomer_id')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('itemcustomers.tanggalpo','ordervendors.tanggalkerja','itemcustomers.invoice','ordervendors.orderinvoice'
                    ,'itemcustomers.hargaSatuan','ordervendors.hargajual','itemcustomers.jumlah'
                    ,'itemcustomers.hargaTotal','ordervendors.biaya','itemcustomers.namaPemesan','customers.brandCustomer','vendors.namaVendor')
                    ->paginate(50)
                    ;
        return view('pembukuan',compact('pembukuan'));
    }
    
    public function filterPembukuan(Request $request){
        $filteryear = $request->year;
        $filtermonth = $request->month;

        $pembukuan = DB::table('itemcustomers')
                ->whereMonth('itemcustomers.tanggalpo',$filtermonth)
                ->whereYear('itemcustomers.tanggalpo',$filteryear)
                ->whereMonth('ordervendors.tanggaljadi',$filtermonth)
                ->whereYear('ordervendors.tanggaljadi',$filteryear)
                    ->orderBy('ordervendors.tanggalpo','ASC')
                    ->where('itemcustomers.statuspesanan',4)
                    ->where('ordervendors.statuskerja',5)
                    ->join('customers','itemcustomers.customer_id','=','customers.id')
                    ->join('ordervendors','itemcustomers.id','=','ordervendors.itemCustomer_id')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('itemcustomers.tanggalpo','ordervendors.tanggalkerja','itemcustomers.invoice','ordervendors.orderinvoice'
                    ,'itemcustomers.hargaSatuan','ordervendors.hargajual','itemcustomers.jumlah'
                    ,'itemcustomers.hargaTotal','ordervendors.biaya','itemcustomers.namaPemesan','customers.brandCustomer','vendors.namaVendor')
                    ->paginate(50)
                    ;
        return view('pembukuan',compact('pembukuan'));
    }
    public function filterPembukuanStarBuyerM(Request $request){
        $filteryear = $request->year;
        $filtermonth = $request->month;

        $pembukuan = DB::table('itemcustomers')
                ->whereMonth('itemcustomers.tanggalpo',$filtermonth)
                ->whereYear('itemcustomers.tanggalpo',$filteryear)
                ->whereMonth('ordervendors.tanggaljadi',$filtermonth)
                ->whereYear('ordervendors.tanggaljadi',$filteryear)
                    ->orderBy('itemcustomers.hargaTotal','DESC')
                    ->where('itemcustomers.statuspesanan',4)
                    ->where('ordervendors.statuskerja',5)
                    ->join('customers','itemcustomers.customer_id','=','customers.id')
                    ->join('ordervendors','itemcustomers.id','=','ordervendors.itemCustomer_id')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('itemcustomers.tanggalpo','ordervendors.tanggalkerja','itemcustomers.invoice','ordervendors.orderinvoice'
                    ,'itemcustomers.hargaSatuan','ordervendors.hargajual','itemcustomers.jumlah'
                    ,'itemcustomers.hargaTotal','ordervendors.biaya','itemcustomers.namaPemesan','customers.brandCustomer','vendors.namaVendor')
                    ->paginate(50)
                    ;
        return view('pembukuan',compact('pembukuan'));
    }
    public function filterPembukuanStarBuyerY(Request $request){
        $filteryear = $request->year;

        $pembukuan = DB::table('itemcustomers')
                ->whereYear('itemcustomers.tanggalpo',$filteryear)
                ->whereYear('ordervendors.tanggaljadi',$filteryear)
                    ->orderBy('itemcustomers.hargaTotal','DESC')
                    ->where('itemcustomers.statuspesanan',4)
                    ->where('ordervendors.statuskerja',5)
                    ->join('customers','itemcustomers.customer_id','=','customers.id')
                    ->join('ordervendors','itemcustomers.id','=','ordervendors.itemCustomer_id')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('itemcustomers.tanggalpo','ordervendors.tanggalkerja','itemcustomers.invoice','ordervendors.orderinvoice'
                    ,'itemcustomers.hargaSatuan','ordervendors.hargajual','itemcustomers.jumlah'
                    ,'itemcustomers.hargaTotal','ordervendors.biaya','itemcustomers.namaPemesan','customers.brandCustomer','vendors.namaVendor')
                    ->paginate(50);
        return view('pembukuan',compact('pembukuan'));
    }
    //get data for index
    public function index()
    {
        $id = Auth::user()->id;
        if(Auth::user()->active == "active"){
            if(Auth::user()->role=="admin"){
                $invoice = DB::table('itemcustomers')
                        ->orderBy('itemcustomers.tanggaljadi','ASC')
                        ->leftJoin('ordervendors','itemcustomers.id','=','ordervendors.itemcustomer_id')
                        ->leftJoin('vendors','vendors.id','=','ordervendors.vendor_id')
                        ->leftJoin('users','users.id','=','itemcustomers.user_id')
                        ->select('itemcustomers.*','users.name','ordervendors.orderinvoice','ordervendors.id as orderid','ordervendors.statuskerja','vendors.namaVendor')
                        ->paginate(10);   
                return view('dashboard', compact('invoice'));
            }
            else if(Auth::user()->role=="customer"){
                $invoice = DB::table('itemcustomers')
                ->orderBy('itemcustomers.tanggalpo','DESC')
                ->where('itemcustomers.user_id','=',$id)
                ->join('customers','customers.id','=','itemcustomers.customer_id')
                ->join('items','items.id','=','itemcustomers.item_id')
                ->join('users','users.id','=','itemcustomers.user_id')
                ->select('items.jenisitem','customers.*','itemcustomers.*','users.name')
                ->paginate(10); 
                return view('auth-customer', compact('invoice'));
            }
            else if(Auth::user()->role=="vendor"){
                $orders = DB::table('ordervendors')
                ->orderBy('itemcustomers.tanggalpo','ASC')
                ->where('vendors.user_id','=',$id)
                ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                ->join('itemcustomers','itemcustomers.id','=','ordervendors.itemcustomer_id')
                ->join('items','items.id','=','itemcustomers.item_id')
                ->select('vendors.namaVendor','vendors.brandVendor','items.jenisItem','items.tipeitem','ordervendors.*','itemcustomers.invoice')
                ->paginate(10);
                // dd($orders);
                return view('auth-vendor', compact('orders'));
            }
        }
        else{
            
        }
       
    }
    public function cariPembukuan(Request $request){
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $pembukuan = ItemCustomer::where('itemcustomers.tanggalpo','like','%'.$query.'%')
                    ->orWhere('ordervendors.tanggalkerja','like','%'.$query.'%')
                    ->orWhere('itemcustomers.invoice','like','%'.$query.'%')
                    ->orWhere('ordervendors.orderinvoice','like','%'.$query.'%')
                    ->orWhere('itemcustomers.hargaTotal','like','%'.$query.'%')
                    ->orWhere('ordervendors.biaya','like','%'.$query.'%')
                    ->where('itemcustomers.statuspesanan',4)
                    ->where('ordervendors.statuskerja',5)
                    ->join('ordervendors','itemcustomers.id','=','ordervendors.itemCustomer_id')
                    ->select('itemcustomers.tanggalpo','ordervendors.tanggalkerja','itemcustomers.invoice','ordervendors.orderinvoice','itemcustomers.hargaTotal','ordervendors.biaya')
                    ->get();
            } else {
                $pembukuan = ItemCustomer::orderBy('itemcustomers.tanggalpo','DESC')
                    ->orderBy('ordervendors.tanggalpo','DESC')
                    ->where('itemcustomers.statuspesanan',4)
                    ->where('ordervendors.statuskerja',5)
                    ->join('ordervendors','itemcustomers.id','=','ordervendors.itemCustomer_id')
                    ->select('itemcustomers.tanggalpo','ordervendors.tanggalkerja','itemcustomers.invoice','ordervendors.orderinvoice','itemcustomers.hargaTotal','ordervendors.biaya')
                    ->paginate(50);
            }
            
        }
    }
    //bagian item customer
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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




    //19-9-2020
    
    public function uploadNotaPelanggan(){
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->select('customers.*','itemcustomers.*')
                    ->get();
        return view('auth-customer', compact('invoice'));
    }
    public function uploadNotaVendor(){
        $orders = DB::table('ordervendors')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('vendors.*','ordervendors.*')
                    ->paginate(10);
        return view('auth-vendor',compact('orders'));
    }
    public function ambilPesanan(){
        $invoice = DB::table('itemcustomers')
                    ->join('customers','customers.id','=','itemcustomers.customer_id')
                    ->join('users','users.id','=','itemcustomers.user_id')
                    ->select('customers.*','itemcustomers.*','users.name')
                    ->get();
        return view('ambilpesanan', compact('invoice'));
    }
    // public function ambilPesanan(){
    //     $invoice = DB::table('itemcustomers')
    //                 ->join('customers','customers.id','=','itemcustomers.customer_id')
    //                 ->select('customers.*','itemcustomers.*')
    //                 ->get();
    //     return view('ambilpesanan', compact('invoice'));
    // }
}
