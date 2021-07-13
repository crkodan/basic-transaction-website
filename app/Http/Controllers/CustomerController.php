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

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $customer = Customer::paginate(10);
        return view('datapelanggan',compact('customer'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pelanggan = Customer::get();
        return view('tambahcust',compact('pelanggan'));
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
        $addPelanggan = new Customer;
        $addPelanggan->brandCustomer = $request->brandCustomer;
        $addPelanggan->cabangCustomer = $request->cabangCustomer;
        $addPelanggan->alamatCustomer = $request->alamatCustomer;
        $addPelanggan->kotaCustomer = $request->kotaCustomer;
        $addPelanggan->kategoriCustomer = $request->kategoriCustomer;
        $date = Carbon::now('Asia/Bangkok');
        $addPelanggan->created_at = $date;
        $addPelanggan->save();
        return redirect('datapelanggan');
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
        $customer = DB::table('itemcustomers')
        ->where('customers.id',$id)
        ->join('customers','customers.id','=','itemCustomers.customer_id')
        ->join('items','items.id','=','itemCustomers.item_id')
        ->join('users','users.id','=','itemCustomers.user_id')
        ->select('itemcustomers.*','items.jenisItem','items.tipeitem','customers.brandCustomer','customers.alamatCustomer','customers.kotaCustomer','users.name')
        ->paginate(10);
        return view('historypelanggan',compact('customer'));
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
        $data = Customer::where('customers.id',$id)->first();
        return view('detailpelanggan',compact('data'));
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
        $updateData = Customer::find($id);
        $updateData->brandCustomer = $request->brandCustomer;
        $updateData->cabangCustomer = $request->cabangCustomer;
        $updateData->alamatCustomer = $request->alamatCustomer;
        $updateData->kotaCustomer = $request->kotaCustomer;
        $updateData->kategoriCustomer = $request->kategoriCustomer;
        $updateData->save();
        return redirect('datapelanggan');
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
