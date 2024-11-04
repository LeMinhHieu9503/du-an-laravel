<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';
    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_slug',
        'brand_status'
    ];
}
