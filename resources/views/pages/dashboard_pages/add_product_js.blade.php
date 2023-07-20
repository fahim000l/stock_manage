<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js
"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){

        $('#uploadIcon').show()
        $('#img_preview').hide()

        $(document).on('click','#imgUploadingBtn',function(){
            $('#product_image').trigger('click')
        })

        $(document).on('change','#product_image',function(){
            const productImg = $('#product_image')[0].files[0]

            const reader = new FileReader();

            reader.onload = function(e){
                $('#img_preview').attr('src',e.target.result)
                $('#uploadIcon').hide()
                $('#img_preview').show()
            }

            reader.readAsDataURL(productImg);
            const formData = new FormData()
            formData.append('image',productImg)

        })

        $(document).on('click', '#add_product_btn',function(event){
            event.preventDefault()
            const form = $('#add_product_form')[0];
            const formData = new FormData(form)

            $.ajax({
                url:"{{ route('add.product') }}",
                method:'POST',
                data:formData,
                processData: false,
                contentType: false,
                success :function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $('#add_product_form')[0].reset();
                        Command: toastr["success"](`${res.product_name} added Successfully`, "Product Added")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                },
                error:function(err){

                    const error = err.responseJSON;
                    console.log(error.errors)

                    if(error.errors.buy_price){
                        $('#buy_price').addClass('border-red-600 border-solid border-2')
                        $('#buy_price_form_control').append(`<p class='text-error font-bold'>${error.errors.buy_price}</p>`)
                    }
                    if(error.errors.product_name){
                        $('#product_name').addClass('border-red-600 border-solid border-2')
                        $('#product_name_form_control').append(`<p class='text-error font-bold'>${error.errors.product_name}</p>`)
                    }
                    if(error.errors.sell_price){
                        $('#sell_price').addClass('border-red-600 border-solid border-2')
                        $('#sell_price_form_control').append(`<p class='text-error font-bold'>${error.errors.sell_price}</p>`)
                    }
                    if(error.errors.product_image){
                        $('#imgUploadingBtn').addClass('border-red-600 border-solid border-5')
                        $('#imgUploadingBtn').append(`<p class='text-red-600 font-bold'>${error.errors.product_image}</p>`)
                    }

                }
            })
        })



    })
</script>
