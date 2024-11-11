<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
        'slug_category_product'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
