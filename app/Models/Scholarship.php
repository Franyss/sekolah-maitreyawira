<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = 'scholarship';
    protected $primaryKey = 'id_bea';
    public $timestamps = false;

    protected $fillable = [
        'jenjang',
        'nama_siswa',
        'tempat_lhr',
        'tanggal_lhr',
        'alamat',
        'no_hp_wa',
        'email',
        'nama_ayah',
        'nama_ibu',
        'no_wa',
        'asal_sekolah',
        'desk_pres',
        'up_doc_bea',
        'schs_id',
        'gallery',
        'datetime_apply',
    ];
}
