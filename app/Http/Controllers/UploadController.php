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

class UploadController extends Controller
{
    public function proses(Request $request)
    {
        $this->validate($request,[
        ]);
 
        return view('proses',['data' => $request]);
    }

	public function upload(){
		$payment = BuktiCustomer::get();
		return view('upload',['payment'=>$payment]);
	}
    
	public function proses_upload(Request $request){

		$this->validate($request, [
            'id' =>'required',
			'image' => 'required|file|image|mimes:jpeg,png,jpg',
			'keterangan' => 'required',
		]);
	 
		// menyimpan data file yang diupload ke variabel $file
		$image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        // $nama_file = time()."_".$file->getClientOriginalName();
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images_payment'), $new_name);
        
        $payments = new BuktiCustomer();
        $payments->itemcustomer_id = $request->id;
        $payments->namafile = $new_name;
        $payments->ext = $ext;
        $payments->keterangan = $request->keterangan;
        $payments->save();
        
		return back();
	 
    }
    //
    public function cekproses_upload(Request $request){

		$this->validate($request, [
            'id' =>'required',
			'image' => 'required|file|image|mimes:jpeg,png,jpg',
			'keterangan' => 'required',
		]);
	 
		// menyimpan data file yang diupload ke variabel $file
		$image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        // $nama_file = time()."_".$file->getClientOriginalName();
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images_payment'), $new_name);
        
        $payments = new BuktiCustomer();
        $payments->itemcustomer_id = $request->id;
        $payments->namafile = $new_name;
        $payments->ext = $ext;
        $payments->keterangan = $request->keterangan;
        $payments->save();
        
		return back();
	 
	}
    //
	public function uploadvendor(){
        $shipment = BuktiVendor::get();
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
        
        $shipment = new BuktiVendor();
        $shipment->ordervendor_id = $request->id;
        $shipment->namafile = $new_name;
        $shipment->ext = $ext;
        $shipment->keterangan = $request->keterangan;
        $shipment->save();

        return redirect()->back();
    }
    public function cekproses_vendor(Request $request){
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
        
        $shipment = new BuktiVendor();
        $shipment->ordervendor_id = $request->id;
        $shipment->namafile = $new_name;
        $shipment->ext = $ext;
        $shipment->keterangan = $request->keterangan;
        $shipment->save();

        return redirect()->back();
    }
    public function import_excel(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:csv,xls,xlsx'
        ]);
        // $file = $request->file('file');
        // $ext = $file->getClientOriginalExtension();
        // $nama_file = time()."_".$file->getClientOriginalName();
        // $request->file('file')->store('data_file/data_excel');
        Excel::import(new ItemImport, request()->file('file'));
        return back();

    }
}