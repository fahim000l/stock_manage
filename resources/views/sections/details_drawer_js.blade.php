<script>
    $(document).ready(function(){
        $(document).on('click','#sizeListBtn',function(){


            $.ajax({
                url:'{{ route('index.all.size') }}',
                method:'GET',
                success:function(res){
                    $('#manageSizeTableContainer').html(res)
                }
            })


        })


        $(document).on('click','#activeBtn',function(){
            const sizeId = $(this).data('size_id')

            $.ajax({
                url:'{{ route('set.status.active') }}',
                method:'POST',
                data:{size_id:sizeId},
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $('#sizeListBtn').click()
                    }
                },
                error:function(err){
                    console.log(err)

                }
            })

        })

        $(document).on('click','#deActiveBtn',function(){
            const sizeId = $(this).data('size_id')

            $.ajax({
                url:'{{ route('set.status.deactive') }}',
                method:'POST',
                data:{size_id:sizeId},
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $('#sizeListBtn').click()
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })

        })


    })
</script>

