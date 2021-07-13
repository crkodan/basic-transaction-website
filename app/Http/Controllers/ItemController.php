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

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $item = Item::paginate(10);
        return view('gudang',compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $item = Item::get();
        $vendor = Vendor::get();
        return view('tambahstokbarang',compact('item','vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addItem = new Item;
        $addItem->jenisItem = $request->jenisItem;
        $addItem->tipeitem = $request->tipeitem;
        $addItem->stockjumlah = $request->stockjumlah;
        $addItem->hargabeli = $request->hargabeli;
        $addItem->hargajual = $request->hargajual;
        $addItem->jumlahminimal = $request->jumlahminimal;
        $date = Carbon::Today('Asia/Bangkok');
        $addItem->created_at = $date;
        $addItem->catatan = $request->catatan;
        $addItem->save();
        return redirect('gudang');
        //
    }
    public function storeJenis(Request $request){
        $addJenis = new Item;
        $addJenis->jenisItem = $request->jenisItem;
        $addJenis->save();
        return redirect('gudang');
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
        $data = Item::where('id',$id)->first();
        return view('detailitem',compact('data'));
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
        $data = Item::where('id',$id)->first();
        return view('detailitem',compact('data'));
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
        $updateItem = Item::find($id);
        $updateItem->jenisItem = $request->jenisItem;
        $updateItem->tipeitem = $request->tipeitem;
        $updateItem->stockjumlah = $request->stockjumlah;
        $updateItem->jumlahminimal = $request->jumlahminimal;
        $updateItem->catatan = $request->catatan;
        $updateItem->save();
        return redirect('gudang');
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
