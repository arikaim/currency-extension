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
        $this->addApiRoute('POST','/api/currency/admin/add','CurrencyControlPanel','add','session');   
        $this->addApiRoute('PUT','/api/currency/admin/update','CurrencyControlPanel','update','session');   
        $this->addApiRoute('PUT','/api/currency/admin/status','CurrencyControlPanel','setStatus','session');   
        $this->addApiRoute('DELETE','/api/currency/admin/delete/{uuid}','CurrencyControlPanel','delete','session');  
        $this->addApiRoute('PUT','/api/currency/admin/default','CurrencyControlPanel','setDefault','session');   
        // Api      
        $this->addApiRoute('GET','/api/currency/list/[{query}]','CurrencyApi','getDropdownList');   
        // Create db tables        
        $this->createDbTable('CurrencySchema');
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
