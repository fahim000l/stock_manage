{{-- @php
    $sizes = App\Models\size_collection::get();
@endphp --}}



<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>Field</th>
          <th>Value</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->

        @foreach ($sizes as $key=>$size)


        @php



            $total_quantity = 0;

            foreach ($size->size_quantity as $quantity_key => $size_quantity) {
                $total_quantity = $total_quantity + $size_quantity->quantity;
            }
        @endphp



            <tr>
                <th>{{ $size->size_name }}</th>
                <td>
                    <input disabled value="{{ $total_quantity }}" class="input input-bordered input-sm w-auto max-w-xs invoice_product_quantity_{{$key+1}}" type="text">
                </td>
                <td>
                    <button data-key="{{ $key+1 }}" id="invoiceProductQuantityEditBtn" class="btn btn-xs btn-circle btn-neutral invoice_product_quantity_edit_btn_{{ $key+1 }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button
                    data-key="{{ $key+1 }}"
                    data-trans_id="{{ $size->size_quantity[0]->trans_id }}"
                    data-product_code="{{ $size->size_quantity[0]->product_code }}"
                    data-size_id="{{ $size->size_id }}"
                    id="invoiceProductQuantityEditConfirmBtn"
                    class="btn btn-xs btn-circle btn-success hidden invoice_product_quantity_edit_confirm_btn_{{ $key+1 }}">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
        @endforeach



      </tbody>
    </table>
</div>
