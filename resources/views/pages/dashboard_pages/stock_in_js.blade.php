<script>
    $(document).ready(function(){
        $(document).on('click','#supplier_collection',function(){

            $.ajax({
                url: "{{ route('supplier.collection') }}",
                method:'GET',
                success:function(res){
                    $('#tab_items_container').html(res)
                    $('#supplier_collection').addClass('tab-active')
                    $('#invoice').removeClass('tab-active')
                }
            })
        })

        $(document).on('click','#invoice',function(){
            $.ajax({
                url:'{{ route('index.invoice') }}',
                method:'GET',
                success:function(res){
                    $('#tab_items_container').html(res)
                    $('#supplier_collection').removeClass('tab-active')
                    $('#invoice').addClass('tab-active')
                }
            })
        })



    })
</script>
