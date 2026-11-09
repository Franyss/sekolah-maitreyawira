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

    /**
     * Relasi BelongsTo ke Penulis Artikel (tabel user via author_id)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'user_id');
    }

    /**
     * Relasi Many-to-Many ke Unit Sekolah (tabel post_school via sch_id)
     */
    public function schools()
    {
        return $this->belongsToMany(
            School::class,
            'post_school',
            'post_id', // Foreign key di post_school yang merujuk ke post
            'sch_id',  // Foreign key di post_school yang merujuk ke school
            'post_id', // Local key di tabel post
            'sch_id'   // Local key di tabel school
        );
    }

    /**
     * Relasi Many-to-Many ke Tag Berita (tabel post_tag_detail)
     */
    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_tag_detail', 'post_id', 'post_tag_id');
    }
}
