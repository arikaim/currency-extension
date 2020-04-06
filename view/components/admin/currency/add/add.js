'use strict';

$(document).ready(function() {  
    arikaim.ui.form.onSubmit("#currency_form",function() {  
        return arikaim.post('/api/currency/admin/add','#currency_form');
    },function(result) {
        arikaim.ui.form.clear('#currency_form');
        arikaim.ui.form.showMessage(result.message);
    });
});