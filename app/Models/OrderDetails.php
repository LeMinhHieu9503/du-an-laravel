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
        'product_feeship'
    ];
}
