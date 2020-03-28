/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */

function ProductTypeControlPanel() {
    var self = this;
    
    this.init = function() {       
        arikaim.ui.tab('.product-type-tab-item','product_type_content');
    };

    this.edit = function() {

    };
}

var productType = new ProductTypeControlPanel();

arikaim.page.onReady(function() {
    productType.init();
});