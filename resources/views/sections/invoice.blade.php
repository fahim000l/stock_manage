
@php

    use Illuminate\Support\Str;

    function get_trans_id(){

        $uuid =  Str::uuid();

        return $uuid;
    }

@endphp


<div class="bg-white rounded-lg mt-2 py-5 px-5 text-black">
    <p class="text-2xl font-bold">Invoice Info</p>
    <div class="mt-2">
        <div class="flex items-center">
            <div class="flex ml-5 items-center w-[50%]">
                <label class="font-bold mr-2">Supplier email : </label>
                <select id="supplierSelect">
                    <option value=""></option>
                    @foreach ($suppliers as $key=>$supplier)
                        <option>{{ $supplier->supplier_email }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex ml-5 items-center w-[50%]">
                <label class="font-bold">Supplier Phone :</label>
                <input name="supplier_phone_num" id="supplier_phone_num" type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs ml-2" />
            </div>
        </div>
        <div class="flex items-center mt-2">
            <div class="flex ml-5 items-center w-[50%]">
                <label class="font-bold">Date : </label>
                <input name="date" id="date" type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs ml-2" />
            </div>

            <div class="flex ml-5 items-center w-[50%]">
                <label class="font-bold">Trans Id : </label>
                <input value="{{ get_trans_id() }}" id="trans_id" name="trans_id" type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs ml-2" />
            </div>
        </div>
    </div>
</div>


<div class="bg-white rounded-lg mt-2 py-5 px-5 text-black">
    <p class="text-2xl font-bold">Select Products</p>
    <div class="mt-2">
        <div class="overflow-x-auto">
            <table class="table addProductTable">
              <!-- head -->
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>Select Product</th>
                  <th>Image</th>
                  <th>Buy Price</th>
                  <th>Sell Price</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                @foreach ($products as $key=>$product)
                    <tr>
                        <th>
                            {{ $key+1 }}
                        </th>
                        <td>
                            <select
                            disabled
                            data-sell_price="{{ $product->sell_price  }}"
                            data-buy_price="{{  $product->buy_price  }}"
                            data-product_img="{{  $product->product_img  }}"
                            data-product_name="{{ $product->product_name }}" class="selectProducts select_num_{{ $key+1 }}">
                                <option></option>

                                @php
                                    $innerproducts = $products
                                @endphp
                                @foreach ($innerproducts as $innerKey=>$innerproduct)
                                    <option class="{{ $innerproduct->product_code }}" value="{{ $innerproduct->product_code }}">{{ $innerproduct->product_name }}</option>
                                @endforeach
                                <input type="text" class="hidden hidden_pc_{{ $key+1 }}">
                            </select>
                        </td>
                        <td>
                            <i class="fa-solid fa-image text-gray-800 imgIco_{{ $key+1 }}"></i>
                            <div class="avatar hidden product_img_{{ $key+1 }}">
                                <div class="mask mask-squircle w-6 h-6">
                                    <img src="#" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <input disabled value="0" type="text" class="input input-bordered input-sm w-full max-w-xs buy_price_{{ $key+1 }}">
                        </td>
                        <td>
                            <input disabled value="0" type="text" class="input input-bordered input-sm w-full max-w-xs sell_price_{{ $key+1 }}">
                        </td>
                        <th class="flex flex-col items-center">
                            <span class="badge badge-neutral quantity_{{ $key+1 }}">0</span>
                            <label
                            {{-- data-product_name="{{ $ }}" --}}
                            id="setQuantityBtn"
                            for="detailsDrawer"
                            class="btn btn-primary btn-disabled btn-xs d_q_btn_{{ $key+1 }}">details</label>
                        </th>
                        <th>
                            <button id="resetBtn" class="btn btn-circle btn-accent btn-sm reset_{{ $key+1 }}">
                                <i class="fa-solid fa-rotate-left "></i>
                            </button>
                        </th>
                    </tr>
                @endforeach

              </tbody>
            </table>
        </div>
    </div>
</div>


<div class="bg-white rounded-lg mt-2 py-5 px-5 text-black">
    <p class="text-2xl font-bold">Summary</p>
    <div class="mt-2 grid grid-cols-2 gap-4">
        <div>
            <div class="my-2 font-bold">
                <label for="">
                 Total Buy Price :
                </label>
                <input value="0" disabled id="total_buy_price" type="text" class="input input-bordered input-sm w-full max-w-xs">
             </div>
             <div class=" my-2 font-bold">
                 <label for="">
                     Total Sell Price :
                 </label>
                 <input value="0" id="total_sell_price" disabled type="text" class="input input-bordered input-sm w-full max-w-xs">
             </div>
             <div class="my-2 font-bold">
                 <label for="">
                     Total Selected Products :
                 </label>
                 <input id="total_products" value="0" disabled type="text" class="input input-bordered input-sm w-full max-w-xs">
             </div>
        </div>
        <div>
            <div class="my-2 font-bold flex justify-between">
                <label for="">
                    Supplier Email :
                </label>
                <span id="s_email_summary" class="badge badge-md badge-primary">null</span>
            </div>
            <div class="my-2 font-bold flex justify-between">
                <label for="">
                    Date of Invoice :
                </label>
                <span id="date_summary" class="badge badge-md badge-primary">null</span>
            </div>
            <div class="my-2 font-bold flex justify-between">
                <label for="">
                    Trans Id :
                </label>
                <span id="transId_summary" class="badge badge-md badge-primary">null</span>
            </div>
            <button id="stockInBtn" class="btn btn-success normal-case w-full mt-5">Stock In</button>
        </div>
    </div>
</div>
