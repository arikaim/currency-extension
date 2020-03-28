$(document).ready(function() {
    arikaim.ui.button('.add-options',function(element) {
        var uuid = $(element).attr('uuid');
        return products.createOptions(uuid);
    },function(result) {
        arikaim.page.loadContent({
            id: 'product_edit_content',
            component: 'products::admin.products.edit.options',
            params: { uuid: result.uuid }
        }); 
    });
});