<script>
    $(document).ready(function(){



        $(document).on('click','#manageSizeBtn',function(){

            const productName = $(this).data('product_name')
            const productCode = $(this).data('product_code')

            $.ajax({
                url:'{{ route('manage.size') }}',
                method:'GET',
                success:function(res){
                    $('#detailDrawerContent').html(res)
                    $('#msProductName').text(productName);
                    $('#hiddenProductCode').val(productCode)
                }
            })
        })



        $(document).on('submit','#addSizeForm',function(event){
            event.preventDefault()

            const formData = new FormData(this);

            $.ajax({
                url:'{{ route('add.size') }}',
                method:'POST',
                data:formData,
                processData: false,
                contentType: false,
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $('#addSizeForm')[0].reset();
                        $('#manageSizeTable').load(location.href+' #manageSizeTable');
                        $('#addSizeModal').click();
                    }
                },
                error:function(err){
                    const error = err.responseJSON;
                    const errorMessages = error.errors
                    console.log(errorMessages)
                    if(errorMessages?.size_id){

                        $('#size_id').addClass('border-2 border-red-600');
                        $('#sizeIdFormControl').append(`<p class="text-red-600 font-bold">${errorMessages?.size_id}</p>`)
                    }

                    if(errorMessages?.size_name){
                        $('#size_name').addClass('border-2 border-red-600');
                        $('#sizeNameFormControl').append(`<p class="text-red-600 font-bold">${errorMessages?.size_name}</p>`)
                    }

                    if(errorMessages?.status){
                        $('#status').addClass('border-2 border-red-600');
                        $('#statusFormControl').append(`<p class="text-red-600 font-bold">${errorMessages?.status}</p>`)
                    }
                }

            })

        })

        $(document).on('submit','#manageQuantityForm',function(event){
            event.preventDefault()
            const products = JSON.parse(localStorage.getItem('selectedProducts'));

            const managingProductCode = $('#hiddenProductCode').val();

            const managingProduct = products?.find(product => product?.productCode === managingProductCode)

            const otherProducts = products?.filter(product => product?.productCode !== managingProductCode)

            console.log($('#manageQuantityForm tbody')[0].children)

            Array.from($('#manageQuantityForm tbody')[0].children).map(chield => {
                // console.log(chield.children[1].children[0].value)
                managingProduct[`${chield.children[1].children[0].id}`] = parseInt(chield.children[1].children[0].value) || 0
            });

            otherProducts?.push(managingProduct)

            localStorage.setItem('selectedProducts',JSON.stringify(otherProducts))
            $('#manageQuantityForm')[0].reset();
            $('#detailsDrawer').click()
            // $('#selectedProductsTable').load(location.href+' #selectedProductsTable')
            $('#selected_products').click()

        })

        $(document).on('click','#stockInBtn',function(){
            const products = JSON.parse(localStorage.getItem('selectedProducts'));
            const invoice_info = JSON.parse(localStorage.getItem('invoice_info'));
            let signal = true
            let productsInfo = []
            let quantityInfo = []
            products.forEach(product => {
                if(Object.keys(product).length < 7){
                    $(`.${product.productCode}`).removeClass('btn-info')
                    $(`.${product.productCode}`).addClass('btn-error btn-outline')
                    $(`#${product.productCode}_td`).append(`<p class="text-red-600 font-bold">Size and quantity not specified</p>`)
                    signal = false
                }
                else{
                    productsInfo.push({product_code:product.productCode,trans_id:invoice_info.transId})
                    Object.keys(product).forEach(key => {
                        if(key !== 'productCode' && key !== 'productImg' && key !== 'productName'){
                            quantityInfo.push({trans_id:invoice_info.transId,product_code:product.productCode,size_id:key,quantity:product[`${key}`]})
                        }
                    })
                }

            });

            if(signal === false){
                return
            }
            else{


                const stockInfo = {
                    products_info:productsInfo,
                    quantity_info:quantityInfo,
                    invoice_info
                }

                $.ajax({
                    url: '{{ route('add.stock') }}',
                    method:'POST',
                    contentType:'application/json',
                    data:JSON.stringify(stockInfo),
                    success:function(res){
                        console.log(res);
                        if(res?.status === 'success'){
                            localStorage.removeItem('selectedProducts')
                            localStorage.removeItem('invoice_info')
                            $('#supplier_collection').click()
                        }
                    }
                })


            }

        })


    })
</script>
