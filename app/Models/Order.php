<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Order
 * @package App\Models
 * @version September 16, 2018, 3:54 am UTC
 *
 * @property string user_name
 * @property string user_email
 * @property string address
 * @property integer payment_status
 */
class Order extends Model
{

    public $table = 'orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static $order_status = [
        'Processing',
        'Paid',
        'Failed'
    ];

    public $fillable = [
        'user_name',
        'user_email',
        'address',
        'payment_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_name' => 'string',
        'user_email' => 'string',
        'address' => 'string',
        'payment_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_name' => 'required|min:3|max:255|',
        'user_email' => 'required|min:3|max:255|email',
        'address' => 'required|min:3|max:255',
        'card' => 'required',
        'month' => 'required|digits:2',
        'year' => 'required|digits:2',
        'cvv' => 'required|digits_between:2,4'
    ];

    public function products()
    {
        return $this->hasManyThrough(
            'App\Models\Product', 'App\Models\OrderProduct',
            'order_id',
            'id',
            'id',
            'product_id'
            );
    }

    public function orderProduct()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }

    public static function order_status_label_class($status)
    {
        $common_button_properties = 'label label';

        switch($status) {
            case 1: $result = '-success'; break;
            case 2: $result = '-danger'; break;
            default: $result = '-default';
        }

        return $common_button_properties.$result;
    }
}
