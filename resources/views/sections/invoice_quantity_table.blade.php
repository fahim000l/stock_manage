<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>Size</th>
          <th>Quantity</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->

        @foreach ($quantities as $key=>$quantitie)

            @php
                $size = App\Models\size_collection::where('size_id',$quantitie->size_id)->first();
            @endphp


            <tr>
                <td>{{ $size->size_name }}</td>
                <td>{{ $quantitie->quantity }}</td>
                <td>
                    <button data-product_code="{{ $quantitie->product_code }}"
                        data-trans_id="{{ $quantitie->trans_id }}"
                        data-size_id="{{ $quantitie->size_id }}" id="" class="btn btn-info btn-circle btn-xs">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach


      </tbody>
    </table>
</div>
