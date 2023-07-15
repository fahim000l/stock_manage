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

        return view('pages.dashboard_pages.stock_in',compact('suppliers'));
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

    public function indexInvoiceCollection(){

        $invoices = invoice_collection::get();
        // echo '<pre>';
        // print_r($invoice_products);

        return view('sections.invoice_collection',compact('invoices'));
    }

    public function indexProductsCollection(){
        $products = products_collection::get();


        $invoiceInfo = [
            '',
            '',
            ''
        ];


        return view('sections.products_collection',compact('products','invoiceInfo'));
    }

    public function indexSelectedProducts(){


        return view('sections.selected_products');
    }

    public function indexSelectedProductInfo(Request $request){

        // echo '<pre>';
        // print_r($request->all());

        $selected_products = $request->all();

        return view('sections.selected_products',compact('selected_products'));

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
            // echo '<pre>';
            // print_r($request->supplier_email);

            $supplier = new suppliers_collection();

            $supplier->supplier_email = $request->supplier_email;
            $supplier->supplier_phone = $request->supplier_phone;
            $supplier->save();

            return response()->json([
                'status' => 'success'
            ]);
    }

    public function addInvoice(Request $request){
        $request->validate(
            [
                'supplier_email_modal'=>'required',
                'date_modal'=>'required',
                'trans_id'=>'required|unique:invoice_collections'
            ],
            [
                'supplier_email_modal.required' => 'Supplier Email is required',
                'date_modal.required' => 'Date is required',
                'trans_id.required'=>'Trans Id is required',
                'trans_id.unique' => 'This transsection already happened'
            ]
            );

            $invoice = new invoice_collection();

            $invoice->supplier_email = $request->supplier_email_modal;
            $invoice->date = $request->date_modal;
            $invoice->trans_id = $request->trans_id;
            $invoice->save();

            return response()->json([
                'status'=>'success'
            ]);

    }

    public function indexInfoiceInfo(Request $request){

        $invoiceInfo = [
            $request->supplierEmail,
            $request->transId,
            $request->date
        ];

        $products = products_collection::get();

        return view('sections.products_collection',compact('invoiceInfo','products'));
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

    public function indexManageSize(){

        $sizes = size_collection::where('status','active')->get();

        return view('sections.manage_size',compact('sizes'));


    }

    public function addToStock(Request $request){
        // dd($request->all());



        foreach ($request->products_info as $key => $product) {
            if(!product_stock::where('product_code',$product['product_code'])->exists()){
                product_stock::insert($product);
            }

        }
        // product_stock::insert($request->products_info);
        quantity_stock::insert($request->quantity_info);

        return response()->json([
            'status'=>'success'
        ]);
    }

}