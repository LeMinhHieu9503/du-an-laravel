<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    protected $fillable = [
        'product_name',
        'product_quantity',
        'category_id',
        'brand_id',
        'product_slug',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status'
    ];

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
