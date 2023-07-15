<h3 class="font-bold text-lg">Invoice Product Quantity</h3>
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
                @foreach ($quantities as $quantity)

                    @php
                        $size = App\Models\size_collection::where('size_id',$quantity->size_id)->first();
                    @endphp


                    <tr>
                        <th>{{ $size->size_name }}</th>
                        <td>{{ $quantity->quantity }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
