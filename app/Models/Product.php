<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Product
 * @package App\Models
 * @version September 16, 2018, 10:43 am UTC
 *
 * @property string name
 * @property decimal price
 */
class Product extends Model
{

    public $table = 'products';
    public $timestamps = false;



    public $fillable = [
        'name',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:3|max:255|',
        'price' => 'required|numeric|between:0.00,999999.99'
    ];

    
}
