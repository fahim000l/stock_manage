<script>
    $(document).ready(function(){
        $(document).on('click','#stockInvoiceDetailsBtn',function(){
            const transId = $(this).data('trans_id')
            console.log(transId)

            $.ajax({
                url:'{{ route('index.invoice.info') }}',
                method:'POST',
                data:{trans_id:transId},
                success:function(res){
                    $('#detailDrawerContent').html(res)
                }
            })


        })

        $(document).on('click','#stockQuantityBtn',function(){
            const transId = $(this).data('trans_id');
            const productCode = $(this).data('product_code');

            console.log({transId,productCode});

            $.ajax({
                url:'{{ route('index.stock.quantity') }}',
                method:'POST',
                data:{trans_id:transId,product_code:productCode},
                success:function(res){
                    $('#detailDrawerContent').html(res)
                }
            })


        })


    })
</script>
