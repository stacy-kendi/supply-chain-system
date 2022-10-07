<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:suppliers');
    }

    public function index()
    {
        //Get only the products sold by this supplier. Do not display to the supplier other products not theirs
        $supplier = Auth::user()->id;
        $products = Product::with('category')->where('supplier_id', $supplier)->where('archive_status', '0')->get();
        $categories = Category::all()->where('archive_status', '0');
        return view('supplierinterface.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplierinterface.product.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedProductData = $request->validate([
            'product_name'=> 'required',
            'category_id' => 'required',
            'product_price' => 'required',
            'product_description' => '',
            
        ]);

        $products = Product::create([

            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => Auth::user()->id,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            
        ]);

        return back()->with('success', 'New Product Added Successfully');
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
        $editProduct = Product::find($id);

        return view('supplierinterface.product.index', compact($editProduct));
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
        $validatedProductData = $request->validate([
            'product_name'=> 'required',
            'category_id' => 'required',
            'product_price' => 'required',
            'product_description' => '',
            
        ]);

        $products = Product::find($id);

        $products->product_name = $request->product_name;
        $products->category_id = $request->category_id;
        $products->supplier_id = Auth::user()->id;
        $products->product_price = $request->product_price;
        $products->product_description = $request->product_description;

        $products->save();

        return back()->with('success', 'Product Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteProduct = Product::where('id', $id)->update(['archive_status' => '1']);
        if($deleteProduct)
        {
            return back()->with('success', 'Product deleted successfully');
        }
        else
        {
            return back()->with('error', 'Product Not deleted, Try Again');
        }
    }
}
