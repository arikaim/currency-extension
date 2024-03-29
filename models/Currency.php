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

use Arikaim\Extensions\Currency\Models\CurrencyRates;

use Arikaim\Core\Db\Traits\Uuid;
use Arikaim\Core\Db\Traits\Find;
use Arikaim\Core\Db\Traits\Status;
use Arikaim\Core\Db\Traits\DefaultTrait;

/**
 * Currency model class
 */
class Currency extends Model  
{
    use Uuid,
        Status,
        DefaultTrait,
        Find;

    /**
     * Db table name
     *
     * @var string
    */
    protected $table = "currency";

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'icon',
        'status',
        'default',
        'sign',
        'crypto',
        'private',
        'title'
    ];
    
    /**
     * Disable timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Exchange rate relation
     *
     * @return Relation|null
     */
    public function rate()
    {
        return $this->hasOne(CurrencyRates::class,'currency_id');
    }

    /**
     * Get exchange rate
     *
     * @return float|null
     */
    public function getExchangeRate(): ?float
    {
        $rate = $this->rate()->first();
        
        return (empty($rate) == true) ? null : (float)$rate->value;
    }

    /**
     * Get crypto query
     *
     * @param Builder $query
     * @param bool|null $crypto
     * @return Builder
     */
    public function scopeCryptoQuery($query, ?bool $crypto = false)
    {
        return ($crypto == false) ? $query : $query->where('crypto','=',1);
    }

    /**
     * Get private (in site only) query
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePrivateQuery($query)
    {
        return $query->where('private','=',1);
    }

    /**
     * Find currency by uuid, id, code
     *
     * @param string|int $code
     * @return Model|null
     */
    public function findCurrency($code): ?object
    {
        $model = $this->findById($code);
       
        return ($model != null) ? $model : $this->findByColumn($code,'code');
    }

    /**
     * Get currency id
     *
     * @param string|int $code
     * @return integer|null
    */
    public function getCurrencyId($code): ?int
    {
        $model = $this->findCurrency($code);

        return ($model != null) ? $model->id : null;
    }
}
