<div class="overflow-x-auto mt-2">
    <table id="invoiceStockTable" class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>#</th>
          <th>Invoice</th>
          <th>Supplier Email</th>
          <th>Buy Price</th>
          <th>Sell Price</th>
          <th>Profit</th>
          <th>Total Products</th>
          <th>Total quantity</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->

        @foreach ($invoices as $key=>$invoice)

            @php
                // $invoice_products = App\Models\product_stock::where('trans_id',$invoice->trans_id)->get();

                // $invoice_quantity = App\Models\quantity_stock::where('trans_id',$invoice->trans_id)->get();

                // $suppliers = App\Models\suppliers_collection::get();

                $total_buy_price = 0;
                $total_sell_price = 0;

                foreach ($invoice->invoice_products as $innerKey => $invoice_product) {
                    $total_buy_price = $total_buy_price + $invoice_product->buy_price;

                    $total_sell_price = $total_sell_price + $invoice_product->sell_price;
                }

                $total_profit = $total_sell_price-$total_buy_price;

                $total_quantity = 0;

                foreach ($invoice->invoice_quantity as $quantitykey => $invoice_quantitie) {
                    $total_quantity = $total_quantity + $invoice_quantitie->quantity;
                }


            @endphp


            <tr>
                <th>{{ $key+1 }}</th>
                <td>
                    <input disabled id="invoice_stock_date_input_{{ $key+1 }}" value="{{ $invoice->date }}" type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs" />
                    <p>Trans Id : {{ substr($invoice->trans_id, 0, 8) }}</p>
                </td>
                <td>
                    <select disabled id="invoiceStockSelectEmail" class="select select-bordered select-sm w-full max-w-xs invoice_stock_select invoice_stock_sp_email_input_{{ $key+1 }}">
                        <option value="{{ $invoice->supplier_email }}" selected>{{ $invoice->supplier_email }}</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->supplier_email }}">{{ $supplier->supplier_email }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    {{ $total_buy_price }}
                </td>
                <td>
                    {{ $total_sell_price }}
                </td>
                <td>
                    {{ $total_profit }}
                </td>
                <td>
                    <label data-trans_id="{{ $invoice->trans_id }}" id="indexInvoiceProductBtn" for="detailsDrawer" class="btn btn-xs btn-accent">{{ count($invoice->invoice_products) }}</label>
                </td>
                <td>
                    {{ $total_quantity }}
                </td>
                <td>
                    <button id="invoiceEditBtn" class="btn btn-xs btn-circle btn-neutral invoice_edit_key_{{ $key+1 }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button data-trans_id="{{ $invoice->trans_id }}" id="invoiceEditConfirmBtn" class="btn btn-xs btn-circle btn-success hidden invoice_edit_confirm_key_{{ $key+1 }}">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
                <td>
                    <label
                    for="invoiceDeleteConfirmModal"
                    data-trans_id="{{ $invoice->trans_id }}"
                     id="invoiceDeleteBtn" class="btn btn-error btn-circle btn-xs">
                        <i class="fa-solid fa-trash"></i>
                    </label>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>

{{-- <script>
    $(document).ready(function(){
        $('select').select2({
            allowClear:true,
        })

    })
</script> --}}
