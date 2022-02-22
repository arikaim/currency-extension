'use strict';

arikaim.component.onLoaded(function() {
    safeCall('currencyView',function(obj) {
        obj.initRows();
    },true);    
});