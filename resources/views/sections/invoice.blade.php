
@php

    use Illuminate\Support\Str;

    function get_trans_id(){

        $uuid =  Str::uuid();

        return $uuid;
    }

    $stock_array = [1,2,3,4,5];

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
              <tbody id="addProductsTbody">
                <!-- row 1 -->
                {{-- <input id="hidden_array_input" value="{{ implode(', ', $stock_array) }}" type="text"> --}}


              </tbody>
            </table>
            <button id="addRecord" class="btn btn-sm text-2xl btn-primary">

                <i class="fa-solid fa-plus"></i>
            </button>
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


<script>
    $('#date').val(`${new Date().getDate()}-${new Date().getMonth()+1}-${new Date().getFullYear()}`)

    const stock_products = [1,2,3,4,5];


        stock_products?.forEach((value,i) => {
            $.ajax({
                url:'{{ route('add.product.tr') }}',
                method:'POST',
                data:{key:i},
                success:function(res){
                    $('#addProductsTbody').append(res)
                }
            })
        })


    console.log($('.addProductTable')[0])
    $('#supplierSelect').select2({
        placeholder:'Select supplier',
        allowClear:true
    })

    $('.selectProducts').select2({
        placeholder:'Select Product',
        allowClear:true,
    })
</script>
