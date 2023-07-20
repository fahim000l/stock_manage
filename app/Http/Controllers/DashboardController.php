<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\size_collection;
use App\Models\suppliers_collection;
use Illuminate\Http\Request;
use App\Models\products_collection;
use App\Models\invoice_collection;
use App\Models\product_stock;
use App\Models\quantity_stock;
use App\Models\invoices_collection;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('layouts.dashboard');
    }

    public function addProduct(){
        return view('pages.dashboard_pages.add_product');
    }

    public function stockIn(){

        // $suppliers = suppliers_collection::latest()->paginate(5);
        $suppliers = suppliers_collection::get();
        $products = products_collection::get();

        return view('pages.dashboard_pages.stock_in',compact('suppliers','products'));
    }

    public function uploadImage(Request $request){

        $file_name = time().'-ws.'.$request->file('image')->getClientOriginalExtension();
        echo $request->file('image')->storeAs('public/uploads',$file_name);
        echo '<pre>';
        print_r('/public/storage/uploads/'.$file_name);

        return response()->json([
            'file'=>'/public/storage/uploads/'.$file_name
        ]);
    }

    public function addNewProduct(Request $request){
        $request->validate(
            [
                'product_name'=>'required|unique:products_collections',
                'buy_price'=>'required|numeric',
                'sell_price'=>'required|numeric',
                'product_code'=>'required',
                'product_image'=>'required'
            ],
            [
                'product_name.required' =>'Product Name is required',
                'product_name.unique'=>'This product already exists',
                'buy_price.required' =>'Buy Price is required',
                'buy_price.numeric' =>'Buy Price is invalid',
                'sell_price.required' =>'Sell Price is required',
                'sell_price.numeric' =>'Sell Price is invalid',
                'product_image.required'=>'Product Image is required'
            ]
            );

            $file_name = time().'-ws.'.$request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->storeAs('public/uploads',$file_name);


            $products = new products_collection();

            $products->product_name = $request->product_name;
            $products->product_code = $request->product_code;
            $products->product_img = $file_name;
            $products->buy_price = $request->buy_price;
            $products->sell_price = $request->sell_price;
            $products->save();

            return response()->json([
                'status'=>'success',
                'product_name'=>$request->product_name
            ]);

    }

    public function indexSupplierCollection(){


        $suppliers = suppliers_collection::get();
        // $suppliers = DB::table('suppliers_collections')->get();


        return view('sections.supplier_collection',compact('suppliers'));
    }

    public function addSupplier(Request $request){

        $request->validate(
            [
                'supplier_email'=>'required|unique:suppliers_collections',
                'supplier_phone'=>'required|numeric'
            ],
            [
                'supplier_email.required' => 'Supplier Email is required',
                'supplier_phone.required' => 'Supplier Phone is required',
                'supplier_phone.numeric' => 'Phone Number invalid',
                'supplier_email.unique' => 'This email already exists'

            ]
            );


            $supplier = new suppliers_collection();

            $supplier->supplier_email = $request->supplier_email;
            $supplier->supplier_phone = $request->supplier_phone;
            $supplier->save();

            return response()->json([
                'status' => 'success'
            ]);
    }

    public function indexInvoice(){


        $suppliers = suppliers_collection::get();
        $products = products_collection::get();


        return view('sections.invoice',compact('suppliers','products'));
    }

    public function getSupplier(Request $request){
        $selected_supplier = suppliers_collection::where('supplier_email',$request->supplier_email)->get();

        return response()->json($selected_supplier);

    }

    public function getProduct(Request $request){
        $selected_product = products_collection::where('product_code',$request->product_code)->get();

        return response()->json($selected_product);
    }

    public function indexSetQuantityTable(Request $request){
        $product = products_collection::where('product_code',$request->product_code)->get();
        $sizes = size_collection::where('status','active')->get();



        return view('sections.set_quantity_table',compact('product','sizes'));
    }

    public function stockingIn(Request $request){
        // echo '<pre>';
        // print_r($request->all());

        product_stock::insert($request->productInfo);
        quantity_stock::insert($request->quantityInfo);
        $invoice = new invoices_collection();
        $invoice->supplier_email = $request->invoiceInfo['supplier_email'];
        $invoice->date = $request->invoiceInfo['date'];
        $invoice->trans_id = $request->invoiceInfo['trans_id'];
        $invoice->status = $request->invoiceInfo['status'];
        $invoice->save();


        return response()->json([
            'status'=>'success'
        ]);
    }

    public function indexStockCollection(){

        $products = products_collection::get();

        return view('pages.dashboard_pages.stock_collection',compact('products'));

    }


    public function indexInvoiceDetails(Request $request){

        $invoices = product_stock::where('product_code',$request->product_code)->get();

        return view('sections.product_invoices',compact('invoices'));

    }

    public function indexInvoiceQuantity(Request $request){
        $quantities = quantity_stock::where('product_code',$request->product_code)->where('trans_id',$request->trans_id)->get();

        return view('sections.invoice_quantity_table',compact('quantities'));
    }

    public function addNewSize(Request $request){
        $request->validate(
            [
                'size_id'=>'required|unique:size_collections',
                'size_name'=> 'required|unique:size_collections',
                'status'=>'required',
            ],
            [
                'size_id.required'=> 'Size Id is required',
                'size_id.unique'=> 'Size Id must have to be unique',
                'size_name.required'=> 'Size is required',

            ]
            );

            $sizes = new size_collection();
            $sizes->size_name = $request->size_name;
            $sizes->size_id = $request->size_id;
            $sizes->status = $request->status;
            $sizes->save();

            return response()->json([
                'status'=>'success'
            ]);


    }

    public function indexManageSizeTable()
    {

        $allSizes = size_collection::get();

        return view('sections.manageSizeTable',compact('allSizes'));
    }

    public function setStatusActive(Request $request){
        size_collection::where('size_id',$request->size_id)->update([
                'status'=>'active'
            ]);

        return response()->json([
            'status'=>'success'
        ]);

    }
    public function setStatusDeactive(Request $request){
        size_collection::where('size_id',$request->size_id)->update([
                'status'=>'deactive'
            ]);

        return response()->json([
            'status'=>'success'
        ]);

    }


    public function deleteStock(Request $request){
        $product_stock = product_stock::where('trans_id',$request->trans_id)->get();
        $quantity_stock = quantity_stock::where('trans_id',$request->trans_id)->get();

        $product_stock->each->delete();
        $quantity_stock->each->delete();

        return response()->json([
            'status'=>'success'
        ]);
    }




}