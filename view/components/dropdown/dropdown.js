'use strict';

$(document).ready(function() {  
    $('.currency-dropdown').dropdown({
        apiSettings: {     
            on: 'now',      
            url: arikaim.getBaseUrl() + '/api/currency/list/{query}',   
            cache: false        
        },       
        filterRemoteData: false         
    });
});