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

class buktiVendorController extends Controller
{
    public function uploadvendor(){
        $shipment = Shipment::get();
        return view('uploadvendor',['shipment'=>$shipment]);
    }
    public function proses_vendor(Request $request){
        $this->validate($request,[
            'id'=>'required',
			'image' => 'required|file|image|mimes:jpeg,png,jpg',
			'keterangan' => 'required',
        ]);
        // menyimpan data file yang diupload ke variabel $file
		$image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        // $nama_file = time()."_".$file->getClientOriginalName();
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images_shipments'), $new_name);
        
        $shipment = new Shipment();
        $shipment->ordervendor_id = $request->id;
        $shipment->namafile = $new_name;
        $shipment->ext = $ext;
        $shipment->keterangan = $request->keterangan;
        $shipment->save();

        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
}
