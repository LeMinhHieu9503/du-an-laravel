<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
    protected $fillable = [
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'shipping_email',
        'shipping_notes',
        'shipping_method'
    ];
}
