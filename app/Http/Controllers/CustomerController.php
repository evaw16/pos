<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(){
    $customer = Customer::all();
    return view('customer',['customer'=>$customer]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('create_customer');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $customer = new Customer();
    $customer->nama = $request->nama;
    $customer->email = $request->email;
    $customer->alamat = $request->alamat;
    $customer->telepon = $request->telepon;
    $customer->keterangan = $request->keterangan;
    $customer->save();
    return redirect('customer');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Customer  $customer
  * @return \Illuminate\Http\Response
  */
  public function show(Customer $customer)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Customer  $customer
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $customer = DB::table('customer')
    ->where('id_customer', $id)->first();
    return view('edit_customer', ['customer' => $customer]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Customer  $customer
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $barang = DB::table('customer')
    ->where('id_customer', $id)->
    update([
      'nama' => $request->nama,
      'email' => $request->email,
      'alamat' => $request->alamat,
      'telepon' => $request->telepon,
      'keterangan' => $request->keterangan
    ]);
    return redirect('customer');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Customer  $customer
  * @return \Illuminate\Http\Response
  */
  public function destroy(Customer $id)
  {
    $customer = Customer::where('id_customer', $id);
    $customer->delete();
    return redirect('customer');
  }
}
