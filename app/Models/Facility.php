<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility';
    protected $primaryKey = 'facility_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'facility_title',
        'facility_desc',
        'facility_photo',
    ];

    /**
     * Relasi ke detail fasilitas (jika ada rincian konten tambahan)
     */
    public function details()
    {
        return $this->hasMany(FacilityDetail::class, 'facility_id', 'facility_id');
    }
}
