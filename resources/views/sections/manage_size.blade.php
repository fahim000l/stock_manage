<p class="font-bold my-2">Manage quantity for : <span id="msProductName" class="badge badge-primary badge-lg">primary</span> </p>
<input id="hiddenProductCode" class="hidden" type="text">
<form id="manageQuantityForm" action="">
    <button type="submit" id="sizeConfirmBtn" class="btn btn-success btn-sm normal-case w-full">Confirm</button>
    <div class="overflow-x-auto mt-2">
        <table id="manageSizeTable" class="table table-zebra">
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
                    <input name="{{ $size->size_id }}" id="{{ $size->size_id }}" type="number" placeholder="insert quantity of {{ $size->size_name }} size" class="input input-bordered input-sm w-full max-w-xs " />
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</form>
