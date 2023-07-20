<p class="my-2 flex">
    <span class="font-bold flex mr-2">Add quantity for :</span>  <span class="badge badge-md badge-primary">{{ $product[0]->product_name }}</span>
</p>
<input id="hiddenKeyInput" type="text" class="hidden">
<form id="setQuantityForm" action="">
    <button id="ManagingProductFormSubmit" data-product_code="{{ $product[0]->product_code }}" type="submit" class="btn btn-success ml-auto my-2 btn-sm">Add</button>
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
            @foreach ($sizes as $key=>$size)
                    <tr>
                        <th>{{ $size->size_name }}</th>
                        <td>
                        <input id="{{ $size->size_id }}" name="{{ $size->size_id }}" value="0" type="text" placeholder="Type here" class="input input-bordered input-xs w-full max-w-xs" />
                        </td>
                    </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</form>
