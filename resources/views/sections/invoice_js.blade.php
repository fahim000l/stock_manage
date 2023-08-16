<script>
    $(document).ready(function(){

        $('#date').val(`${new Date().getDate()}-${new Date().getMonth()+1}-${new Date().getFullYear()}`)

        console.log($('.addProductTable')[0])
        $('#supplierSelect').select2({
            placeholder:'Select supplier',
            allowClear:true
        })

        $('.selectProducts').select2({
            placeholder:'Select Product',
            allowClear:true,
        })

        $(document).on('select2:select','#supplierSelect',function(){
            console.log($(this).val())
            const supplierEmail = $(this).val()

            $.ajax({
                url:'{{ route('get.supplier') }}',
                method:'POST',
                dataType:'json',
                data:{supplier_email:supplierEmail},
                success:function(res){
                    console.log(res[0])
                    const response = res[0]
                    $('#supplier_phone_num').val(response?.supplier_phone)
                    $('#s_email_summary').text(response?.supplier_email)
                    $('#date_summary').text(`${new Date().getDate()}-${new Date().getMonth()+1}-${new Date().getFullYear()}`)
                    $('#transId_summary').text($('#trans_id').val())
                    $('.selectProducts').removeAttr('disabled')
                },
                error:function(err){
                    console.log(err)

                }
            })
        })

        $(document).on('select2:unselect','#supplierSelect',function(){
            $('#supplier_phone_num').val('')
            $('#s_email_summary').text('null')
            $('#date_summary').text(`null`)
            $('#transId_summary').text('null')
            $('.selectProducts').prop('disabled',true)
        })


        let selectedkeys = []



        let selectedProducts = []


        $(document).on('select2:select','.selectProducts',function(){
            const selectedField = $(this).attr('class').split(' ')[1]
            const selectedKey = selectedField.split('_')[2]
            console.log(selectedKey)


            const productCode = $(this).val()
            console.log('product_code',productCode)

            $.ajax({
                url:'{{ route('get.product') }}',
                method:'POST',
                dataType:'json',
                data:{product_code:productCode},
                success:function(res){
                    const selectedProduct = res[0]
                    $(`.hidden_pc_${selectedKey}`).val(selectedProduct?.product_code)
                    $(`.product_img_${selectedKey}`).removeClass('hidden')
                    $(`.imgIco_${selectedKey}`).addClass('hidden')
                    $(`.product_img_${selectedKey} img`).attr('src',`{{ asset('storage/uploads/${selectedProduct?.product_img}') }}`)
                    $(`.d_q_btn_${selectedKey}`).removeClass('btn-disabled')
                    $(`.d_q_btn_${selectedKey}`).attr('data-product_code',selectedProduct?.product_code)
                    $(`.buy_price_${selectedKey}`).removeAttr('disabled')
                    $(`.sell_price_${selectedKey}`).removeAttr('disabled')
                    $(`.buy_price_${selectedKey}`).val(selectedProduct?.buy_price)
                    $(`.sell_price_${selectedKey}`).val(selectedProduct?.sell_price)
                    if(!selectedkeys.includes(selectedKey)){
                        selectedkeys.push(selectedKey)
                        selectedProducts.push({product_code:selectedProduct?.product_code,trans_id:$('#transId_summary').text(),buy_price:$(`.buy_price_${selectedKey}`).val(),sell_price:$(`.sell_price_${selectedKey}`).val()})
                        $(`.${selectedProduct?.product_code}`).attr('disabled',true)

                        console.log(selectedProducts)
                    }

                    console.log(selectedkeys)

                    $('#total_buy_price').val(selectedkeys?.reduce((total,key)=> total+parseInt($(`.buy_price_${key}`).val()),0))
                    $('#total_sell_price').val(selectedkeys?.reduce((total,key)=> total+parseInt($(`.sell_price_${key}`).val()),0))
                    $('#total_products').val(selectedkeys?.length)



                },
                error:function(err){
                    console.log(err)
                }
            })

        })


        $(document).on('change','#buy_price',function(){
            const selectedField = $(this).attr('class').split(' ')[5]
            const selectedKey = selectedField.split('_')[2]

            const productCode = $(`.hidden_pc_${selectedKey}`).val()
            changingProduct = selectedProducts?.find(product=> product?.product_code === productCode);

            selectedProducts = selectedProducts?.filter(product=>product?.product_code !== productCode);

            changingProduct['buy_price'] = $(`.buy_price_${selectedKey}`).val()

            selectedProducts.push(changingProduct);


        })


        $(document).on('change','#sell_price',function(){
            const selectedField = $(this).attr('class').split(' ')[5]
            console.log(selectedField)
            const selectedKey = selectedField.split('_')[2]
            console.log(selectedKey)

            const productCode = $(`.hidden_pc_${selectedKey}`).val()
            const changingProduct = selectedProducts?.find(product => product?.product_code === productCode);

            selectedProducts = selectedProducts?.filter(product => product?.product_code !== productCode);

            changingProduct['sell_price'] = $(`.sell_price_${selectedKey}`).val()

            selectedProducts.push(changingProduct)


        })





        $(document).on('select2:unselect','.selectProducts',function(){
            const unselectedField = $(this).attr('class').split(' ')[1]
            const unselectedKey = unselectedField.split('_')[2]


            const productCode = $(`.hidden_pc_${unselectedKey}`).val()
            console.log(unselectedKey)


            $(`.product_img_${unselectedKey}`).addClass('hidden')
            $(`.imgIco_${unselectedKey}`).removeClass('hidden')
            $(`.d_q_btn_${unselectedKey}`).addClass('btn-disabled')
            $(`.buy_price_${unselectedKey}`).prop('disabled',true)
            $(`.sell_price_${unselectedKey}`).prop('disabled',true)
            $(`.product_img_${unselectedKey} img`).attr('src',`#') }}`)
            $(`.buy_price_${unselectedKey}`).val(0)
            $(`.sell_price_${unselectedKey}`).val(0)

            selectedkeys = selectedkeys?.filter(key => key !== unselectedKey);
            console.log(selectedkeys)

            $('#total_buy_price').val(selectedkeys?.reduce((total,key)=> total+parseInt($(`.buy_price_${key}`).val()),0))
            $('#total_sell_price').val(selectedkeys?.reduce((total,key)=> total+parseInt($(`.sell_price_${key}`).val()),0))
            $('#total_products').val(selectedkeys?.length)

            $(`.${productCode}`).attr('disabled',false)
            selectedProducts = selectedProducts?.filter(product=> product?.product_code !== productCode)
            $(`.hidden_pc_${unselectedKey}`).val('')

            console.log(selectedProducts)


        })

        $(document).on('click','#resetBtn',function(){
            const classList = $(this).attr('class').split(' ')
            const selectedKey = classList[4].split('_')[1];

            const productCode = $(`.hidden_pc_${selectedKey}`).val()

            $(`.product_img_${selectedKey}`).addClass('hidden')
            $(`.imgIco_${selectedKey}`).removeClass('hidden')
            $(`.d_q_btn_${selectedKey}`).addClass('btn-disabled')
            $(`.buy_price_${selectedKey}`).prop('disabled',true)
            $(`.sell_price_${selectedKey}`).prop('disabled',true)
            $(`.product_img_${selectedKey} img`).attr('src',`#') }}`)
            $(`.buy_price_${selectedKey}`).val(0)
            $(`.sell_price_${selectedKey}`).val(0)
            $(`.select_num_${selectedKey}`).val(null).trigger('change')

            selectedkeys = selectedkeys?.filter(key => key !== selectedKey);
            $(`.${productCode}`).attr('disabled',false)
            selectedProducts = selectedProducts?.filter(product=> product?.product_code !== productCode)
            console.log(selectedkeys)
            $(`.hidden_pc_${selectedKey}`).val('')
            console.log(selectedProducts)

        })

        $(document).on('click','#setQuantityBtn',function(){
            const productCode = $(this).data('product_code');
            const classList = $(this).attr('class').split(' ');
            const selectedKey = classList[3].split('_')[3]
            console.log(selectedKey)
            localStorage.setItem('addProductQuantityRow',selectedKey)

            const lastSelected = localStorage.getItem('addProductQuantityRow')
                $.ajax({
                    url:'{{ route('index.setquantity.table') }}',
                    method:'POST',
                    data:{product_code:productCode},
                    success:function(res){
                        $('#detailsDrawerContent').html(res)
                        $('#hiddenKeyInput').val(selectedKey)
                    }
                })
        })




        $(document).on('submit','#setQuantityForm',function(event){
            event.preventDefault();
            let totalQuantity = 0

            const productCode = $('#ManagingProductFormSubmit').data('product_code')

            const managingProduct = selectedProducts?.find(product => product?.product_code === productCode);

            selectedProducts = selectedProducts?.filter(product => product?.product_code !== productCode)

            Array.from($('#setQuantityForm tbody')[0].children).map(chield => {
                console.log(chield.children[1].children[0].value)
                totalQuantity = parseInt(totalQuantity) + parseInt(chield.children[1].children[0].value)
                console.log(chield.children[1].children[0].id)

                managingProduct[`${chield.children[1].children[0].id}`] = parseInt(chield.children[1].children[0].value)
                console.log(managingProduct)
            })

            selectedProducts?.push(managingProduct)

            console.log(selectedProducts)

            const quantityForKey = $('#hiddenKeyInput').val();

            $(`.quantity_${quantityForKey}`).text(totalQuantity)
            $('#detailsDrawer').click();

        })



        let stock_products = [0,1,2,3,4];
        $(document).on('click','#addRecord',function(){
            $('#addProductsTbody').append(
                `
                    <tr>
                        <th>
                            ${stock_products.length+1}
                        </th>
                        <td>
                            <select
                            ${$('#supplierSelect').val() ? '' : 'disabled'}
                            {{-- data-sell_price="{{ $product->sell_price  }}" --}}
                            {{-- data-buy_price="{{  $product->buy_price  }}" --}}
                            {{-- data-product_img="{{  $product->product_img  }}" --}}
                            {{-- data-product_name="{{ $product->product_name }}" --}} class="selectProducts select_num_${stock_products.length+1}">
                                <option></option>
                                @php
                                    $innerproducts = $products
                                @endphp
                                @foreach ($innerproducts as $innerKey=>$innerproduct)
                                    <option class="{{ $innerproduct->product_code }}" value="{{ $innerproduct->product_code }}">{{ $innerproduct->product_name }}</option>
                                @endforeach
                                <input type="text" class="hidden hidden_pc_${stock_products.length+1}">
                            </select>
                        </td>
                        <td>
                            <i class="fa-solid fa-image text-gray-800 imgIco_${stock_products.length+1}"></i>
                            <div class="avatar hidden product_img_${stock_products.length+1}">
                                <div class="mask mask-squircle w-6 h-6">
                                    <img src="#" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <input id="buy_price" disabled value="0" type="text" class="input input-bordered input-sm w-full max-w-xs buy_price_${stock_products.length+1}">
                        </td>
                        <td>
                            <input id="sell_price" disabled value="0" type="text" class="input input-bordered input-sm w-full max-w-xs sell_price_${stock_products.length+1}">
                        </td>
                        <th class="flex flex-col items-center">
                            <span class="badge badge-neutral quantity_${stock_products.length+1}">0</span>
                            <label
                            {{-- data-product_name="{{ $ }}" --}}
                            id="setQuantityBtn"
                            for="detailsDrawer"
                            class="btn btn-primary btn-disabled btn-xs d_q_btn_${stock_products.length+1}">details</label>
                        </th>
                        <th>
                            <button id="resetBtn" class="btn btn-circle btn-accent btn-sm reset_${stock_products.length+1}">
                                <i class="fa-solid fa-rotate-left "></i>
                            </button>
                        </th>
                    </tr>
                `
            )

            $('.selectProducts').select2({
                placeholder:'Select Product',
                allowClear:true,
            })

            stock_products.push(stock_products.length);
        })


        $(document).on('click','#stockInBtn',function(){

            let status = false
            let stockInfo = {};
            let productInfo = [];
            let quantityInfo = [];
            console.log('clicked')
            const invoiceInfo = {
                trans_id : $('#transId_summary').text(),
                supplier_email:$('#s_email_summary').text(),
                date:$('#date_summary').text(),
                status:'success'
            }

            selectedProducts?.forEach(product => {
                if(Object.keys(product).length > 4){

                    productInfo.push({product_code:product?.product_code,trans_id:product?.trans_id,buy_price:product?.buy_price,sell_price:product?.sell_price});
                    Object.keys(product).forEach(key => {
                        if(key !== 'product_code' && key !== 'trans_id' && key !== 'buy_price' && key !== 'sell_price'){
                            quantityInfo.push({trans_id:product.trans_id,product_code:product.product_code,size_id:key,quantity:product[`${key}`]})
                            status = true
                        }
                    })
                }
                else{
                    status = false
                    return
                }
            })


            if(status === true){
                stockInfo['productInfo'] = productInfo;
                stockInfo['quantityInfo'] = quantityInfo;
                stockInfo['invoiceInfo'] = invoiceInfo;
                console.log(stockInfo)

                $.ajax({
                    url:'{{ route('stocking.in') }}',
                    method:'POST',
                    contentType:'application/json',
                    data:JSON.stringify(stockInfo),
                    success:function(res){
                        console.log(res)
                        if(res.status === 'success'){
                            location.href = '/stock-collection'
                        }
                    },
                    error:function(err){
                        console.log(err)
                    }
                })


            }





        })




    })
</script>
