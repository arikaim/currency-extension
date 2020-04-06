/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function CurrencyControlPanel() {

    this.delete = function() {

    };

    this.add = function() {

    };

    this.update = function() {

    };

    this.init = function() {
        arikaim.ui.tab('.currency-tab-item','currency_content');
    }
}

var currency = new CurrencyControlPanel();

$(document).ready(function() {  
    currency.init();
});
