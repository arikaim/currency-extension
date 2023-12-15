<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Currency\Models\Traits;

use Arikaim\Extensions\Currency\Models\Currency;

/**
 * Currency relation trait
*/
trait CurrencyRelation 
{    
    /**
     * Currency relation
     *
     * @return Relation|Model
     */
    public function currency() 
    {
        return $this->belongsTo(Currency::class,'currency_id')->withDefault(function ($currency) {
            return $currency->getDefault();
        });
    }    

    /**
     * Find currency
     *
     * @param string|int|null $code
     * @return object|null
     */
    public function findCurrency($code): ?object
    {
        return (empty($code) == true) ? $this->currency : $this->currency->findCurrency($code);
    }

    /**
     * Get currency id attribute name
     *
     * @return string
     */
    public function getCurrencyIdAttributeName()
    {
        return (isset($this->currencyIdColumn) == true) ? $this->currencyIdColumn : 'currency_id';
    }
}
