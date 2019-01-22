<?php

namespace App\Http\Controllers;

// use App\Supplier;
use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(){
    $supplier = Supplier::all();
    return view('supplier',['supplier'=>$supplier]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    return view('create_supplier');
  }


  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $supplier = new Supplier();
    $supplier->nama = $request->nama;
    $supplier->alamat = $request->alamat;
    $supplier->email = $request->email;
    $supplier->telepon = $request->telepon;
    $supplier->fax = $request->fax;
    $supplier->website = $request->website;
    $supplier->nama_cp = $request->nama_cp;
    $supplier->telepon_cp = $request->telepon_cp;
    $supplier->save();
    return redirect('supplier');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function show(Supplier $supplier)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $supplier=Supplier::find($id);
    return view ('edit_supplier',['supplier'=>$supplier]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $supplier=Supplier::find($id);
    $supplier->nama = $request->nama;
    $supplier->alamat = $request->alamat;
    $supplier->email = $request->email;
    $supplier->telepon = $request->telepon;
    $supplier->fax = $request->fax;
    $supplier->website = $request->website;
    $supplier->nama_cp = $request->nama_cp;
    $supplier->telepon_cp = $request->telepon_cp;
    $supplier->Save();
    return redirect ('supplier');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $supplier = Supplier::find($id) ;
    $supplier->delete();
    return redirect ('supplier');
  }
}
