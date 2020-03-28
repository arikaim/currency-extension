$(document).ready(function() {
    arikaim.ui.form.onSubmit('#product_form',function() {
        return products.add('#product_form');
    },function(result) {
        arikaim.ui.form.showMessage(result.message);
        arikaim.page.loadContent({
            id: 'products_content',
            component: 'products::admin.products.edit',
            params: { uuid: result.uuid }
        });         
    },function(error) {

    });
});