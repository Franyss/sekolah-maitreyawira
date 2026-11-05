<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'post_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'author_id',
        'status',
        'total_views',
    ];

    // FK: author_id -> user.user_id
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'user_id');
    }

    // Pivot FK: post_tag_detail (post_id & post_tag_id)
    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_tag_detail', 'post_id', 'post_tag_id');
    }

    // Pivot FK: post_school (post_id & sch_id)
    public function schools()
    {
        return $this->belongsToMany(School::class, 'post_school', 'post_id', 'sch_id');
    }
}
