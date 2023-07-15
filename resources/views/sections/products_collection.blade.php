<div>
    <div id="invoiceDetails" class="justify-between items-end hidden">
        <div class="bg-sky-500 p-4 rounded-lg mt-2 w-[60%]">
            <p class="flex justify-between items-center text-black font-bold"><span>Supplier Email :</span>  <span id="supplierEmailSpan">{{ $invoiceInfo[0] }}</span></p>
            <p class="flex justify-between items-center text-black font-bold"><span>Date :</span> <span id="dateSpan">{{ $invoiceInfo[2] }}</span></p>
            <p class="flex justify-between items-center text-black font-bold"><span>Trans Id :</span> <span id="transIdSpan">{{ $invoiceInfo[1] }}</span></p>
        </div>
        <button id="confirmSelectedProducts" class="btn btn-success normal-case">Confirm</button>
    </div>
    <div class="overflow-x-auto mt-2">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th id="selectProductTh" class="hidden">#</th>
              <th>Product Image</th>
              <th>Product Name</th>
              <th>Product Code</th>
              <th>Buy Price</th>
              <th>Sell Price</th>
            </tr>
          </thead>
          <tbody id="productsCollectionTb">
            <!-- row 1 -->
            @foreach ($products as $key=>$product)
                <tr>
                    <th class="hidden selectProductTd productID_{{ $product->product_code }}">
                    <label>
                        <input data-product_name="{{ $product->product_name }}" data-product_img="{{ $product->product_img }}" data-product_code="{{ $product->product_code }}" id="selectProduct" type="checkbox" class="checkbox" />
                    </label>
                    </th>
                    <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="{{ asset('storage/uploads/'.$product->product_img) }}" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                    </div>
                    </td>
                    <td>
                        {{ $product->product_name }}
                    </td>
                    <td>
                        {{ $product->product_code }}
                    </td>
                    <td>
                        {{ $product->buy_price }} /-
                    </td>
                    <td>
                        {{ $product->sell_price }} /-
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    @include('sections.invoice_collection_js')
</div>
