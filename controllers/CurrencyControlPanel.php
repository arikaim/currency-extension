<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Currency\Controllers;

use Arikaim\Core\Db\Model;
use Arikaim\Core\Controllers\ApiController;
use Arikaim\Core\Arikaim;


/**
 * Store currency control panel api controler
*/
class CurrencyControlPanel extends ApiController
{

    public function addController($request, $response, $data) 
    {       
        $this->requireControlPanelPermission();
        
    }

    public function updateController($request, $response, $data) 
    {       
        $this->requireControlPanelPermission();
        
    }

    public function deleteController($request, $response, $data) 
    {       
        $this->requireControlPanelPermission();
        
    }
}
