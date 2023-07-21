<script>
    $(document).ready(function(){
        $(document).on('click','#product_stock_tab',function(){
            $.ajax({
                url:'{{ route('index.product.stock') }}',
                method:'GET',
                success:function(res){
                    $('#stock_tab_items_container').html(res);
                    $('#product_stock_tab').addClass('tab-active');
                    $('#invoice_stock_tab').removeClass('tab-active');
                }
            })
        })

        $(document).on('click','#invoice_stock_tab',function(){
            $.ajax({
                url:'{{ route('index.invoice.stock') }}',
                method:'GET',
                success:function(res){
                    $('#stock_tab_items_container').html(res);
                    $('#product_stock_tab').removeClass('tab-active');
                    $('#invoice_stock_tab').addClass('tab-active');
                }
            })
        })



    })
</script>
