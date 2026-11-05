<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    // Mengarah ke tabel 'history' di database
    protected $table = 'history';
    protected $primaryKey = 'history_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'history_title',
        'history_date',
        'color',
    ];

    /**
     * Relasi ke detail sejarah (gambar & deskripsi)
     */
    public function details()
    {
        return $this->hasMany(HistoryDetail::class, 'history_id', 'history_id');
    }
}
