@php
    $invoice_products

@endphp



<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>
            #
          </th>
          <th>Product Image</th>
          <th>Buy Price</th>
          <th>Sell Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->

        @foreach ($invoice_products as $key=>$invoice_product)


        @php
            $product = App\Models\products_collection::where('product_code', $invoice_product->product_code)->first();

        @endphp

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
                    <p>{{ $product->buy_price }} /-</p>
                </td>
                <td>
                    <p>{{ $product->sell_price }} /-</p>
                </td>
                <td>
                    <label id="showInvoiceQuantityBtn" data-trans_id="{{ $invoice_product->trans_id }}" data-product_code="{{ $product->product_code }}"  for="quantityModal" class="btn btn-info btn-xs">Show quantity</label>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
