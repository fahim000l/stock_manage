<div class="overflow-x-auto mt-2">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Supplier Email</th>
          <th>Date</th>
          <th>Trans Id</th>
          <td>Status</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @foreach ($invoices as $key=>$invoice)
            <tr>
                <th>{{ $key+1 }}</th>
                <td>{{ $invoice->supplier_email }}</td>
                <td>{{ $invoice->date }}</td>
                <td>{{ $invoice->trans_id }}</td>
                <td>
                    @if($invoice->status === 'pending')
                            <span class="badge badge-info badge-lg">{{ $invoice->status }}</span>
                        @else
                            <span class="badge badge-success badge-lg">{{ $invoice->status }}</span>
                    @endif
                </td>
                <td>
                    @if($invoice->status === 'pending')
                            <button
                            id="addProductInvoiceBtn"
                            data-trans_id="{{ $invoice->trans_id }}"
                            data-date="{{ $invoice->date }}"
                            data-supplier_email="{{ $invoice->supplier_email }}"
                            class="btn btn-info normal-case btn-sm">
                            Add Procuct
                            </button>
                        @else
                            <label
                            for="detailsDrawer"
                            id="showProductsInvoiceBtn"
                            data-trans_id="{{ $invoice->trans_id }}"
                            class="btn btn-success normal-case btn-sm">
                            Show Procuct
                            </label>
                    @endif
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
