<div id="hiddenDeleteDiv" class="p-2 hidden">
    <label for="invoicePdsDltCnfmModal" id="invoiceProductsDeleteBtn" class="btn btn-error">
        <i class="fa-solid fa-trash"></i>
    </label>
</div>

<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>
          </th>
          <th>
            #
          </th>
          <th>Product</th>
          <th>Buy Price</th>
          <th>Sell Price</th>
          <th>Profit</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->


        @foreach ($invoice_products as $key=>$invoice_product)
            @php
                $profit = $invoice_product->sell_price - $invoice_product->buy_price;

                $total_quantity = 0;

                foreach ($invoice_product->product_quantity as $innerKey => $invoice_product_quantitie) {
                   $total_quantity = $total_quantity + $invoice_product_quantitie->quantity;
                }

            @endphp
            <tr>
                <th>
                    <label>
                      <input
                        data-key="{{ $key+1 }}"
                      data-trans_id="{{ $invoice_product->trans_id }}"
                      data-product_code="{{ $invoice_product->product_code }}"
                       id="invoiceProductCheck" type="checkbox" class="checkbox" />
                    </label>
                </th>
                <th>
                    {{ $key+1 }}
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img id="invoiceProductImg" src="{{ asset('storage/uploads/'.$invoice_product->products_info->product_img) }}" alt="Avatar Tailwind CSS Component" class="invoice_product_img_{{ $key+1 }}" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">
                                <select
                                data-key="{{ $key+1 }}"
                                disabled
                                id="invoiceProductSelect"
                                class="select select-bordered select-sm w-full max-w-xs invoice_product_name_select_{{ $key+1 }}">
                                    <option
                                    selected
                                    value="{{ $invoice_product->product_code }}">
                                        {{ $invoice_product->products_info->product_name }}
                                    </option>
                                    @foreach ($products as $productsKey=>$product)
                                        <option value="{{ $product->product_code }}">
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- {{ $product_info->product_name }} --}}
                            </div>
                            <div class="text-sm opacity-50 mt-2">
                                quantity :
                                <label
                                data-trans_id="{{ $invoice_product->trans_id }}"
                                data-product_code="{{$invoice_product->product_code }}"
                                id="indexInvoiceProductQuantityBtn" for="detailsModal" class="btn btn-xs btn-primary">{{ $total_quantity }}</label>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <input disabled value="{{ $invoice_product->buy_price }}" class="input input-bordered input-sm w-auto max-w-xs invoice_product_buy_price_{{$key+1}}" type="text">
                </td>
                <td>
                    <input disabled value="{{ $invoice_product->sell_price }}" class="input input-bordered input-sm w-auto max-w-xs invoice_product_sell_price_{{$key+1}}" type="text">
                </td>
                <td>
                    <p class="invoice_product_profit_{{ $key+1 }}">
                        {{ $profit }}
                    </p>
                </td>
                <th>
                    <button id="invoiceProductEditBtn" data-key="{{ $key+1 }}" class="btn btn-info btn-circle btn-xs invoice_product_edit_key_{{ $key+1 }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button id="invoiceProductEditConfirmBtn"
                    data-product_code="{{ $invoice_product->product_code }}"
                    data-trans_id="{{ $invoice_product->trans_id }}" data-key="{{ $key+1 }}" class="btn btn-xs btn-circle btn-success hidden invoice_product_edit_confirm_key_{{ $key+1 }}">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </th>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
