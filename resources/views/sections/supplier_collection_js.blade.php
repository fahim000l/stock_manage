<script>
    $(document).ready(function(){
        $(document).on('click','#addSupplierBtn',function(){
            $('#addSupplierRow').toggle()
            $('#plusIcon').toggle()
            $('#minusIcon').toggle()
        })

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

        $(document).on('click','#supplierSelectBtn',function(){
            const supplier_email = $(this).data('supplier_email');
            const date = `${new Date().getDate()}/${new Date().getMonth()+1}/${new Date().getFullYear()}`;
            const trans_id = $('#transId').val()

            const invoiceInfo = {
                supplier_email,
                trans_id,
                date
            }

            $('#supplier_email_modal').val(supplier_email)
            $('#date_modal').val(date)
            $('#trans_id').val(trans_id)
            console.log(invoiceInfo)
        })


        $(document).on('submit','#selectedSupplierForm',function(event){
            event.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url:'{{ route('add.invoice') }}',
                data:formData,
                method:'POST',
                contentType:false,
                processData:false,
                success:function(res){
                    console.log(res)
                    if(res.status === 'success'){
                        $('#selectedSupplierForm')[0].reset()
                        $('#selectSupplierModal').click()
                    }
                },
                error:function(){

                }
            })
        })

    })
</script>
