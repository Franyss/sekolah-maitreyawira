<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSchool extends Model
{
    protected $table = 'post_school';
    protected $primaryKey = 'post_school_id';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'sch_id',
    ];

    // FK: post_id -> post.post_id
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    // FK: sch_id -> school.sch_id
    public function school()
    {
        return $this->belongsTo(School::class, 'sch_id', 'sch_id');
    }
}
