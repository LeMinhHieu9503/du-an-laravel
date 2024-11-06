<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';
    protected $fillable = [
        'post_title',
        'post_content',
        'post_desc',
        'post_status',
        'post_image',
        'cate_post_id',
        'post_meta_desc',
        'post_slug'
    ];
}
