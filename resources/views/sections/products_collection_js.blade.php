<script>
    $(document).ready(function(){

        let selectedProducts;
        const selectedProductsFromLS = JSON.parse(localStorage.getItem('selectedProducts'))
        if(selectedProductsFromLS){
            selectedProducts = selectedProductsFromLS
        }
        else{
            selectedProducts = []
        }
        $(document).on('change','#selectProduct',function(){
            const productCode = $(this).data('product_code');
            const productImg = $(this).data('product_img');
            const productName = $(this).data('product_name');
            const selectedProductInfo = {
                productCode,
                productImg,
                productName
            }

            const exists = selectedProducts.some(product => product.productCode === selectedProductInfo.productCode);

            if(exists){
                selectedProducts = selectedProducts?.filter(product =>  product.productCode !== selectedProductInfo.productCode)
                localStorage.setItem('selectedProducts',JSON.stringify(selectedProducts))
            }
            else{
                selectedProducts?.push(selectedProductInfo)
                localStorage.setItem('selectedProducts',JSON.stringify(selectedProducts))
            }
        })

        $(document).on('click','#confirmSelectedProducts',function(){
            localStorage.setItem('selectedProducts',JSON.stringify(selectedProducts))
            const selectedProductsFromLs = JSON.parse(localStorage.getItem('selectedProducts'))

            $.ajax({
                url:'{{ route('selected.products.info') }}',
                method:'POST',
                contentType:'application/json',
                data:JSON.stringify(selectedProductsFromLs),
                success:function(res){
                    $('#tab_items_container').html(res)
                    $('#supplier_collection').removeClass('tab-active')
                    $('#invoice_collection').removeClass('tab-active')
                    $('#products_collection').removeClass('tab-active')
                    $('#selected_products').addClass('tab-active')

                    const productsFromLs = JSON.parse(localStorage.getItem('selectedProducts'));
                    productsFromLs?.forEach(product => {
                        if(Object?.keys(product).length > 3){

                            $(`.${product?.productCode}`).removeClass('btn-info')
                            $(`.${product?.productCode}`).addClass('btn-success')
                        }
                    });

                }
            })

        })


    })
</script>
