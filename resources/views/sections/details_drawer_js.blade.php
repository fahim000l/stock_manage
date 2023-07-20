<script>
    $(document).ready(function(){
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


        $(document).on('click','#sizeListBtn',function(){


            $.ajax({
                url:'{{ route('index.all.size') }}',
                method:'GET',
                success:function(res){
                    $('#detailsModalContent').html(res)
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
