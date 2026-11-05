<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tag';
    protected $primaryKey = 'post_tag_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'post_tag_name',
        'post_tag_slug',
    ];

    // Pivot FK: post_tag_detail (post_tag_id & post_id)
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag_detail', 'post_tag_id', 'post_id');
    }
}
