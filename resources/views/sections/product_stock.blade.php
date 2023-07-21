<div class="overflow-x-auto mt-2">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>Product Image</th>
          <th>Product Name</th>
          <th>Total Buy Price</th>
          <th>total Sell Price</th>
          <th>total Profit</th>
          <th>total Quantity</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @foreach ($products as $key=>$product)
        @php
            $stock_products = App\Models\product_stock::where('product_code',$product->product_code)->get();
            $stock_quantities = App\Models\quantity_stock::where('product_code',$product->product_code)->get();
            $sizes = App\Models\size_collection::get();
            $total_buy_price = 0;
            $total_sell_price = 0;
            foreach ($stock_products as $stockProductKey => $stock_product) {
                $total_buy_price = $total_buy_price+$stock_product->buy_price;
                $total_sell_price = $total_sell_price+$stock_product->sell_price;
            }
            $total_quantity = 0;
            foreach ($stock_quantities as $quantitikey => $stock_quantitie) {
                $total_quantity = $total_quantity + $stock_quantitie->quantity;
            }
            $total_profit = $total_sell_price - $total_buy_price;
        @endphp
        @if($total_buy_price > 0  && $total_sell_price > 0)
            <tr>
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
                <td>
                    {{ $total_buy_price }} /-
                </td>
                <td>
                    {{ $total_sell_price }} /-
                </td>
                <td>
                    {{ $total_profit }} /-
                </td>
                <td>
                    <label
                    data-product_code="{{ $product->product_code }}"
                    id="productStockQuantityBtn"
                    for="detailsDrawer"
                    class="btn btn-xs btn-info normal-case">
                        {{ $total_quantity }}
                    </label>
                </td>
            </tr>
        @endif
        @endforeach
      </tbody>
    </table>
</div>
