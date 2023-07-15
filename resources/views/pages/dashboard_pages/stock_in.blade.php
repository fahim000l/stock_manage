@extends('layouts.dashboard')

@section('pages')
<div class="px-10">
    <p class="my-2 font-bold text-3xl ml-5">Stock In</p>
    <div class="tabs tabs-boxed">
        <button id="supplier_collection" class="tab tab-active">Supplier Collection</button>
        <button id="invoice_collection" class="tab">Invoice Collection</button>
        <button id="products_collection" class="tab" >Products Collection</button>
        <button id="selected_products" class="tab" >Selected Product</button>
    </div>
    <div id="tab_items_container">
        @include('sections.supplier_collection')
    </div>
</div>
@endsection
