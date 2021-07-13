<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Customer;
use Validator;
use Hash;
use DB;
use Auth;
use Config;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::get();
        return view('pengguna',compact('user'));
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
        
        $user = new User;
        $user->name = $request->username;
		$user->email = $request->email;
		$user->role = 'customer';
        $user->password = Hash::make($request->password);
        $user->active = '0';
        $user->save();

        $findUser = User::where('email',$request->email)->where('name',$request->username)->first();
        $addCustomer = new Customer;
        $addCustomer->brandCustomer = $request->brandCustomer;
        $addCustomer->cabangCustomer = $request->cabangCustomer;
        $addCustomer->alamatCustomer = $request->alamatCustomer;
        $addCustomer->kotaCustomer = $request->kotaCustomer;
        $addCustomer->kategoriCustomer = $request->kategoriCustomer;
        $addCustomer->user_id = $findUser->id;
        $addCustomer->save();
        session()->flash('berhasil', 'Anda telah terdaftar, hubungi admin untuk aktivasi!');
        return redirect('/home');
    }
    public function storeVendor(Request $request){
        $user = new User();
        $user->name = $request->username;
		$user->email = $request->email;
		$user->role = 'vendor';
        $user->password = Hash::make($request->password);
        $user->active = '0';
        $user->save();
                
        $findUser = User::where('email',$request->email)->where('name',$request->username)->first();
        $addVendor = new Vendor();
        $addVendor->namaVendor = $request->username;
        $addVendor->pemilikVendor = $request->pemilikVendor;
        $addVendor->brandVendor = $request->brandVendor;
        $addVendor->alamatVendor = $request->alamatVendor;
        $addVendor->kotaVendor = $request->kotaVendor;
        $addVendor->jenisUsahaVendor = $request->jenisUsahaVendor;
        $addVendor->kategoriVendor = $request->kategoriVendor;
        $addVendor->user_id = $findUser->id;
        $addVendor->save();
        session()->flash('berhasil', 'Anda telah terdaftar, hubungi admin untuk aktivasi!');
        return redirect('/home');
    }
    public function userAkt($id){
        $user = User::find($id);
        // $vendor = Vendor::find($id);
        // $users = User::join('vendors','vendors.user_id','=','users.id')->select('vendors.user_id as userid')->find($id);
        // $users = Vendor::where('vendors.id',$id)->join('users','users.id','=','vendors.user_id')->select('users.id')->first();
        // dd($users);
        return view('aktivasivendor',compact('user'));
    }
    public function Aktivasi(Request $request, $id){
        $findVendor = User::find($id);
        $findVendor->active = 'active';
        $findVendor->save();
        return redirect('/pengguna');
    }
    public function Tolak(Request $request, $id){
        $findVendor = User::find($id);
        $findVendor->active = 'refused';
        $findVendor->save();
        return redirect('/pengguna');
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
