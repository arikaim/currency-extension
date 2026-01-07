/**
 *  Arikaim
 *  @copyright  Copyright (c)  <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function CurrencyView() {
    var self = this;
    
    this.initRows = function() {
        arikaim.ui.loadComponentButton('.currency-action');

        arikaim.ui.button('.edit-currency',function(element) {
            var uuid = $(element).attr('uuid');

            arikaim.page.loadContent({
                id: 'details_content',
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

        $('.status-dropdown').on('change', function() {
            var val = $(this).val();
            var uuid = $(this).attr('uuid');
            
            currency.setStatus(uuid,val);               
        });

        arikaim.ui.button('.delete-currency',function(element) {
            var uuid = $(element).attr('uuid');
            var title = $(element).attr('data-title');
            var message = arikaim.ui.template.render(self.getMessage('remove.content'),{ title: title });
            
            arikaim.ui.getComponent('confirm_delete').open(function() {
                currency.delete(uuid,function(result) {
                    $('#row_' + uuid).remove();                
                });
            },message);
        });
    };

    this.init = function() {
        this.loadMessages('currency::admin');
        arikaim.ui.loadComponentButton('.create-currency');

        arikaim.events.on('add.currency',function(uuid) {
            arikaim.page.loadContent({
                id: 'items_list',
                append: true,
                component: 'currency::admin.currency.view.row',
                params: { uuid: uuid }
            },function() {
                self.initRows();
            }); 
        },'addCurrencyHandler');

        arikaim.events.on('update.currency',function(uuid) {
            arikaim.page.loadContent({
                id: 'row_' + uuid,
                replace: true,
                component: 'currency::admin.currency.view.row',
                params: { uuid: uuid }
            },function() {
                self.initRows();
            }); 
        },'updateCurrencyHandler');

        this.initRows();
    };
}

var currencyView = new createObject(CurrencyView,ControlPanelView);

arikaim.component.onLoaded(function() {
    currencyView.init(); 
});