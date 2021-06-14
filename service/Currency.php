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

        return (\is_object($model) == true) ? $model->id : null;
    }
}
