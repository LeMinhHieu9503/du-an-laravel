<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'matp';
    protected $table = 'tbl_tinhthanhpho';
    protected $fillable = [
        'name_city',
        'type'
    ];
}
