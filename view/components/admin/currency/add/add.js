'use strict';

arikaim.component.onLoaded(function() { 
    arikaim.ui.form.onSubmit("#currency_form",function() {  
        return currency.add('#currency_form');
    },function(result) {
        arikaim.ui.form.clear('#currency_form');
        arikaim.ui.form.showMessage(result.message);
    });
});