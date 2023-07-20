@extends('layouts.dashboard')

@section('pages')
<div class="px-10">
    <p class="my-2 font-bold text-3xl ml-5">Stock In</p>
    <div class="tabs tabs-boxed">
        <button id="invoice" class="tab w-[50%] tab-active">Invoice</button>
        <button id="supplier_collection" class="tab w-[50%]">Supplier Collection</button>
    </div>
    <div id="tab_items_container">
        {{-- @include('sections.supplier_collection') --}}
        @include('sections.invoice')
    </div>
</div>
@endsection
