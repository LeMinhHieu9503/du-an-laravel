<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'gallery_id';
    protected $table = 'tbl_gallery';
    protected $fillable = [
        'gallery_name',
        'gallery_image',
        'product_id'
    ];
}
