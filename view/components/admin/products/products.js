/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function ProductsControlPanel() {
    var self = this;
    
    this.createPriceList = function(uuid, onSuccess, onError) {
        var data = {
            uuid: uuid
        };

        return arikaim.put('/api/products/admin/product/price/create',data,onSuccess,onError);          
    };

    this.createOptions = function(uuid, onSuccess, onError) {
        var data = {
            uuid: uuid
        };

        return arikaim.put('/api/products/admin/product/create/options',data,onSuccess,onError);          
    };

    this.add = function(formId, onSuccess, onError) {
        return arikaim.post('/api/products/admin/product/add',formId,onSuccess,onError);          
    };

    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/products/admin/product/delete' + uuid,onSuccess,onError);          
    };

    this.update = function(formId, onSuccess, onError) {
        return arikaim.put('/api/products/admin/product/update',formId, onSuccess, onError);          
    };

    this.updatePrice = function(formId, onSuccess, onError) {
        return arikaim.put('/api/products/admin/product/price/update',formId, onSuccess, onError);          
    };

    this.setStatus = function(uuid, status, onSuccess, onError) {
        var data = {
            uuid: uuid,
            status: status
        };

        return arikaim.put('/api/products/admin/product/status',data,onSuccess,onError);          
    };

    this.init = function() {       
        arikaim.ui.tab('.product-tab-item','products_content');
    };
}

var products = new ProductsControlPanel();

arikaim.page.onReady(function() {
    products.init();
});