<script>
    $(document).ready(function(){
        $(document).on('click','#scInvoiceDetailsBtn',function(){
            const productCode = $(this).data('product_code');

            $.ajax({
                url:'{{ route('index.invoice.details') }}',
                method:'POST',
                data:{product_code:productCode},
                success:function(res){
                    $('#detailsDrawerContent').html(res)
                },
                error:function(err){
                    console.log(err)
                }
            })
        })

        $(document).on('click','#invoiceDetailsQuantityBtn',function(){
            const transId = $(this).data('trans_id');
            const productCode = $(this).data('product_code');

            $.ajax({
                url:'{{ route('index.invoice,quantity') }}',
                method:'POST',
                data:{trans_id:transId,product_code:productCode},
                success:function(res){
                    $('#detailsModalContent').html(res);
                },
                error:function(err){
                    console.log(err);
                }
            })
        })


        $(document).on('click','#productStockQuantityBtn',function(){
            const productCode = $(this).data('product_code');

            $.ajax({
                url:'{{ route('index.product.stock.quantity') }}',
                method:'POST',
                data:{product_code:productCode},
                success:function(res){
                    $('#detailsDrawerContent').html(res);
                },
                error:function(err){
                    console.log(err);
                }
            })


        })
    })
</script>
