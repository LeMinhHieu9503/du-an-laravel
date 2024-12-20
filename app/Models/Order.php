<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
    protected $fillable = [
        'customer_id',
        'shipping_id',
        'order_status',
        'order_code',
        'order_destroy'
    ];

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
}
