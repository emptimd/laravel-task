<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class OrderProduct
 * @package App\Models
 * @version September 16, 2018, 3:55 am UTC
 *
 * @property integer product_id
 * @property integer order_id
 */
class OrderProduct extends Model
{

    public $table = 'order_product';
    public $timestamps = false;


    public $fillable = [
        'product_id',
        'order_id',
        'product_name',
        'product_price',
        'qty',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'order_id' => 'integer',
        'qty' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
