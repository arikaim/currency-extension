$(document).ready(function() {    
    $('.option-field').popup();

    arikaim.ui.form.onSubmit('#price_form',function() {
        return products.updatePrice('#price_form');
    },function(result) {
        arikaim.ui.form.showMessage(result.message);
    });

    arikaim.ui.button('.add-price-list',function(element) {
        var uuid = $(element).attr('uuid');
        return products.createPriceList(uuid);
    },function(result) {
        arikaim.page.loadContent({
            id: 'product_edit_content',
            component: 'products::admin.products.edit.price',
            params: { uuid: result.uuid }
        }); 
    });
});