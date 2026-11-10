<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $table = 'testimony';
    protected $primaryKey = 'testimony_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'testimony_title',
        'testimony_slug',
        'testimony_content',
    ];

    /**
     * Relasi One-to-Many ke rincian detail testimoni (tabel testimony_detail)
     */
    public function details()
    {
        return $this->hasMany(TestimonyDetail::class, 'testimony_id', 'testimony_id');
    }
}
