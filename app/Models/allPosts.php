<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class allPosts extends Model{
    protected $table = 'posts';

    public $timestamps = false;

    protected $fillable = [
        'post_author',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'post_type',
        'post_mime_type',
        'post_guid',
        'post_img',
        'job_salary',
        'job_place',
        'post_tags',
    ];
}
