<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Currency\Service;

use Arikaim\Core\Db\Model;
use Arikaim\Core\Service\Service;
use Arikaim\Core\Service\ServiceInterface;

/**
 * Currency service class
*/
class Currency extends Service implements ServiceInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setServiceName('currency');
    }

    /**
     * Get currency id
     *
     * @param string|null $code
     * @return integer|null
     */
    public function getId(?string $code = null): ?int
    {
        if (empty($code) == true) {
            return $this->getDefaultCurrencyId();
        }

        $model = Model::Currency('currency')->findCurrency($code);

        return ($model != null) ? $model->id : null;
    }

    /**
     * Convert currency 
     *
     * @param string|null $currency
     * @param float $amount
     * @return float|null
     */
    public function convert(?string $currency, float $amount): ?float
    {
        $model = Model::Currency('currency')->findCurrency($currency);
        $rate = ($model == null) ? null : $model->getExchangeRate();
        
        return ($rate == null) ? null : (float)($amount * $rate);           
    }

    /**
     * Get default currency id
     *
     * @return integer
     */
    public function getDefaultCurrencyId(): int
    {
        $model = Model::Currency('currency')->getDefault();

        return ($model != null) ? (int)$model->id : 1;
    }

     /**
     * Get default currency cdoe
     *
     * @return string
     */
    public function getDefaultCurrencyCode(): string
    {
        $model = Model::Currency('currency')->getDefault();

        return ($model != null) ? (string)$model->code : 'USD';
    }
}
