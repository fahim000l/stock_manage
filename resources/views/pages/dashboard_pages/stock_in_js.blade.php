<script>
    $(document).ready(function(){
        $(document).on('click','#supplier_collection',function(){

            $.ajax({
                url: "{{ route('supplier.collection') }}",
                method:'GET',
                success:function(res){
                    $('#tab_items_container').html(res)
                    $('#supplier_collection').addClass('tab-active')
                    $('#invoice_collection').removeClass('tab-active')
                    $('#products_collection').removeClass('tab-active')
                    $('#selected_products').removeClass('tab-active')
                }
            })
        })

        $(document).on('click','#invoice_collection',function(){


            $.ajax({
                url:"{{ route('invoice.collection') }}",
                method:'GET',
                success:function(res){
                    $('#tab_items_container').html(res)
                    $('#supplier_collection').removeClass('tab-active')
                    $('#invoice_collection').addClass('tab-active')
                    $('#products_collection').removeClass('tab-active')
                    $('#selected_products').removeClass('tab-active')
                }
            })
        })

        $(document).on('click','#products_collection',function(){


            const invoiceInfo = JSON.parse(localStorage.getItem('invoice_info'))

            const selectedProducts = JSON.parse(localStorage.getItem('selectedProducts'));

            if(invoiceInfo){
                $.ajax({
                    url:'{{ route('invoice.info') }}',
                    method:'POST',
                    data:invoiceInfo,
                    success:function(res){
                        $('#tab_items_container').html(res);

                        $('#invoiceDetails').removeClass('hidden');
                        $('#invoiceDetails').addClass('flex');
                        $('#selectProductTh').removeClass('hidden')
                        $('.selectProductTd').removeClass('hidden')

                        $('#supplier_collection').removeClass('tab-active')
                        $('#invoice_collection').removeClass('tab-active')
                        $('#products_collection').addClass('tab-active')
                        $('#selected_products').removeClass('tab-active')

                        selectedProducts.forEach(product => {
                            $(`.productID_${product.productCode} label input`).prop('checked', true);
                        });

                    },
                })
            }
            else{
                $.ajax({
                    url:'{{ route('products.collection') }}',
                    method:'GET',
                    success:function(res){
                        $('#tab_items_container').html(res)
                        $('#supplier_collection').removeClass('tab-active')
                        $('#invoice_collection').removeClass('tab-active')
                        $('#products_collection').addClass('tab-active')
                        $('#selected_products').removeClass('tab-active')
                    }
                })
            }



        })

        $(document).on('click','#selected_products',function(){

            const selectedProducts = JSON.parse(localStorage.getItem('selectedProducts'))

            $.ajax({
                url: '{{ route('selected.products.info') }}',
                method:'POST',
                contentType:'application/json',
                data: JSON.stringify(selectedProducts),
                success:function(res){
                    $('#tab_items_container').html(res)
                    $('#supplier_collection').removeClass('tab-active')
                    $('#invoice_collection').removeClass('tab-active')
                    $('#products_collection').removeClass('tab-active')
                    $('#selected_products').addClass('tab-active')

                    const productsFromLs = JSON.parse(localStorage.getItem('selectedProducts'));
                    productsFromLs?.forEach(product => {
                        if(Object?.keys(product).length > 3){

                            $(`.${product?.productCode}`).removeClass('btn-info')
                            $(`.${product?.productCode}`).addClass('btn-success')
                        }
                    });

                }

            })
        })

    })
</script>
