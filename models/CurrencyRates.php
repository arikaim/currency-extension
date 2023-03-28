<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Currency\Models;

use Illuminate\Database\Eloquent\Model;

use Arikaim\Core\Db\Traits\Uuid;
use Arikaim\Core\Db\Traits\Find;
use Arikaim\Core\Db\Traits\DateCreated;
use Arikaim\Core\Db\Traits\DateUpdated;

/**
 * Crypto currency rates db model class
 */
class CurrencyRates extends Model
{
    use Uuid,     
        Find, 
        DateCreated,  
        DateUpdated;
    
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'currency_rates';

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'currency_id',      
        'value',
        'date_created',
        'date_updated'         
    ];
    
    /**
     * Disable timestamps
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * Save exchange rate
     *
     * @param integer $currencyId
     * @param float $value
     * @return object|null
     */
    public function saveExchangeRate(int $currencyId, float $value): ?object
    {
        $model = $this->findById($currencyId);
        $data = [
            'currency_id' => $currencyId,
            'value'       => $value
        ];

        if ($model == null) {
            return $this->create($data);
        }

        $result = $model->update($data);

        return ($result !== false) ? $data : null;
    }   
}
