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
                    <span class="badge badge-info badge-lg">pending</span>
                </td>
                <td>
                    <button
                        id="addProductInvoiceBtn"
                        data-trans_id="{{ $invoice->trans_id }}"
                        data-date="{{ $invoice->date }}"
                        data-supplier_email="{{ $invoice->supplier_email }}"
                        class="btn btn-info normal-case btn-sm">
                        Add Procuct
                    </button>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
