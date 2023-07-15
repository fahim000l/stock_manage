<div class="overflow-x-auto">
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
          <td>{{ $invoice_info->trans_id }}</td>
        </tr>
      </tbody>
    </table>
</div>
