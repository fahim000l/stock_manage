<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>Size</th>
          <th>Quantity</th>
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
            </tr>
        @endforeach


      </tbody>
    </table>
</div>
