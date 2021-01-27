/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function CurrencyView() {
    var self = this;
    this.messages = null;
    
    this.initRows = function() {
        var component = arikaim.component.get('currency::admin');
        var removeMessage = component.getProperty('messages.remove.content');

        arikaim.ui.button('.edit-currency',function(element) {
            var uuid = $(element).attr('uuid');

            arikaim.page.loadContent({
                id: 'currency_content',
                component: 'currency::admin.currency.edit',
                params: { uuid: uuid }
            }); 
        });
        
        arikaim.ui.button('.default-currency',function(element) {
            var uuid = $(element).attr('uuid');
            currency.setDefault(uuid,function(result) {
                arikaim.page.loadContent({
                    id: 'items_list',           
                    component: 'currency::admin.currency.view.rows'
                }); 
            });            
        });

        $('.status-dropdown').dropdown({
            onChange: function(value) {
                var uuid = $(this).attr('uuid');
                currency.setStatus(uuid,value);               
            }
        });

        arikaim.ui.button('.delete-currency',function(element) {
            var uuid = $(element).attr('uuid');
            var title = $(element).attr('data-title');

            var message = arikaim.ui.template.render(removeMessage,{ title: title });
            modal.confirmDelete({ 
                title: component.getProperty('messages.remove.title'),
                description: message
            },function() {
                currency.delete(uuid,function(result) {
                    $('#' + uuid).remove();                
                });
            });
        });
    };

    this.init = function() {
        paginator.init('items_list',{
            name: 'currency::admin.currency.view.rows',
            params: {
                namespace: 'currency'
            }
        }); 
    };
}

var currencyView = new CurrencyView();

$(document).ready(function() {
    currencyView.init();
    currencyView.initRows();
});