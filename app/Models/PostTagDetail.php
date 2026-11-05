<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTagDetail extends Model
{
    protected $table = 'post_tag_detail';
    protected $primaryKey = 'post_tag_detail_id';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'post_tag_id',
    ];

    // FK: post_id -> post.post_id
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    // FK: post_tag_id -> post_tag.post_tag_id
    public function postTag()
    {
        return $this->belongsTo(PostTag::class, 'post_tag_id', 'post_tag_id');
    }
}
