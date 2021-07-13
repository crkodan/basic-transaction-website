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
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;
use Config;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendor = Vendor::join('users','users.id','=','vendors.user_id')->select('active','vendors.*')->paginate(10);
        // $vendor = Vendor::paginate(10);
        return view('daftarvendor',compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vendor = Vendor::get();
        $item = Item::get();
        return view('tambahvendor',compact('vendor','item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function catatanVendor(){
        $listCatatan = DB::table('ordervendors')
                    ->join('vendors','vendors.id','=','ordervendors.vendor_id')
                    ->select('vendors.*','ordervendors.*')
                    ->paginate(10);
        return view('catatanvendor',compact('listCatatan'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $lastid = Vendor::create($data)->id;
        $UserID = Vendor::find($lastid);
        $UserID->user_id = $lastid; 
        $UserID->save();
        if(count($request->itemid)>0){
            foreach($request->itemid as $item=>$v){
                $data2 = array(
                    'vendor_id'=>$lastid,
                    'item_id'=>$request->itemid[$item]
                );
                ItemVendor::insert($data2);
            }
        }
        $addUser = new User;
        $addUser->name = $request->namaVendor;
        $email = $request->namaVendor.'@'.$request->brandVendor.'.'.$request->kotaVendor;
        $addUser->email = $email;
        $addUser->password = Hash::make($request->namaVendor);
		$addUser->role = "vendor";
        $addUser->save();
        return redirect('daftarvendor');
        //
    }
    public function getBarang(){
        $item = Item::get();
        return view('barang-vendor',compact('item'));
    }
    public function barang(Request $request){
        $id = Auth::user()->id;
        $vendorid = Vendor::where('user_id',$id)->first();
        $itemVen = new ItemVendor;
        $itemVen->vendor_id = $vendorid->id;
        $itemVen->item_id = $request->barang;
        $itemVen->save();
        return redirect('dashboard');
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
        $data = Vendor::where('vendor_id',$id)
        ->first();
        $item = ItemVendor::join('items','items.id','=','itemvendors.item_id')
                ->join('vendors','vendors.id','=','itemvendors.vendor_id')
                ->where('vendors.id','=',$id)
                ->select('items.jenisItem','items.tipeitem','items.id as item_id','items.stockjumlah')
                ->get();
        // dd($item);
        return view('detailvendor',compact('data','item'));
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
        $data = Vendor::where('id',$id)
        ->first();
        $item = ItemVendor::join('items','items.id','=','itemvendors.item_id')
                ->join('vendors','vendors.id','=','itemvendors.vendor_id')
                ->where('vendors.id','=',$id)
                ->select('items.jenisItem','items.tipeitem','items.id as item_id','items.stockjumlah')
                ->get();
        // dd($item);
        return view('detailvendor',compact('data','item'));
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
        $updateData = Vendor::find($id);
        $updateData->namaVendor =  $request->namaVendor;
        $updateData->pemilikVendor = $request->pemilikVendor;
        $updateData->brandVendor = $request->brandVendor;
        $updateData->alamatVendor = $request->alamatVendor;
        $updateData->kotaVendor = $request->kotaVendor;
        $updateData->jenisUsahaVendor = $request->jenisUsahaVendor;
        $updateData->kategoriVendor = $request->kategoriVendor;
        $updateData->save();
        return redirect('daftarvendor');
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
