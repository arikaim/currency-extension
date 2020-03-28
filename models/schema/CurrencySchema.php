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
use Arikaim\Core\Utils\Uuid;

/**
 * Currency db table
 */
class CurrencySchema extends Schema  
{    
    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = "currency";

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
        $table->prototype('defaultColumn');  
        $table->string('code',10)->nullable(false);
        $table->string('icon')->nullable(true);
        $table->string('sign',10)->nullable(true);
        $table->string('title')->nullable(true);
        $table->string('country_code',5)->nullable(true);
        $table->status();
        // index
        $table->unique(['code']);
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

    /**
     * Insert or update rows in table
     *
     * @param Seed $seed
     * @return void
     */
    public function seeds($seed)
    {     
        $seed->create(['code' => 'USD'],
            [
                'uuid'    => Uuid::create(),
                'code'    => 'USD',
                'title'   => 'US Dollar',
                'icon'    => 'dollar sign',
                'sign'    => '$',
                'default' => 1,             
                'status'  => 1
            ]
        ); 
      
        $seed->create(['code' => 'GBP'],
            [
                'uuid'    => Uuid::create(),
                'code'    => 'GBP',
                'title'   => 'British Pound',
                'icon'    => 'pound sign',
                'sign'    => '£',
                'default' => null,  
                'status'  => 1
            ]
        );              
    }
}
