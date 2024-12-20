<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';
    protected $fillable = [
        'name_quanhuyen',
        'type',
        'matp'
    ];
}
