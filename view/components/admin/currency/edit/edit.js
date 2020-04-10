'use strict';

$(document).ready(function() {  
    arikaim.ui.form.onSubmit("#currency_form",function() {  
        return currency.update('#currency_form');
    },function(result) {       
        arikaim.ui.form.showMessage(result.message);
    });
});