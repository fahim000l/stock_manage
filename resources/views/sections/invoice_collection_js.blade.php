<script>
    $(document).ready(function(){
        $(document).on('click','#addProductInvoiceBtn',function(){
            const supplierEmail = $(this).data('supplier_email');
            const transId = $(this).data('trans_id');
            const date = $(this).data('date');


            const invoiceInfo = {
                supplierEmail,
                transId,
                date
            }

            localStorage.setItem('invoice_info',JSON.stringify(invoiceInfo));



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
                },
            })

        })

        $(document).on('click','#showProductsInvoiceBtn',function(){
            const transId = $(this).data('trans_id');
            console.log(transId);

            $.ajax({
                url:'{{ route('show.invoice.products') }}',
                method:'POST',
                data:{trans_id:transId},
                success:function(res){
                    $('#detailDrawerContent').html(res);
                }
            })
        })

        $(document).on('click','#showInvoiceQuantityBtn',function(){
            const productCode = $(this).data('product_code');
            const transId = $(this).data('trans_id');

            console.log({productCode,transId});

            if(productCode && transId){
                $.ajax({
                    url:'{{ route('show.invoice.quantity') }}',
                    method:'POST',
                    data:{trans_id:transId,product_code:productCode},
                    success:function(res){
                        console.log(res)
                        $('#QuantityModalContainer').html(res)
                        // $("#invoiceQuantityModalModal").removeClass('hidden');
                    }
                })
            }


        })


    })
</script>
