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

use Arikaim\Core\Controllers\Traits\Status;

/**
 * Store currency control panel api controler
*/
class CurrencyControlPanel extends ApiController
{
    use Status;

    /**
     * Init controller
     *
     * @return void
     */
    public function init()
    {
        $this->loadMessages('currency::admin.messages');
    }

    /**
     * Add currency
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function addController($request, $response, $data) 
    {       
        $this->requireControlPanelPermission();
        
        $this->onDataValid(function($data) {
            
            $currency = Model::Currency('currency');
            $newModel = $currency->create($data->toArray());

            $this->setResponse(is_object($newModel),function() use($newModel) {            
                $this
                    ->message('add')
                    ->field('uuid',$newModel->uuid);  
            },'errors.add');
        }); 
        $data->validate();
    }

    /**
     * Update currency
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function updateController($request, $response, $data) 
    {       
        $this->requireControlPanelPermission();
        
        $this->onDataValid(function($data) {
            $currency = Model::Currency('currency')->findById($data['uuid']);
            $result = $currency->update($data->toArray());

            $this->setResponse($result,function() use($currency) {            
                $this
                    ->message('update')
                    ->field('uuid',$currency->uuid);  
            },'errors.update');
        }); 
        $data->validate();

    }

    /**
     * Delete currency
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function deleteController($request, $response, $data) 
    {       
        $this->requireControlPanelPermission();
        
        $this->onDataValid(function($data) {
            $currency = Model::Currency('currency')->findById($data['uuid']);
            $result = $currency->delete();

            $this->setResponse($result,function() use($currency) {            
                $this
                    ->message('delete')
                    ->field('uuid',$currency->uuid);  
            },'errors.delete');
        }); 
        $data->validate();
    }
}
