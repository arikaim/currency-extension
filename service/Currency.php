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
     * @param string $code
     * @return integer|null
     */
    public function getId(string $code): ?int
    {
        $model = Model::Currency('currency')->findCurrency($code);

        return ($model != null) ? $model->id : null;
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
