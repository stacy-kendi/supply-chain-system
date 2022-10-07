<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all()->where('archive_status', '0');
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedSupplierData = $request->validate([
            'name'=> 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => ['required', 'numeric'],
            'address' => 'required',
            'password' => ['required', 'string', 'min:8'],
            
        ]);

        $suppliers = Supplier::create([

            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            
        ]);

        return back()->with('success', 'New Supplier Added Successfully');
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
        $editSupplier = Supplier::find($id);

        return view('supplier.index', compact($editSupplier));
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
        $validatedSupplierData = $request->validate([
            'name'=> 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => ['required', 'numeric'],
            'address' => 'required',
            'password' => ['string', 'min:8'],
        ]);

        $suppliers = Supplier::find($id);

        $suppliers->name = $request->name;
        $suppliers->email = $request->email;
        $suppliers->phonenumber = $request->phonenumber;
        $suppliers->address = $request->address;

        if($request->password)
        {
            $suppliers->password = Hash::make($request->password);
        }

        $suppliers->save();

        return back()->with('success', 'Supplier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteSupplier = Supplier::where('id', $id)->update(['archive_status' => '1']);
        if($deleteSupplier)
        {
            return back()->with('success', 'Supplier deleted successfully');
        }
        else
        {
            return back()->with('error', 'Supplier Not deleted, Try Again');
        }
    }
}
