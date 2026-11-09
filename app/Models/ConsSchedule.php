<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsSchedule extends Model
{
    protected $table = 'cons_schedule';
    protected $primaryKey = 'cons_id_scd';
    public $timestamps = false;

    protected $fillable = [
        'cons_id',
        'nama_siswa_scd',
        'nama_ortu_scd',
        'asal_sekolah_scd',
        'no_wa_ortu_scd',
        'email_scd',
        'sta',
        'datetime_apply',
    ];

    /**
     * Relasi Belongs-To ke ConsultationSet (Foreign Key: cons_id)
     */
    public function consultationSet()
    {
        return $this->belongsTo(ConsultationSet::class, 'cons_id', 'cons_id');
    }
}
