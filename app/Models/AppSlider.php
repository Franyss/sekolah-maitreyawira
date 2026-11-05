<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSlider extends Model
{
    protected $table = 'app_slider';
    protected $primaryKey = 'id';

    const CREATED_AT = 'datetime_created';
    const UPDATED_AT = 'datetime_last_updated';

    protected $fillable = [
        'photo',
        'title',
        'description',
        'btn_text',
        'btn_link',
        'status',
    ];
}
