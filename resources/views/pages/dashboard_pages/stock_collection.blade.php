@extends('layouts.dashboard')

@section('pages')


<div class="px-10">
    <p class="my-2 font-bold text-3xl ml-5">Stock Collection</p>
    <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>Product Image</th>
              <th>Product Name</th>
              <th>Invoices</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->

            @foreach ($products as $key=>$product)
                <tr>
                    <th>
                        {{ $key+1 }}
                    </th>
                    <td>
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="{{ asset('storage/uploads/'.$product->product_img) }}" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $product->product_name }}
                    </td>
                    <th>
                        <label
                        id="scInvoiceDetailsBtn"
                        data-product_code="{{ $product->product_code }}"
                         for="detailsDrawer"
                         class="btn btn-info btn-xs">details</label>
                    </th>
                </tr>
            @endforeach


          </tbody>
        </table>
    </div>
</div>
@endsection


