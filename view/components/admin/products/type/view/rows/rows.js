$(document).ready(function() {     
    safeCall('productTypeView',function(obj) {
        obj.initRows();
    },true);   
}); 