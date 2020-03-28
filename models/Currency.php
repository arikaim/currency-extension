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
        'sign',
        'title'
    ];
    
    /**
     * Disable timestamps
     *
     * @var boolean
     */
    public $timestamps = false;
}
