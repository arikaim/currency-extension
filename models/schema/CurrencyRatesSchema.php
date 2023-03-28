<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Currency\Models\Schema;

use Arikaim\Core\Db\Schema;

/**
 * Currency rates db table
 */
class CurrencyRatesSchema extends Schema  
{    
    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = "currency_rates";

    /**
     * Create table
     *
     * @param \Arikaim\Core\Db\TableBlueprint $table
     * @return void
     */
    public function create($table) 
    {
        // fields
        $table->id();
        $table->prototype('uuid');
        $table->relation('currency_id','currency');
        $table->price(1.00,'value');
        $table->dateCreated();
        $table->dateUpdated();
        // index       
    }

    /**
     * Update table
     *
     * @param \Arikaim\Core\Db\TableBlueprint $table
     * @return void
     */
    public function update($table) 
    {                
    }
}
