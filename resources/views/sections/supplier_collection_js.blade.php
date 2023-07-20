<script>
    $(document).ready(function(){


        $(document).on('submit','#addSupplierForm',function(event){
            event.preventDefault()

            const formData = new FormData(this)

            $.ajax({
                url:"{{ route('add.supplier') }}",
                method:'POST',
                processData: false,
                contentType: false,
                data:formData,
                success:function(res){
                    console.log(res)

                    if(res.status === 'success'){
                        $('#addSupplierForm')[0].reset()
                        $('#supplierTable').load(location.href+' #supplierTable')
                        $('#addSupplierModal').click()
                        Command: toastr["success"](`Supplier added Successfully`, "Supplier Added")

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

                    if(error?.errors?.supplier_email){
                        $('#supplier_email').addClass('border-2 border-red-600 border-solid')
                        $('#supplier_email_td').append(`<p class="text-red-600 font-bold">${error?.errors?.supplier_email}</p>`)
                    }
                    if(error?.errors?.supplier_phone){
                        $('#supplier_phone').addClass('border-2 border-red-600 border-solid')
                        $('#supplier_phone_td').append(`<p class="text-red-600 font-bold">${error?.errors?.supplier_phone}</p>`)
                    }
                }

            })
        })




    })
</script>
