/**
 *  Arikaim
 *  @copyright  Copyright (c)  <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function CurrencyControlPanel() {

    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/admin/currency/delete/' + uuid,onSuccess,onError);      
    };

    this.add = function(formId, onSuccess, onError) {
        return arikaim.post('/api/admin/currency/add',formId,onSuccess,onError); 
    };

    this.update = function(formId, onSuccess, onError) {
        return arikaim.put('/api/admin/currency/update',formId,onSuccess,onError); 
    };

    this.updateExchangeRate = function(formId, onSuccess, onError) {
        return arikaim.put('/api/admin/currency/rate',formId,onSuccess,onError); 
    };

    this.setDefault = function(uuid, onSuccess, onError) {           
        return arikaim.put('/api/admin/currency/default',{ 
            uuid: uuid            
        },onSuccess,onError);      
    };

    this.setStatus = function(uuid, status, onSuccess, onError) {           
        return arikaim.put('/api/admin/currency/status',{ 
            uuid: uuid, 
            status: status 
        },onSuccess,onError);      
    };
}

var currency = new CurrencyControlPanel();
