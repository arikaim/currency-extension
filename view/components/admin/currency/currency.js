/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function CurrencyControlPanel() {

    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/currency/admin/delete/' + uuid,onSuccess,onError);      
    };

    this.add = function(formId, onSuccess, onError) {
        return arikaim.post('/api/currency/admin/add',formId,onSuccess,onError); 
    };

    this.update = function(formId, onSuccess, onError) {
        return arikaim.put('/api/currency/admin/update',formId,onSuccess,onError); 
    };

    this.setDefault = function(uuid, onSuccess, onError) {           
        var data = { 
            uuid: uuid            
        };

        return arikaim.put('/api/currency/admin/default',data,onSuccess,onError);      
    };

    this.setStatus = function(uuid, status, onSuccess, onError) {           
        var data = { 
            uuid: uuid, 
            status: status 
        };

        return arikaim.put('/api/currency/admin/status',data,onSuccess,onError);      
    };

    this.init = function() {
        arikaim.ui.tab('.currency-tab-item','currency_content');
    }
}

var currency = new CurrencyControlPanel();

arikaim.component.onLoaded(function() {
    currency.init();
});
