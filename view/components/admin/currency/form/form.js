'use strict';

$(document).ready(function() {
    $('.select-currency').dropdown({});

    arikaim.ui.form.addRules("#currency_form",{
        inline: false,
        fields: {
            title: {
                rules: [{ type:'minLength[2]' }]
            }           
        }
    });
});