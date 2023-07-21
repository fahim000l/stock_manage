@extends('layouts.dashboard')

@section('pages')
<div class="px-10">
    <p class="my-2 font-bold text-3xl ml-5">Stock Collection</p>
    <div class="tabs tabs-boxed">
        <button id="product_stock_tab" class="tab w-[50%] tab-active">Product Stock</button>
        <button id="invoice_stock_tab" class="tab w-[50%]">Invoice Stock</button>
    </div>
    <div id="stock_tab_items_container">
        {{-- @include('sections.supplier_collection') --}}
        @include('sections.product_stock')
    </div>
</div>
@endsection


