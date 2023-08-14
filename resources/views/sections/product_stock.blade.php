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
        @foreach ($stock_products as $key=>$stock_product)
        @php
            $total_buy_price = 0;
            $total_sell_price = 0;
            foreach ($stock_product->stock_product_info as $stockProductKey => $inner_product_info) {
                $total_buy_price = $total_buy_price+$inner_product_info->buy_price;
                $total_sell_price = $total_sell_price+$inner_product_info->sell_price;
            }
            $total_quantity = 0;
            foreach ($stock_product->stock_quantity_info as $quantitikey => $inner_quantity_info) {
                $total_quantity = $total_quantity + $inner_quantity_info->quantity;
            }
            $total_profit = $total_sell_price - $total_buy_price;
        @endphp
        @if($total_buy_price > 0  && $total_sell_price > 0)
            <tr>
                <td>
                    <div class="avatar">
                        <div class="mask mask-squircle w-12 h-12">
                            <img src="{{ asset('storage/uploads/'.$stock_product->product_img) }}" alt="Avatar Tailwind CSS Component" />
                        </div>
                    </div>
                </td>
                <td>
                    {{ $stock_product->product_name }}
                </td>
                <td>
                    {{-- 12 --}}
                    {{ $total_buy_price }} /-
                </td>
                <td>
                    {{-- 12 --}}
                    {{ $total_sell_price }} /-
                </td>
                <td>
                    {{-- 12 --}}
                    {{ $total_profit }} /-
                </td>
                <td>
                    <label
                    data-product_code="{{ $stock_product->product_code }}"
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
