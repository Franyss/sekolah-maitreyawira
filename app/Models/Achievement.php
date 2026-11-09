<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievement';
    protected $primaryKey = 'achievement_id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'achievement_title',
        'achievement_slug',
        'achievement_content',
    ];

    /**
     * Relasi One-to-Many ke model AchievementDetail
     */
    public function details()
    {
        return $this->hasMany(AchievementDetail::class, 'achievement_id', 'achievement_id');
    }

    /**
     * Relasi HasOne (dijaga untuk backward compatibility)
     */
    public function detail()
    {
        return $this->hasOne(AchievementDetail::class, 'achievement_id', 'achievement_id');
    }
}
