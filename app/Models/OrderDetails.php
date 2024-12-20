<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';
    protected $fillable = [
        'order_code',
        'product_id',
        'product_name',
        'product_price',
        'product_sales_quantity',
        'product_coupon',
        'product_feeship',
        'order_id'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_code', 'order_code'); 
    }
}
