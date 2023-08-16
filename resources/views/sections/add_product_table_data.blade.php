<tr>
        <th>
            {{ $key+1 }}
        </th>
        <td>
            <select
            disabled
            {{-- data-sell_price="{{ $product->sell_price  }}" --}}
            {{-- data-buy_price="{{  $product->buy_price  }}" --}}
            {{-- data-product_img="{{  $product->product_img  }}" --}}
            {{-- data-product_name="{{ $product->product_name }}" --}} class="selectProducts select_num_{{ $key+1 }}">
                <option></option>

                @php
                    $innerproducts = $products
                @endphp
                @foreach ($innerproducts as $innerKey=>$innerproduct)
                    <option class="{{ $innerproduct->product_code }}" value="{{ $innerproduct->product_code }}">{{ $innerproduct->product_name }}</option>
                @endforeach
                <input type="text" class="hidden hidden_pc_{{ $key+1 }}">
            </select>
        </td>
        <td>
            <i class="fa-solid fa-image text-gray-800 imgIco_{{ $key+1 }}"></i>
            <div class="avatar hidden product_img_{{ $key+1 }}">
                <div class="mask mask-squircle w-6 h-6">
                    <img src="#" alt="Avatar Tailwind CSS Component" />
                </div>
            </div>
        </td>
        <td>
            <input id="buy_price" disabled value="0" type="text" class="input input-bordered input-sm w-full max-w-xs buy_price_{{ $key+1 }}">
        </td>
        <td>
            <input id="sell_price" disabled value="0" type="text" class="input input-bordered input-sm w-full max-w-xs sell_price_{{ $key+1 }}">
        </td>
        <th class="flex flex-col items-center">
            <span class="badge badge-neutral quantity_{{ $key+1 }}">0</span>
            <label
            {{-- data-product_name="{{ $ }}" --}}
            id="setQuantityBtn"
            for="detailsDrawer"
            class="btn btn-primary btn-disabled btn-xs d_q_btn_{{ $key+1 }}">details</label>
        </th>
        <th>
            <button id="resetBtn" class="btn btn-circle btn-accent btn-sm reset_{{ $key+1 }}">
                <i class="fa-solid fa-rotate-left "></i>
            </button>
        </th>
    </tr>

    <script>
        $('.selectProducts').select2({
            placeholder:'Select Product',
            allowClear:true,
        })
    </script>
