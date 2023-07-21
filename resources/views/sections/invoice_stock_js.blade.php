<script>
    $(document).ready(function(){



        $('#invoiceStockSelectEmail').select2({
            allowClear:true,
        })


            // $('.invoice_stock_select').hide();


        let selectedProducts = []

        $(document).on('click','#indexInvoiceProductBtn',function(){
            const transId = $(this).data('trans_id');
            const lastClicked = $('lastClicked').text();

            if(lastClicked !== transId){
                $.ajax({
                    url:'{{ route('index.invoice.products') }}',
                    method:'POST',
                    data:{trans_id:transId},
                    success:function(res){
                        $('#detailsDrawerContent').html(res)
                        $('lastClicked').text(transId)
                        selectedProducts = [];
                    },
                    error:function(err){
                        console.log(err);
                    }
                })
            }
        })




        $(document).on('click','#indexInvoiceProductQuantityBtn',function(){

            const transId = $(this).data('trans_id');
            const productCode = $(this).data('product_code');

            console.log({transId,productCode});

            $.ajax({
                url:'{{ route('index.invoice.product.quantity') }}',
                method:'POST',
                data:{product_code:productCode,trans_id:transId},
                success:function(res){
                    $('#detailsModalContent').html(res);
                }
            })
        })

        $(document).on('click','#invoiceDeleteBtn',function(){
            const transId = $(this).data('trans_id');

            $('#invoiceDeletingModalTransId').text(`Trans Id : ${transId}`)
        })

        $(document).on('click','#invoiceDeleteConfirmBtn',function(){
            const transId = $('#invoiceDeletingModalTransId').text().split('Trans Id : ')[1]


            $.ajax({
                url:'{{ route('invoice.delete') }}',
                method:'POST',
                data:{trans_id:transId},
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){

                        $('#invoiceDeleteConfirmModal').click();


                        $('#invoice_stock_tab').click();
                    }
                }
            })

        })


        $(document).on('click','#invoiceEditBtn',function(){
            const selectedField = $(this).attr('class').split(' ')[4];
            const selectedKey = selectedField.split('_')[3]




            $(`.invoice_stock_sp_email_input_${selectedKey}`).prop('disabled',false)
            $(`#invoice_stock_date_input_${selectedKey}`).prop('disabled',false)
            $(`.invoice_edit_key_${selectedKey}`).addClass('hidden')
            $(`.invoice_edit_confirm_key_${selectedKey}`).removeClass('hidden')

        })


        $(document).on('click','#invoiceEditConfirmBtn',function(){
            const selectedField = $(this).attr('class').split(' ')[4];
            const selectedKey = selectedField.split('_')[4]

            const selectedSupplier = $(`.invoice_stock_sp_email_input_${selectedKey}`).val();

            const selectedDate = $(`#invoice_stock_date_input_${selectedKey}`).val();
            const transId = $(this).data('trans_id');


            console.log({selectedSupplier,selectedDate,transId})



            $.ajax({
                url:'{{ route('edit.invoice.info') }}',
                method:'POST',
                data:{trans_id:transId,supplier_email:selectedSupplier,date:selectedDate},
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $('#invoice_stock_tab').click()
                        $(`.invoice_stock_sp_email_input_${selectedKey}`).prop('disabled',true)
                        $(`#invoice_stock_date_input_${selectedKey}`).prop('disabled',true)
                        $(`.invoice_edit_key_${selectedKey}`).removeClass('hidden')
                        $(`.invoice_edit_confirm_key_${selectedKey}`).addClass('hidden')
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })

        })





        $(document).on('click','#invoiceProductCheck',function(){
            const transId = $(this).data('trans_id');
            const productCode = $(this).data('product_code');
            const selectedkey = $(this).data('key');

            const selectedProductInfo = {trans_id:transId,product_code:productCode}

            const exists = selectedProducts.some(item => item.trans_id === transId && item.product_code === productCode);
            if(!exists){
                selectedProducts.push(selectedProductInfo);
            }
            else{
                selectedProducts = selectedProducts?.filter(product => product.trans_id === selectedProductInfo.trans_id && product.product_code !== selectedProductInfo.product_code);
            }


            if(selectedProducts?.length > 0){
                $('#hiddenDeleteDiv').removeClass('hidden')
            }
            else{
                $('#hiddenDeleteDiv').addClass('hidden')
            }

            console.log(selectedProducts)

        })

        $(document).on('click','#invoiceProductDeleteConfirmBtn',function(){

            $.ajax({
                url:'{{ route('delete.invoice.products') }}',
                method:'POST',
                contentType:'application/json',
                data:JSON.stringify({selectedProducts}),
                success:function(res){
                    console.log(res);
                    if(res.status === 'success'){
                        $('#lastClicked').text('')
                        $('#detailsDrawer').click();
                        $('#invoicePdsDltCnfmModal').click();
                        $('#invoice_stock_tab').click();

                    }
                },
                error:function(err){
                    console.log(err)
                }
            })


        })



        $(document).on('click','#invoiceProductEditBtn',function(){
            const selectedKey = $(this).data('key');
            console.log(selectedKey);

            $(`.invoice_product_name_select_${selectedKey}`).prop('disabled',false);
            $(`.invoice_product_buy_price_${selectedKey}`).prop('disabled',false);
            $(`.invoice_product_sell_price_${selectedKey}`).prop('disabled',false);
            $(`.invoice_product_edit_confirm_key_${selectedKey}`).removeClass('hidden')
            $(`.invoice_product_edit_key_${selectedKey}`).addClass('hidden')
        })


        $(document).on('click','#invoiceProductEditConfirmBtn',function(){
            const selectedKey = $(this).data('key');
            const transId = $(this).data('trans_id');
            const productCode = $(this).data('product_code');
            const selectedProductCode = $(`.invoice_product_name_select_${selectedKey}`).val();

            const buyPrice = $(`.invoice_product_buy_price_${selectedKey}`).val();
            const sellPrice = $(`.invoice_product_sell_price_${selectedKey}`).val();

            console.log({selectedKey,transId,selectedProductCode,buyPrice,sellPrice,productCode});



            $.ajax({
                url:'{{ route('invoice.product.edit') }}',
                method:'POST',
                data:{product_code:productCode,buy_price:buyPrice,sell_price:sellPrice,selected_product_code:selectedProductCode,trans_id:transId},
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $(`.invoice_product_name_select_${selectedKey}`).prop('disabled',true);
                        $(`.invoice_product_buy_price_${selectedKey}`).prop('disabled',true);
                        $(`.invoice_product_sell_price_${selectedKey}`).prop('disabled',true);
                        $(`.invoice_product_edit_confirm_key_${selectedKey}`).addClass('hidden')
                        $(`.invoice_product_edit_key_${selectedKey}`).removeClass('hidden')
                        $(`.invoice_product_profit_${selectedKey}`).text(sellPrice-buyPrice)
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })
        })

        $(document).on('change','#invoiceProductSelect',function(){

            const selectedKey = $(this).data('key');
            console.log(selectedKey)

            $.ajax({
                url:'{{ route('get.product') }}',
                method:'POST',
                data:{product_code:$(this).val()},
                success:function(res){

                    console.log(res)
                    const foundProductInfo = res[0]

                    $(`.invoice_product_img_${selectedKey}`).attr('src',`{{ asset('storage/uploads/${foundProductInfo?.product_img}') }}`)

                    $(`.invoice_product_buy_price_${selectedKey}`).val(foundProductInfo?.buy_price)

                    $(`.invoice_product_sell_price_${selectedKey}`).val(foundProductInfo?.sell_price)

                },
                error:function(err){
                    console.log(err)
                }
            })

        })


        $(document).on('click','#invoiceProductQuantityEditBtn',function(){
            const selectedKey = $(this).data('key');

            $(`.invoice_product_quantity_${selectedKey}`).prop('disabled',false);
            $(`.invoice_product_quantity_edit_confirm_btn_${selectedKey}`).removeClass('hidden')
            $(`.invoice_product_quantity_edit_btn_${selectedKey}`).addClass('hidden')

            console.log(selectedKey)
        })


        $(document).on('click','#invoiceProductQuantityEditConfirmBtn',function(){
            const selectedKey = $(this).data('key');

            const transId = $(this).data('trans_id');
            const productCode = $(this).data('product_code');
            const sizeId = $(this).data('size_id');
            const quantity = $(`.invoice_product_quantity_${selectedKey}`).val();

            console.log({transId,productCode,sizeId,quantity});

            $.ajax({
                url:'{{ route('invoice.product.quantity.edit') }}',
                method:'POST',
                data:{trans_id:transId,product_code:productCode,size_id:sizeId,quantity:quantity},
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $(`.invoice_product_quantity_${selectedKey}`).prop('disabled',true);
                        $(`.invoice_product_quantity_edit_confirm_btn_${selectedKey}`).addClass('hidden')
                        $(`.invoice_product_quantity_edit_btn_${selectedKey}`).removeClass('hidden')
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })

            console.log(selectedKey)
        })







    })
</script>
