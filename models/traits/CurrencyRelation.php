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
     * @return mixed
     */
    public function currency() 
    {
        return $this->belongsTo(Currency::class,$this->getCurrencyIdAttributeName());       
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
