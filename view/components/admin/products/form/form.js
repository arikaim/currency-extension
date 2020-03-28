$(document).ready(function() {
    $('.product-type').dropdown({});

    arikaim.ui.form.addRules("#product_form",{
        inline: false,
        fields: {
            title: {
                rules: [{ type:'minLength[2]' }]
            },
            type: { 
                identifier: "product_type",      
                rules: [{ type:'empty' }]
            }    
        }
    });
});