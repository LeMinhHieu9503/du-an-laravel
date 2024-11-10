<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_information';
    protected $fillable = [
        'info_contact',
        'info_map',
        'info_logo'
    ];
}
