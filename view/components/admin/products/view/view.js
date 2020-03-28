/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */

function ProductsView() {
    var self = this;

    this.init = function() {
        paginator.init('product_rows');   

        search.init({
            id: 'product_rows',
            component: 'products::admin.products.view.rows',
            event: 'product.search.load'
        },'products')  
        
        arikaim.events.on('product.search.load',function(result) {      
            paginator.reload();
            self.initRows();    
        },'productSearch');
    };

    this.initRows = function() {
        var component = arikaim.component.get('products::admin');
        var removeMessage = component.getProperty('messages.remove.content');

        $('.status-dropdown').dropdown({
            onChange: function(value) {               
                var uuid = $(this).attr('uuid');
                products.setStatus(uuid,value);
            }
        });    

        arikaim.ui.button('.delete-button',function(element) {
            var uuid = $(element).attr('uuid');
            var title = $(element).attr('data-title');

            var message = arikaim.ui.template.render(removeMessage,{ title: title });
            modal.confirmDelete({ 
                title: component.getProperty('messages.remove.title'),
                description: message
            },function() {
                products.delete(uuid,function(result) {
                    arikaim.ui.table.removeRow('#' + uuid);     
                });
            });
        });

        arikaim.ui.button('.edit-button',function(element) {
            var uuid = $(element).attr('uuid');    
            arikaim.ui.setActiveTab('#edit_product','.product-tab-item');
            arikaim.page.loadContent({
                id: 'products_content',
                component: 'products::admin.products.edit',
                params: { uuid: uuid }
            });          
        });
    };
};

var productsView = new ProductsView();

$(document).ready(function() {  
    productsView.init();
    productsView.initRows();  
}); 