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
    })
</script>
