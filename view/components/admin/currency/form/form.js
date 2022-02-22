'use strict';

arikaim.component.onLoaded(function() {
    arikaim.ui.form.addRules("#currency_form",{
        inline: false,
        fields: {
            title: {
                rules: [{ type:'minLength[2]' }]
            },
            code: {
                rules: [{ type:'minLength[2]' }]
            }           
        }
    });
});