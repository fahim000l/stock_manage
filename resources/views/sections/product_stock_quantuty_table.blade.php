@php
    $sizes = App\Models\size_collection::get();
    $total_quantity = 0;
@endphp

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
        @foreach ($sizes as $size)

            @php

                $total_size_quantity = 0;

                $stock_quantities = App\Models\quantity_stock::where('product_code',$selected_product)->where('size_id',$size->size_id)->get();

                foreach ($stock_quantities as $key => $stock_quantitie) {
                    $total_size_quantity = $total_size_quantity + $stock_quantitie->quantity;

                }

                $total_quantity = $total_quantity + $total_size_quantity;

            @endphp


            <tr>
                <td>{{ $size->size_name }}</td>
                <td>{{ $total_size_quantity }}</td>
            </tr>
        @endforeach
            <tr>
                <td>
                    Total
                </td>
                <td>
                    {{ $total_quantity }}
                </td>
            </tr>
      </tbody>
    </table>
</div>
