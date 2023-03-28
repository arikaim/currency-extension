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
use Arikaim\Core\Controllers\ControlPanelApiController;
use Arikaim\Core\Controllers\Traits\Status;

/**
 * Currency control panel api controler
*/
class CurrencyControlPanel extends ControlPanelApiController
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
        $this->setExtensionName('currency');
        $this->setModelClass('Currency');
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
        $this->onDataValid(function($data) {
            
            $currency = Model::Currency('currency');
            $model = $currency->findByColumn($data['code'],'code');
            if ($model != null) {
                $this->error('errors.exist','Currency with this code exist.');
                return;
            }

            $newModel = $currency->create($data->toArray());

            $this->setResponse(($newModel != null),function() use($newModel) {            
                $this
                    ->message('add')
                    ->field('uuid',$newModel->uuid);  
            },'errors.add');
        }); 
        $data
            ->addFilter('code','UpperCase')
            ->filterAndValidate();
    }

    /**
     * Update currency
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function setExchangeRate($request, $response, $data) 
    { 
        $data
            ->addRule('Number','value')
            ->validate(true);

        $uuid = $data->get('uuid');
        $value = $data->get('value');

        $currency = Model::Currency('currency')->findById($uuid);
        if ($currency == null) {
            $this->error('errors.id','Not valid currency id');
            return;
        }

        $rate = Model::CurrencyRates('currency')->saveExchangeRate($currency->id,$value);
        if ($rate == null) {
            $this->error('errors.rate','Error save exchange rate');
            return;
        }

        $this
            ->message('Exchange rate saved')
            ->field('uuid',$uuid);
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
        $this->onDataValid(function($data) {
            $currency = Model::Currency('currency');
            $data['crypto'] = $data->get('crypto',0);
            $data['private'] = $data->get('private',0);

            $model = $currency->where('code','=',$data['code'])->where('uuid','<>',$data['uuid'])->first();
            if ($model != null) {
                $this->error('errors.exist','Currency with this code exist');
                return;
            }

            $currency = $currency->findById($data['uuid']);
            $result = $currency->update($data->toArray());

            $this->setResponse($result,function() use($currency) {            
                $this
                    ->message('update')
                    ->field('uuid',$currency->uuid);  
            },'errors.update');
        }); 
        $data
            ->addFilter('code','UpperCase')
            ->filterAndValidate();
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
