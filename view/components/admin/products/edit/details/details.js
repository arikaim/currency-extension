$(document).ready(function() {
    arikaim.ui.form.onSubmit('#product_form',function() {
        return products.update('#product_form');
    },function(result) {
        arikaim.ui.form.showMessage(result.message);       
    },function(error) {

    });
});