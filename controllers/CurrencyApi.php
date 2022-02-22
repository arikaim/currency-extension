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

/**
 * Currency api controller
*/
class CurrencyApi extends ApiController
{
    /**
     * Init controller
     *
     * @return void
     */
    public function init()
    {
        $this->loadMessages('currency::messages');
    }

    /**
     * Get currency list (for currency dropdown)
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function getDropdownList($request, $response, $data) 
    {       
        $this->onDataValid(function($data) {   
            $search = $data->get('query','');
            $size = $data->get('size',5);

            $model = Model::Currency('currency');
            $model = $model->getActive()->where('title','like',"%$search%")->take($size)->get();

            $this->setResponse(\is_object($model),function() use($model) {     
                $items = [];
                foreach ($model as $item) {
                    $items[] = [
                        'name'  => $item['code'],
                        'value' => $item['uuid']
                    ];
                }
                $this                    
                    ->field('success',true)
                    ->field('results',$items);  
            },'errors.list');                                
        });
        $data->validate();

        return $this->getResponse(true);
    }
}
