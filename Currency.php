<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Currency;

use Arikaim\Core\Extension\Extension;

/**
 * Currency extension class
 */
class Currency extends Extension
{
    /**
     * Install extension
     *
     * @return void
     */
    public function install()
    {
        // Control Panel Routes               
        $this->addApiRoute('POST','/api/admin/currency/add','CurrencyControlPanel','add','session');   
        $this->addApiRoute('PUT','/api/admin/currency/update','CurrencyControlPanel','update','session');   
        $this->addApiRoute('PUT','/api/admin/currency/status','CurrencyControlPanel','setStatus','session');   
        $this->addApiRoute('DELETE','/api/admin/currency/delete/{uuid}','CurrencyControlPanel','delete','session');  
        $this->addApiRoute('PUT','/api/admin/currency/default','CurrencyControlPanel','setDefault','session');   
        $this->addApiRoute('PUT','/api/admin/currency/rate','CurrencyControlPanel','setExchangeRate','session');   
        // Api      
        $this->addApiRoute('GET','/api/currency/list/[{query}]','CurrencyApi','getDropdownList');   
        // Create db tables        
        $this->createDbTable('CurrencySchema');
        $this->createDbTable('CurrencyRatesSchema');
        // Services
        $this->registerService('Currency');
    }   

    /**
     * UnInstall extension
     *
     * @return void
     */
    public function unInstall()
    {  
    }
}
