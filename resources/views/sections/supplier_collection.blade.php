
@php
    use Illuminate\Support\Str;
    $uuid =  Str::uuid();
@endphp

<div class="overflow-x-auto mt-2">
    <table id="supplierTable" class="table">
      <!-- head -->
      <thead>
        <tr>
          <th id="addSupplierBtn" class="cursor-pointer">
            <i id="plusIcon" class="fa-solid fa-circle-plus text-xl"></i>
            <i id="minusIcon" class="fa-sharp fa-solid fa-circle-xmark text-xl hidden"></i>
          </th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        <tr id="addSupplierRow" class="hidden">
          <form method="POST" id="addSupplierForm" action="">
            @csrf
            <th>#</th>
            <td id="supplier_email_td">
                <input name="supplier_email" id="supplier_email" type="email" placeholder="Supplier Email" class="input input-bordered input-sm w-full max-w-xs" />
            </td>
            <td id="supplier_phone_td">
                <input name="supplier_phone" id="supplier_phone" type="text" placeholder="Supplier Phone" class="input input-bordered input-sm w-full max-w-xs" />
            </td>
            <td>
                <button type="submit" class="btn btn-sm btn-neutral normal-case">Add</button>
            </td>
          </form>
        </tr>
        @foreach ($suppliers as $key=>$supplier)
            <tr>
                <th>{{ $key+1 }}</th>
                <td>{{ $supplier->supplier_email  }}</td>
                <td>{{ $supplier->supplier_phone }}</td>
                <td>
                    <label
                    data-supplier_email="{{ $supplier->supplier_email }}"
                    id="supplierSelectBtn"
                    for="selectSupplierModal"
                    class="btn btn-sm btn-primary normal-case">Select</label>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    <input value="{{ $uuid }}" id="transId" class="hidden" type="text">
</div>
