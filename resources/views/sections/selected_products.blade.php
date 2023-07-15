<div>
    <button id="stockInBtn" class="btn btn-success normal-case flex mt-2 w-[20%] ml-auto">Stock In</button>
    <div class="overflow-x-auto mt-2">
        <table id="selectedProductsTable" class="table">
          <!-- head -->
          <thead>
            <tr>
              <th>Product Image</th>
              <th>Product Name</th>
              <th>Product Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="selectedProductTbody">
            <!-- row 1 -->
            @foreach ($selected_products as $key=>$selected_product)
                <tr>
                    <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="{{ asset('storage/uploads/'.$selected_product['productImg']) }}" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                    </div>
                    </td>
                    <td>
                        {{ $selected_product['productName'] }}
                    </td>
                    <td>
                        {{ $selected_product['productCode'] }}
                    </td>
                    <td id="{{ $selected_product['productCode'] }}_td">
                        <label data-product_name="{{ $selected_product['productName'] }}" data-product_code="{{ $selected_product['productCode'] }}" id="manageSizeBtn" for="detailsDrawer" class="btn btn-sm btn-info normal-case border {{ $selected_product['productCode'] }}">Manage Quantity</label>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>
