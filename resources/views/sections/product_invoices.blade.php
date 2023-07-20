<div class="overflow-x-auto">
    @foreach ($invoices as $invoice)

    @php
        $invoice_info = App\Models\invoices_collection::where('trans_id',$invoice->trans_id)->first();
    @endphp


@isset($invoice_info)
        <div class="bg-white p-2 border border-2 border-gray-200 rounded-lg my-2">
            <button data-trans_id="{{ $invoice->trans_id }}" id="delete_stock" class="btn btn-error btn-circle btn-xs mb-2 ml-auto">
                <i class="fa-solid fa-trash"></i>
            </button>
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <!-- row 1 -->

                    <tr>
                        <th>Date</th>
                        <td>{{ $invoice_info->date }}</td>
                    </tr>
                    <!-- row 2 -->
                    <tr>
                        <th>Supplier Email</th>
                        <td>{{ $invoice_info->supplier_email }}</td>
                    </tr>
                    <!-- row 3 -->
                    <tr>
                        <th>Trans Id</th>
                        <td>{{ $invoice->trans_id }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>
                            <label
                            for="detailsModal"
                            id="invoiceDetailsQuantityBtn"
                            data-product_code="{{ $invoice->product_code }}"
                            data-trans_id="{{ $invoice->trans_id }}"
                            class="btn btn-xs btn-info normal-case">Show quantity</label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endisset
    @endforeach
</div>
