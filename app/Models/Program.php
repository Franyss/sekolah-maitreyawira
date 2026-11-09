<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'program_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'program_title',
        'program_slug',
        'program_content',
    ];

    /**
     * Relasi One to Many ke model ProgramDetail (tabel program_detail)
     */
    public function details()
    {
        return $this->hasMany(ProgramDetail::class, 'program_id', 'program_id');
    }

    /**
     * Relasi HasOne (dijaga untuk backward compatibility)
     */
    public function detail()
    {
        return $this->hasOne(ProgramDetail::class, 'program_id', 'program_id');
    }
}
