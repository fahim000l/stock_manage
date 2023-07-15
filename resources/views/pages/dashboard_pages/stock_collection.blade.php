@extends('layouts.dashboard')

@section('pages')
<div class="px-10">
    <p class="my-2 font-bold text-3xl ml-5">Stock Collection</p>
    <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
                <th>#</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>Invoice info</th>
                <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->

            @foreach ($stock_products as $key=>$stock_product)
                @php
                    $product = App\Models\products_collection::where('product_code',$stock_product->product_code)->first();

                    $invoice_info = App\Models\invoices_collection::where('trans_id',$stock_product->trans_id)->first();
                @endphp

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <div class="avatar">
                        <div class="mask mask-squircle w-12 h-12">
                            <img src="{{ asset('storage/uploads/'.$product->product_img) }}" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                        </div>
                    </td>
                    <td>
                        <p>{{ $product->product_name }}</p>
                    </td>
                    <td>
                        <p>{{ $product->buy_price }} /-</p>
                    </td>
                    <td>
                        <p>{{ $product->sell_price }} /-</p>
                    </td>
                    <th>
                        <p>{{ $invoice_info->date }}</p>
                        <label id="stockInvoiceDetailsBtn" data-trans_id="{{ $stock_product->trans_id }}" for="detailsDrawer" class="btn btn-info normal-case btn-xs">Show Details</label>
                    </th>
                    <th>
                        <label id="stockQuantityBtn" data-product_code="{{ $stock_product->product_code }}" data-trans_id="{{ $stock_product->trans_id }}" for="detailsDrawer" class="btn btn-primary normal-case btn-xs">Show Quantities</label>
                    </th>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection
