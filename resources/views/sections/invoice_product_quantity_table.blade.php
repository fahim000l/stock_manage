@php
    $sizes = App\Models\size_collection::get();
@endphp



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
                $quantity_info = App\Models\quantity_stock::where('trans_id',$selected_invoice)->where('product_code',$selectedProduct)->where('size_id',$size->size_id)->first();
            @endphp



            <tr>
                <th>{{ $size->size_name }}</th>
                <td>
                    <input disabled value="{{ $quantity_info->quantity }}" class="input input-bordered input-sm w-auto max-w-xs invoice_product_quantity_{{$key+1}}" type="text">
                </td>
                <td>
                    <button data-key="{{ $key+1 }}" id="invoiceProductQuantityEditBtn" class="btn btn-xs btn-circle btn-neutral invoice_product_quantity_edit_btn_{{ $key+1 }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button
                    data-key="{{ $key+1 }}"
                    data-trans_id="{{ $quantity_info->trans_id }}"
                    data-product_code="{{ $quantity_info->product_code }}"
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
