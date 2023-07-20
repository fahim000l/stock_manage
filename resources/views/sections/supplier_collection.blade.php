
@php
    use Illuminate\Support\Str;
    $uuid =  Str::uuid();
@endphp

<div>
    <label for="addSupplierModal" class="btn flex ml-auto w-[20%] mt-2 normal-case">Add Supplier</label>
    <div class="overflow-x-auto mt-2">
        <table id="supplierTable" class="table">
          <!-- head -->
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>Email</th>
              <th>Phone Number</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suppliers as $key=>$supplier)
                <tr>
                    <th>{{ $key+1 }}</th>
                    <td>{{ $supplier->supplier_email  }}</td>
                    <td>{{ $supplier->supplier_phone }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <input value="{{ $uuid }}" id="transId" class="hidden" type="text">
    </div>
</div>
