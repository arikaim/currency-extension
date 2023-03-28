'use strict';

arikaim.component.onLoaded(function() { 
    arikaim.ui.form.addRules("#currency_rate_form",{});

    arikaim.ui.form.onSubmit("#currency_rate_form",function() {  
        return currency.updateExchangeRate('#currency_rate_form');
    },function(result) {       
        arikaim.ui.form.showMessage(result.message);
    });
});